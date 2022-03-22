<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Http;

class BookController extends Controller
{
    //list of all books
    public function index(){
       $response = Http::get('https://anapioficeandfire.com/api/books');
            return json_decode($response->body());
    }
}
