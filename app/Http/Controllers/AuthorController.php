<?php

namespace App\Http\Controllers;

use App\Models\Author;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;

class AuthorController extends Controller
{

      //list of all Authors
      public function index()
      {

          try {

              $Authors = Author::all();
              return response()->json($Authors);
          } catch (\Throwable $e) {

              return response()->json([
                  'error' => [
                      'description' => $e->getMessage()
                  ]
              ], 500);
          }
      }

      //find a specific Author
      public function show($id)
      {

          try {

              $Author = Author::find($id);
              return response()->json($Author);

          } catch (\Throwable $e) {

              return response()->json([
                  'error' => [
                      'description' => $e->getMessage()
                  ]
              ], 500);
          }
      }

      //create a Author
      public function create(Request $request)
      {

          try {

              $Author = new Author();
              $Author->name = $request->get('name');
              $Author->save();
              return response()->json($Author);

          } catch (\Throwable $e) {

              return response()->json([
                  'error' => [
                      'description' => $e->getMessage()
                  ]
              ], 500);
          }
      }

      //update a Author
      public function update(Request $request, $id)
      {

          try {

              $Author = Author::find($id);
              $Author->name = $request->get('name');
              $Author->save();
              return response()->json($Author);

          } catch (\Throwable $e) {

              return response()->json([
                  'error' => [
                      'description' => $e->getMessage()
                  ]
              ], 500);
          }
      }

      //delete a Author
      public function delete($id)
      {

          try {

              $Author = Author::find($id);
              $Author->delete();
              return response()->json("Author deleted successfully");

          } catch (\Throwable $e) {

              return response()->json([
                  'error' => [
                      'description' => $e->getMessage()
                  ]
              ], 500);
          }
      }
}
