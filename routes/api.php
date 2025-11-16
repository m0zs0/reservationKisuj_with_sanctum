<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ReservationController;

//Route::middleware('api')->group(function () { //Az összes benne lévő útvonalra alkalmazza az api middleware csoportot (hitelesítés (auth); jogosultságkezelés (can); CORS kezelés; naplózás, IP-ellenőrzés stb.)

    
    //teszt API endpoint
    Route::get('/hello', function () {
        return response()->json(['message' => 'Hello API']);
    });

    
    // Reservation API végpontok
    Route::get('/reservations', [ReservationController::class, 'index']);         // Összes foglalás
    Route::get('/reservations/{id}', [ReservationController::class, 'show']);     // Egy foglalás lekérdezése
    Route::post('/reservations', [ReservationController::class, 'store']);        // Új foglalás létrehozása
    Route::put('/reservations/{id}', [ReservationController::class, 'update']);   // Foglalás minden mezőjének módosítása
    Route::patch('/reservations/{id}', [ReservationController::class, 'update']);   // Foglalás adott mezőjének módosítása
    Route::delete('/reservations/{id}', [ReservationController::class, 'destroy']); // Foglalás törlése

//});