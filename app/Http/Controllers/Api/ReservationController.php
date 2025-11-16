<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Reservation;

class ReservationController extends Controller
{
    
    public function index()
    {
        //return \App\Models\Reservation::all(); use nélkül így lehetne használni
        $reservations = Reservation::all(); //SELECT * FROM reservations; Eloquent ORM lekérdezés futtatása
        return response()->json($reservations, 200);
    }

    
    public function show($id)
    {
        $reservation = Reservation::findOrFail($id);
        if (!$reservation) {
            return response()->json(['error' => 'Foglalás nem található!'], 404);
        }

        return response()->json($reservation, 200); 
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string',
            'email' => 'required|email',
            'reservation_time' => 'required|date',
            'guests' => 'required|integer|min:1',
            'note' => 'nullable|string',
        ]);

        $reservation = Reservation::create($validated);
        return response()->json($reservation, 201);
    }

    
public function update(Request $request, $id)
    {
        $reservation = Reservation::findOrFail($id);

        $validated = $request->validate([
            'name' => 'sometimes|required|string',
            'email' => 'sometimes|required|email',
            'reservation_time' => 'sometimes|required|date',
            'guests' => 'sometimes|required|integer|min:1',
            'note' => 'nullable|string',
        ]);

        //sometimes: csak akkor validálja, ha az adott mező benne van a kérésben, required: ha benne van, akkor nem lehet üres.

        $reservation->update($validated);

        return response()->json($reservation, 200);
    }

    public function destroy($id)
    {
        $reservation = Reservation::findOrFail($id);
        if (!$reservation) {
            return response()->json(['error' => 'Foglalás nem található!'], 404);
        }

        $reservation->delete();
        return response()->json(['message' => 'Foglalás törölve.'], 200);
    }
}
