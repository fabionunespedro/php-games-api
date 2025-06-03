<?php

namespace App\Http\Controllers;

use App\Services\GameService;
use App\Http\Requests\StoreGameRequest;
use App\Http\Requests\UpdateGameRequest;
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

    public function store(StoreGameRequest $request)
    {
        $data = $request->validated();
        $game = $this->service->create($data);

        return response()->json($game, 201);
    }

    public function show($id)
    {
        $game = $this->service->findById($id);

        return $game
            ? response()->json($game)
            : response()->json(['message' => 'Jogo não encontrado'], 404);
    }

    public function update(UpdateGameRequest $request, $id)
    {
        $data = $request->validated();
        $updated = $this->service->update($id, $data);
        
         return $updated
            ? response()->json($updated)
            : response()->json(['message' => 'Jogo não encontrado'], 404);
    }

    public function destroy($id)
    {
        return $this->service->delete($id)
            ? response()->json(['message' => 'Jogo excluído com sucesso'])
            : response()->json(['message' => 'Jogo não encontrado'], 404);
    }
}
