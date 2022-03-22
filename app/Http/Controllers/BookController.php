<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Http;

class BookController extends Controller
{
    //list of all books
    public function showAllBooks()
    {
        $response = Http::get('https://anapioficeandfire.com/api/books/');
        return json_decode($response->body());
    }

    public function find($id)
    {
        $response = Http::get('https://www.anapioficeandfire.com/api/books/'.$id);
        return $response->json();
    }

    public function showAllCharacters()
    {
        $response = Http::get('https://www.anapioficeandfire.com/api/characters/');
        return json_decode($response->body());
    }
}
