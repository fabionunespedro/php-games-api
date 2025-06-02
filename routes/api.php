<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GameController;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

Route::post('/login', function(Request $request) {
    $user = User::where('email', $request->email)->first();

    if (!$user || !Hash::check($request->password, $user->password)) {
        return response()->json(['message' => 'Credenciais inválidas'], 401);
    }

    $token = bin2hex(random_bytes(40)); 

    $user->api_token = $token;
    $user->save();

    return response()->json([
        'token' => $token,
        'user' => $user->only('id', 'name', 'email'),
    ]);
});

Route::middleware('auth.token')->group(function () {
    Route::get('/games', [GameController::class, 'index']);
    Route::post('/games', [GameController::class, 'store']);
    Route::get('/games/{id}', [GameController::class, 'show']);
    Route::put('/games/{id}', [GameController::class, 'update']);
    Route::delete('/games/{id}', [GameController::class, 'destroy']);

    Route::get('/user', function (Request $request) {
        $token = $request->bearerToken();
        $user = User::where('api_token', $token)->first();
        return $user->only('id', 'name', 'email');
    });
});
