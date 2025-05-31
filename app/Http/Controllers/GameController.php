<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Game;

class GameController extends Controller
{
    public function index() {
        return Game::all();
    }

    public function store(Request $request){
        $request->validate([
            'name' => 'required|string',
            'categoria' => 'required|string',
            'ano' => 'required|digits:4|integer',
        ]);

        $game = Game::create($request->all());

        return response()->json($game, 201);
    }

    public function show($id){
        $game = Game::find($id);

        if (!$game) {
            return response()->json(['message' => 'Jogo não encontrado'], 404);
        }

        return $game;
    }

    public function update(Request $request, $id){
        $game = Game::find($id);

        if (!$game) {
            return response()->json(['message' => 'Jogo não encontrado'], 404);
        }

        $request->validate([
            'name' => 'sometimes|string',
            'categoria' => 'sometimes|string',
            'ano' => 'sometimes|digits:4|integer',
        ]);

        $game->update($request->all());

        return response()->json($game);
    }

    public function destroy($id){
        $game = Game::find($id);

        if (!$game) {
            return response()->json(['message' => 'Jogo não encontrado'], 404);
        }

        $game->delete();

        return response()->json(['message' => 'Jogo excluído com sucesso']);
    }
}
