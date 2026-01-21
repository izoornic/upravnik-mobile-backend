<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController as ApiAuth;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/login', [ApiAuth::class, 'login']);
Route::post('/register', [ApiAuth::class, 'register']);
Route::post('/logout', [ApiAuth::class, 'logout']);
