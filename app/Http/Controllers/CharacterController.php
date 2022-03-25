<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;


class CharacterController extends Controller
{

    public function index()
    {
        $response = Http::get('https://www.anapioficeandfire.com/api/characters/');
        return json_decode($response->body());
    }

    public function findCharacter($id)
    {
        $response = Http::get('https://www.anapioficeandfire.com/api/characters/' . $id);
        return $response->json();
    }
}
