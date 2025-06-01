<?php

namespace App\Managers;

use App\Contracts\GameContract;
use App\Models\Game;

class GameManager implements GameContract
{
    public function getAll(){
        return Game::all();
    }

    public function findById(int $id){
        return Game::find($id);
    }

    public function create(array $data){
        return Game::create($data);
    }

    public function update(int $id, array $data){
        $game = Game::find($id);
        if (!$game) {
            return null;
        }

        $game->update($data);
        return $game;
    }

    public function delete(int $id){
        $game = Game::find($id);
        if (!$game) {
            return false;
        }

        return $game->delete();
    }
}
