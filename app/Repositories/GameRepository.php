<?php

namespace App\Repositories;

use App\Models\Game;

class GameRepository implements GameRepositoryInterface
{
    public function getAll()
    {
        return Game::all();
    }

    public function findById(int $id)
    {
        return Game::find($id);
    }

    public function create(array $data)
    {
        return Game::create($data);
    }

    public function update(int $id, array $data)
    {
        $game = Game::find($id);
        if (!$game) {
            return null;
        }

        $game->update($data);
        return $game;
    }

    public function delete(int $id)
    {
        $game = Game::find($id);
        return $game ? $game->delete() : false;
    }
}
