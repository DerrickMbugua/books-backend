<?php

/** @var \Laravel\Lumen\Routing\Router $router */

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$router->get('/', function () use ($router) {
    return $router->app->version();
});

$router->group(['prefix' => 'api'], function () use ($router) {

    //list of all books
    $router->get('books',  ['uses' => 'BookController@showAllBooks']);
    //list of all characters
    $router->get('characters',  ['uses' => 'CharacterController@index']);
    //get a specific book by id
    $router->get('books/{id}', ['uses' => 'BookController@show']);
    //get a specific character
    $router->get('characters/{id}', ['uses' => 'BookController@findCharacter']);
    //get comments of a book
    $router->get('books/{id}/comments', ['uses' => 'BookController@showBookComment']);
    //add comments of a book
    $router->post('books/{id}/comments', ['uses' => 'BookController@addComment']);
    //get a list of characters of a book
    $router->get('books/{id}/characters', ['uses' => 'BookController@showBookCharacter']);

    //save book names and authors from API to DB
    $router->post('books', ['uses' => 'BookController@syncApiData']);

    $router->delete('books/{id}', ['uses' => 'BookController@delete']);

    $router->put('books/{id}', ['uses' => 'BookController@update']);
});
