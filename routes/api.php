<?php

use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\KorpaController;
use App\Http\Controllers\KupovinaController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProizvodController;
use App\Http\Controllers\ReceptController;
use App\Http\Middleware\CheckUserType;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

//Autentifikacija korisnika
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']); 
Route::post('/logout', [AuthController::class, 'logout']); 
//Route::middleware('auth:sanctum')->post('/logout', [AuthController::class, 'logout']);

//RUTE ZA ADMINA

Route::middleware(['auth:sanctum', 'App\Http\Middleware\CheckUserType:admin'])->group(function () {

    //Operacije za proizvode
    Route::post('/dodaj_proizvod', [ProizvodController::class, 'store']);
    Route::put('/izmeni_proizvod/{idProizvod}', [ProizvodController::class, 'update']);
    Route::delete('/obrisi_proizvod/{idProizvod}', [ProizvodController::class, 'destroy']);

    //Operacije za recepte
    Route::apiResource('/recepti', ReceptController::class)->except('show', 'index');
    
    /*Route::post('/dodaj_recept', [ReceptController::class, 'store']);
    Route::put('/izmeni_recept/{idRecept}', [ReceptController::class, 'update']);
    Route::delete('/obrisi_recept/{idRecept}', [ReceptController::class, 'destroy']);*/

});

//RUTE ZA REGISTROVANOG KORISNIKA

Route::middleware(['auth:sanctum', 'App\Http\Middleware\CheckUserType:registrovani,admin'])->group(function () {

    //Korpa
    Route::get('/korpa', [KorpaController::class, 'index']);
    Route::put('/korpa/{idKorpa}/proizvod/{idProizvod}', [KorpaController::class, 'updateOrCreateKorpaStavka']);
    Route::post('/generisi_korpu/{idRecept}', [KorpaController::class, 'generateCartByRecipe']);
    Route::delete('/korpa/{idKorpa}/proizvod/{idProizvod}', [KorpaController::class, 'removeKorpaStavka']);

    //Kupovina
    Route::apiResource('/kupovina', KupovinaController::class);
    Route::post('/potvrdi_kupovinu', [KupovinaController::class, 'checkout']);

});


//RUTE ZA GOSTA

//Slucajevi koriscenja za proizvod
Route::get('/proizvodi', [ProizvodController::class, 'index']);
/*Route::post('/dodaj_proizvod', [ProizvodController::class, 'store']);
Route::put('/izmeni_proizvod/{idProizvod}', [ProizvodController::class, 'update']);
Route::delete('/obrisi_proizvod/{idProizvod}', [ProizvodController::class, 'destroy']);*/
Route::get('/pretraga', [ProizvodController::class, 'search']);

//Slucajevi koriscenja za recept
Route::get('/recepti', [ReceptController::class, 'index']);
/*Route::post('/dodaj_recept', [ReceptController::class, 'store']);
Route::put('/izmeni_recept/{idRecept}', [ReceptController::class, 'update']);
Route::delete('/obrisi_recept/{idRecept}', [ReceptController::class, 'destroy']);*/
Route::get('/pretraga_po_sastojcima', [ReceptController::class, 'searchByIngredients']);
