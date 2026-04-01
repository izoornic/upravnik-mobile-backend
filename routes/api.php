<?php

use App\Http\Controllers\Api\AuthController as ApiAuth;
use App\Http\Controllers\Api\V1\StanAnalitikaController;
use App\Http\Controllers\Api\V1\StanController;
use App\Http\Controllers\Api\V1\ZgradaController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/login', [ApiAuth::class, 'login']);
Route::post('/register', [ApiAuth::class, 'register']);
Route::post('/logout', [ApiAuth::class, 'logout']);

Route::prefix('v1')->middleware('auth:sanctum')->group(function () {
    // Zgrade (buildings)
    Route::get('/zgrade', [ZgradaController::class, 'index']);

    // Stanovi (units) - nested under zgrada
    Route::get('/zgrade/{zgradaId}/stanovi', [StanController::class, 'index']);
    Route::get('/zgrade/{zgradaId}/stanovi/{stanId}', [StanController::class, 'show']);
    Route::get('/zgrade/{zgradaId}/stanovi/{stanId}/analitika', [StanAnalitikaController::class, 'index']);

});
