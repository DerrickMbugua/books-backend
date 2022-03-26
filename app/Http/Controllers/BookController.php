<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Character;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Http;

class BookController extends Controller
{

    //list of book names along with their authors and comment count
    public function index()
    {

        try {
            $books = Book::with('authors')->withCount('comments')->get();
            return response()->json($books);
        } catch (\Throwable $e) {
            return response()->json([
                'error' => [
                    'description' => $e->getMessage()
                ]
            ], 500);
        }
    }

    //list of all books
    public function showAllBooks()
    {

        try {

            $books = Book::all();
            return response()->json($books);
        } catch (\Throwable $e) {

            return response()->json([
                'error' => [
                    'description' => $e->getMessage()
                ]
            ], 500);
        }
    }

    //find a specific book
    public function show($id)
    {

        try {

            $book = Book::find($id);
            return response()->json($book);

        } catch (\Throwable $e) {

            return response()->json([
                'error' => [
                    'description' => $e->getMessage()
                ]
            ], 500);
        }
    }

    //create a book
    public function create(Request $request)
    {

        try {

            $book = new Book();
            $book->name = $request->get('name');
            $book->save();
            return response()->json($book);

        } catch (\Throwable $e) {

            return response()->json([
                'error' => [
                    'description' => $e->getMessage()
                ]
            ], 500);
        }
    }

    //update a book
    public function update(Request $request, $id)
    {

        try {

            $book = Book::find($id);
            $book->name = $request->get('name');
            $book->save();
            return response()->json($book);

        } catch (\Throwable $e) {

            return response()->json([
                'error' => [
                    'description' => $e->getMessage()
                ]
            ], 500);
        }
    }

    //delete a book
    public function delete($id)
    {

        try {

            $book = Book::find($id);
            $book->delete();
            return response()->json("Book deleted successfully");

        } catch (\Throwable $e) {

            return response()->json([
                'error' => [
                    'description' => $e->getMessage()
                ]
            ], 500);
        }
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
