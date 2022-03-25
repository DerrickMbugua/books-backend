<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Author;
use GuzzleHttp\Client;
use App\Models\Comment;
use App\Models\Character;
use App\Models\BookAuthor;
use Illuminate\Http\Request;
use App\Models\BookCharacter;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Http;

class BookController extends Controller
{
    //list of book names along with their authors and comment count
    public function showAllBooks()
    {
        $books = Book::with('authors')->withCount('comments')->get();
        return $books;
    }

    //list of all books
    public function index()
    {
        // $books = DB::table('books')
        //     ->join('comments', 'books.id', '=', 'comments.book_id')
        //     ->select('books.name', 'books.author')
        //     ->selectRaw('count(comments.book_id) as comments_count')
        //     ->groupBy('books.name', 'books.author')
        //     ->get();

        // return $books;
        $books = Book::all();
        return $books;
    }

    //find a specific book
    public function show($id)
    {
        $book = Book::where('id', $id)->get();
        return $book;
    }

    //update a book
    public function update(Request $request, $id)
    {
        $book = new Book();
    }

    //show book comments
    public function showBookComment()
    {
        $bookComments = Book::with('comments')->get();
        return $bookComments;
    }

    //show book characters
    public function showBookCharacter(Request $request, $id)
    {
        $bookCharacters = Character::query()->whereRelation('books', 'books.id', $id);
        if ($request->has('sortBy')) {
            //Handle default parameter of get with second argument
            $bookCharacters->orderBy($request->get('sortBy'), $request->get('direction', 'ASC'));
        }
        if ($request->has('gender')) {
            //Handle default parameter of get with second argument
            $bookCharacters->where('gender', '=', $request->get('gender'));
        }
        return $bookCharacters->paginate(10);
    }
}
