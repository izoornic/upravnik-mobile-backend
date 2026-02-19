<?php

use App\Http\Controllers\Api\AuthController as ApiAuth;
use App\Http\Controllers\Api\V1\DobavljacController;
use App\Http\Controllers\Api\V1\LookupController;
use App\Http\Controllers\Api\V1\MesecZgradaZaduzenjeController;
use App\Http\Controllers\Api\V1\RacunKomentarController;
use App\Http\Controllers\Api\V1\StanAnalitikaController;
use App\Http\Controllers\Api\V1\StanariAnalitikaController;
use App\Http\Controllers\Api\V1\StanController;
use App\Http\Controllers\Api\V1\StanMesecZaduzenjeController;
use App\Http\Controllers\Api\V1\VrstaZaduzenjaController;
use App\Http\Controllers\Api\V1\ZgradaController;
use App\Http\Controllers\Api\V1\ZgradaRacunController;
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
    Route::get('/zgrade/{id}', [ZgradaController::class, 'show']);

    // Stanovi (units) - nested under zgrada
    Route::get('/zgrade/{zgradaId}/stanovi', [StanController::class, 'index']);
    Route::get('/zgrade/{zgradaId}/stanovi/{stanId}', [StanController::class, 'show']);
    Route::get('/zgrade/{zgradaId}/stanovi/{stanId}/analitika', [StanAnalitikaController::class, 'index']);

    // Stanari analitika (per-unit financial summary)
    Route::get('/zgrade/{zgradaId}/stanari-analitika', [StanariAnalitikaController::class, 'index']);

    // Vrste zaduzenja (charge types) - nested under zgrada
    Route::get('/zgrade/{zgradaId}/vrste-zaduzenja', [VrstaZaduzenjaController::class, 'index']);

    // Stan mesec zaduzenja (unit monthly charges)
    Route::get('/zgrade/{zgradaId}/stan-zaduzenja', [StanMesecZaduzenjeController::class, 'index']);
    Route::patch('/stan-zaduzenja/{id}/uplata', [StanMesecZaduzenjeController::class, 'recordPayment']);

    // Mesec zgrada zaduzenja (building monthly charges)
    Route::get('/zgrade/{zgradaId}/zgrada-zaduzenja', [MesecZgradaZaduzenjeController::class, 'index']);

    // Zgrada racuni (building income/expenses)
    Route::get('/zgrade/{zgradaId}/racuni', [ZgradaRacunController::class, 'index']);

    // Racun komentari (invoice comments)
    Route::get('/zgrade/{zgradaId}/racun-komentari', [RacunKomentarController::class, 'index']);

    // Lookup tables
    Route::get('/lookup/stan-namene', [LookupController::class, 'stanNamene']);
    Route::get('/lookup/fondovi', [LookupController::class, 'fondovi']);
    Route::get('/lookup/meseci', [LookupController::class, 'meseci']);

    // Dobavljaci (suppliers)
    Route::get('/dobavljaci', [DobavljacController::class, 'index']);
    Route::get('/dobavljaci/{id}/tekuci-racuni', [DobavljacController::class, 'tekuciRacuni']);
});
