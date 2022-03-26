<?php

namespace App\Http\Controllers;

use App\Models\Character;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;

class CharacterController extends Controller
{

      //list of all characters
      public function index()
      {

          try {

              $characters = Character::all();
              return response()->json($characters);
          } catch (\Throwable $e) {

              return response()->json([
                  'error' => [
                      'description' => $e->getMessage()
                  ]
              ], 500);
          }
      }

      //find a specific character
      public function show($id)
      {

          try {

              $character = Character::find($id);
              return response()->json($character);

          } catch (\Throwable $e) {

              return response()->json([
                  'error' => [
                      'description' => $e->getMessage()
                  ]
              ], 500);
          }
      }

      //create a character
      public function create(Request $request)
      {

          try {

              $character = new Character();
              $character->name = $request->get('name');
              $character->gender = $request->get('gender');
              $character->save();
              return response()->json($character);

          } catch (\Throwable $e) {

              return response()->json([
                  'error' => [
                      'description' => $e->getMessage()
                  ]
              ], 500);
          }
      }

      //update a character
      public function update(Request $request, $id)
      {

          try {

              $character = Character::find($id);
              $character->name = $request->get('name');
              $character->gender = $request->get('gender');
              $character->save();
              return response()->json($character);

          } catch (\Throwable $e) {

              return response()->json([
                  'error' => [
                      'description' => $e->getMessage()
                  ]
              ], 500);
          }
      }

      //delete a character
      public function delete($id)
      {

          try {

              $character = Character::find($id);
              $character->delete();
              return response()->json("Character deleted successfully");

          } catch (\Throwable $e) {

              return response()->json([
                  'error' => [
                      'description' => $e->getMessage()
                  ]
              ], 500);
          }
      }
}
