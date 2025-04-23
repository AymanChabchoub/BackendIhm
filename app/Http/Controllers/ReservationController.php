<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use Illuminate\Http\Request;

class ReservationController extends Controller
{
    public function index()
    {
        return Reservation::all();
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'user_id' => 'required|exists:users,id',
            'trajet_id' => 'required|exists:trajets,id',
            'date' => 'required|date',
            'nbPlaces' => 'required|integer|min:1',
            'status' => 'required|string',
            'prixTotal' => 'required|integer|min:0',
        ]);

        $reservation = Reservation::create($data);
        return response()->json($reservation, 201);
    }

    public function show(Reservation $reservation)
    {
        return $reservation;
    }

    public function update(Request $request, Reservation $reservation)
    {
        $data = $request->validate([
            'date' => 'sometimes|date',
            'nbPlaces' => 'sometimes|integer|min:1',
            'status' => 'sometimes|string',
            'prixTotal' => 'sometimes|integer|min:0',
        ]);

        $reservation->update($data);
        return response()->json($reservation);
    }

    public function destroy(Reservation $reservation)
    {
        $reservation->delete();
        return response()->json(null, 204);
    }
}
