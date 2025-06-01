<?php

namespace App\Models;

use App\Contracts\GameContract;
use Illuminate\Database\Eloquent\Model;

class Game extends Model{
    protected $fillable = [
        'name',
        'categoria',
        'ano',
    ];
}
