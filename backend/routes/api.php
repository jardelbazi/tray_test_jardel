<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::middleware('api')->get('/ping', function () {
    return response()->json(['message' => 'pong']);
});

Route::get('/auth/google', [UserController::class, 'redirectToGoogle']);
Route::get('/auth/callback', [UserController::class, 'handleGoogleCallback']);
Route::get('/user/{googleId}', [UserController::class, 'getUser']);
Route::put('/user/update/{googleId}', [UserController::class, 'update']);
Route::get('/users', [UserController::class, 'index']);
