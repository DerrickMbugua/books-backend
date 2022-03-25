<?php

namespace App\Console\Commands;

use App\Models\Book;
use App\Models\Author;
use App\Models\Character;
use App\Models\BookAuthor;
use App\Models\BookCharacter;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Http;

class SyncApiData extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'add:api-data';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }
    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        // fetch books
        Log::info('Start fetching data');
        $books_response = Http::get('https://anapioficeandfire.com/api/books/');
        $books = $books_response->json();
        //Log::info($books);

        foreach ($books as $book) {
            $book_id = explode("/", $book["url"]);
            $book_id = intval(end($book_id));
            $saved_book = Book::find($book_id);
            Log::info('Start saving book ' . $book["url"] . " id => " . $book_id);
            Log::info('Saved Book :');
            if (!$saved_book) {
                $saved_book = Book::create(array(
                    'id' => $book_id,
                    'name' => $book['name']
                ));
            }
            Log::info("Book id:" . $saved_book->id);

            // get authors from each book
            Log::info('Start saving authors');
            foreach ($book['authors'] as $author) {

                // check an author if not there create author
                $saved_author = Author::firstWhere('name', $author);

                if (!$saved_author) {
                    $saved_author = Author::create(
                        array(
                            'name' => $author
                        )
                    );
                }

                // check if the book and author have a book_author
                $saved_book_author = BookAuthor::where('book_id', $saved_book->id)
                    ->where('author_id', $saved_author->id)
                    ->first();
                // if not create one
                if (!$saved_book_author) {
                    Log::info("Create Book Author");
                    $saved_book_author = BookAuthor::create(
                        array(
                            'book_id' => $saved_book->id,
                            'author_id' => $saved_author->id,
                        )
                    );
                }
            }
            Log::info('Start saving characters');
            $characterList = array_slice($book['characters'], 0, 50);
            foreach ($characterList as $characterLink) {
                // get characters
                // call the character endpoint
                Log::info('Character link: ' . $characterLink);
                $characters_response = Http::get($characterLink);
                $character = $characters_response->json();
                // check if they are in your db
                // if not create
                $character_id = explode("/", $character["url"]);
                $character_id = intval(end($character_id));
                $saved_character = Character::find($character_id);
                Log::info(' Character saving');
                if (!$saved_character) {
                    $saved_character = Character::create(array(
                        'id' => $character_id,
                        'name' => $character['name'],
                        'gender' => $character['gender']
                    ));
                }

                // check if the book and author have a book_author
                $saved_book_character = BookCharacter::where('book_id', $saved_book->id)
                    ->where('character_id', $saved_character->id)
                    ->first();
                // if not create one
                // link via the book_table by check the book_id and character_id

                if (!$saved_book_character) {
                    $saved_book_character = BookCharacter::create(
                        array(
                            'book_id' => $saved_book->id,
                            'character_id' => $saved_character->id,
                        )
                    );
                }
            }
            Log::info('Book saved');
        }
    }
}
