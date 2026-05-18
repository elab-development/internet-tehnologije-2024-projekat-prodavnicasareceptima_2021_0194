<?php

use App\Http\Controllers\API\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProizvodController;
use App\Http\Controllers\ReceptController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

//Autentifikacija korisnika
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']); 
//Route::post('/logout', [AuthController::class, 'logout']); 
Route::middleware('auth:sanctum')->post('/logout', [AuthController::class, 'logout']);

//Slucajevi koriscenja za proizvod
Route::get('/proizvodi', [ProizvodController::class, 'index']);
Route::post('/dodaj_proizvod', [ProizvodController::class, 'store']);
Route::put('/izmeni_proizvod/{idProizvod}', [ProizvodController::class, 'update']);
Route::delete('/obrisi_proizvod/{idProizvod}', [ProizvodController::class, 'destroy']);
Route::get('/pretraga', [ProizvodController::class, 'search']);

//Slucajevi koriscenja za recept
Route::post('/dodaj_recept', [ReceptController::class, 'store']);
Route::put('/izmeni_recept/{idRecept}', [ReceptController::class, 'update']);
Route::delete('/obrisi_recept/{idRecept}', [ReceptController::class, 'destroy']);
Route::get('/pretraga_po_sastojcima', [ReceptController::class, 'searchByIngredients']);