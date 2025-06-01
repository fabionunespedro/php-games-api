<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Contracts\GameContract;

class GameController extends Controller
{
    protected $games;

    public function __construct(GameContract $games){
        $this->games = $games;
    }

    public function index(){
        return response()->json($this->games->getAll(), 200);
    }

    public function store(Request $request){
        $request->validate([
            'name' => 'required|string',
            'categoria' => 'required|string',
            'ano' => 'required|digits:4|integer',
        ]);

        $game = $this->games->create($request->all());

        return response()->json($game, 201);
    }

    public function show($id){
        $game = $this->games->findById($id);

        if (!$game) {
            return response()->json(['message' => 'Jogo não encontrado'], 404);
        }

        return response()->json($game, 200);
    }

    public function update(Request $request, $id){
        $request->validate([
            'name' => 'sometimes|string',
            'categoria' => 'sometimes|string',
            'ano' => 'sometimes|digits:4|integer',
        ]);

        $game = $this->games->update($id, $request->all());

        if (!$game) {
            return response()->json(['message' => 'Jogo não encontrado'], 404);
        }

        return response()->json($game, 200);
    }

    public function destroy($id){
        $deleted = $this->games->delete($id);

        if (!$deleted) {
            return response()->json(['message' => 'Jogo não encontrado'], 404);
        }

        return response()->json(['message' => 'Jogo excluído com sucesso'], 200);
    }
}
