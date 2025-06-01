<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GameController;

Route::get('/games', [GameController::class, 'index']);
Route::post('/games', [GameController::class, 'store'])->middleware('check.year');
Route::get('/games/{id}', [GameController::class, 'show']);
Route::put('/games/{id}', [GameController::class, 'update']);
Route::delete('/games/{id}', [GameController::class, 'destroy']);

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
