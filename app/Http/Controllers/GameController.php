<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\GameService;

class GameController extends Controller
{
    protected $service;

    public function __construct(GameService $service)
    {
        $this->service = $service;
    }

    public function index()
    {
        return $this->service->getAll();
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string',
            'categoria' => 'required|string',
            'ano' => 'required|digits:4|integer',
        ]);

        return response()->json($this->service->create($validated), 201);
    }

    public function show($id)
    {
        $game = $this->service->findById($id);
        return $game ?: response()->json(['message' => 'Jogo não encontrado'], 404);
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'sometimes|string',
            'categoria' => 'sometimes|string',
            'ano' => 'sometimes|digits:4|integer',
        ]);

        $updated = $this->service->update($id, $validated);
        return $updated ?: response()->json(['message' => 'Jogo não encontrado'], 404);
    }

    public function destroy($id)
    {
        return $this->service->delete($id)
            ? response()->json(['message' => 'Jogo excluído com sucesso'])
            : response()->json(['message' => 'Jogo não encontrado'], 404);
    }
}
