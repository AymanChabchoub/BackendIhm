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
        try {
            $data = $request->validate([
                'user_id' => 'required|exists:users,id',
                'trajet_id' => 'required|exists:trajets,id',
                'date' => 'required|date',
                'nbPlaces' => 'required|integer|min:1',
                'status' => 'required|string',
                'prixTotal' => 'required|integer|min:0',
            ]);
    
            // Proceed to create the reservation
            $reservation = Reservation::create($data);
    
            return response()->json($reservation, 201);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'error' => 'Validation Error',
                'message' => $e->getMessage(),
                'errors' => $e->errors(),
            ], 400);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Erreur lors de la création de la réservation',
                'message' => $e->getMessage()
            ], 500);
        }
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
