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

    //book crud operations
    //list of all books together with authors and comment count
    $router->get('books',  ['uses' => 'BookController@index']);
    //get a specific book by id
    $router->get('books/{id}', ['uses' => 'BookController@show']);
    //create a book
    $router->post('books',  ['uses' => 'BookController@create']);
    //update a book
    $router->put('books/{id}', ['uses' => 'BookController@update']);
    //delete a book
    $router->delete('books/{id}', ['uses' => 'BookController@delete']);
    //get a list of characters of a book
    $router->get('books/{id}/characters', ['uses' => 'BookController@showBookCharacter']);
    //get comments of a book
    $router->get('books/{id}/comments', ['uses' => 'BookController@showBookComment']);
    //add comments of a book
    $router->post('books/{id}/comments', ['uses' => 'BookController@addComment']);

    //character crud operations
    //list of all characters
    $router->get('characters',  ['uses' => 'CharacterController@index']);
    //get a specific character
    $router->get('characters/{id}', ['uses' => 'CharacterController@show']);
    //create a character
    $router->post('characters',  ['uses' => 'CharacterController@create']);
    //update a character
    $router->put('characters/{id}',  ['uses' => 'CharacterController@update']);
    //delete a character
    $router->delete('characters/{id}', ['uses' => 'CharacterController@delete']);

    //comment crud operations
    //list of all comments
    $router->get('comments',  ['uses' => 'CommentController@index']);
    //get a specific comment
    $router->get('comments/{id}', ['uses' => 'CommentController@show']);
    //create a comment
    $router->post('comments',  ['uses' => 'CommentController@create']);
    //update a comment
    $router->put('comments/{id}',  ['uses' => 'CommentController@update']);
    //delete a comment
    $router->delete('comments/{id}', ['uses' => 'CommentController@delete']);

     //author crud operations
    //list of all authors
    $router->get('authors',  ['uses' => 'AuthorController@index']);
    //get a specific author
    $router->get('authors/{id}', ['uses' => 'AuthorController@show']);
    //create a author
    $router->post('authors',  ['uses' => 'AuthorController@create']);
    //update a author
    $router->put('authors/{id}',  ['uses' => 'AuthorController@update']);
    //delete a comment
    $router->delete('authors/{id}', ['uses' => 'AuthorController@delete']);
});
