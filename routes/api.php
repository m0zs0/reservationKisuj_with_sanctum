<?php
use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ReservationController;


// Teszt endpoint (nyilvános)
Route::get('/hello', function () {
    return response()->json(['message' => 'Hello API']);
});

// Auth endpointok (nyilvános)
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

// Védett endpointok (auth:sanctum middleware)
Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);

    // Reservation API végpontok (csak bejelentkezett felhasználóknak)
    Route::get('/reservations', [ReservationController::class, 'index']);         // Összes foglalás
    Route::get('/reservations/{id}', [ReservationController::class, 'show']);     // Egy foglalás lekérdezése
    Route::post('/reservations', [ReservationController::class, 'store']);        // Új foglalás létrehozása
    Route::put('/reservations/{id}', [ReservationController::class, 'update']);   // Foglalás minden mezőjének módosítása
    Route::patch('/reservations/{id}', [ReservationController::class, 'update']); // Foglalás adott mezőjének módosítása
    Route::delete('/reservations/{id}', [ReservationController::class, 'destroy']); // Foglalás törlése
});
