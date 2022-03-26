<?php

namespace App\Http\Controllers;

use App\Models\Character;
use App\Models\Comment;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;

class CommentController extends Controller
{

      //list of all comments
      public function index()
      {

          try {

              $comments = Comment::all();
              return response()->json($comments);
          } catch (\Throwable $e) {

              return response()->json([
                  'error' => [
                      'description' => $e->getMessage()
                  ]
              ], 500);
          }
      }

      //find a specific comment
      public function show($id)
      {

          try {

              $comment = Comment::find($id);
              return response()->json($comment);

          } catch (\Throwable $e) {

              return response()->json([
                  'error' => [
                      'description' => $e->getMessage()
                  ]
              ], 500);
          }
      }

      //create a comment
      public function create(Request $request)
      {

          try {

              $comment = new Comment();
              $comment->name = $request->get('name');
              $comment->book_id = $request->get('book_id');
              $comment->save();
              return response()->json($comment);

          } catch (\Throwable $e) {

              return response()->json([
                  'error' => [
                      'description' => $e->getMessage()
                  ]
              ], 500);
          }
      }

      //update a comment
      public function update(Request $request, $id)
      {

          try {

              $comment = Comment::find($id);
              $comment->name = $request->get('name');
              $comment->book_id = $request->get('book_id');
              $comment->save();
              return response()->json($comment);

          } catch (\Throwable $e) {

              return response()->json([
                  'error' => [
                      'description' => $e->getMessage()
                  ]
              ], 500);
          }
      }

      //delete a comment
      public function delete($id)
      {

          try {

              $comment = Comment::find($id);
              $comment->delete();
              return response()->json("Comment deleted successfully");

          } catch (\Throwable $e) {

              return response()->json([
                  'error' => [
                      'description' => $e->getMessage()
                  ]
              ], 500);
          }
      }
}
