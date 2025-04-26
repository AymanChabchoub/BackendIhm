<?php

namespace App\Http\Controllers;

use App\Models\Signalements;
use Illuminate\Http\Request;

class SignalementsController extends Controller
{
    public function index()
    {
        return Signalements::with(['emetteur', 'cible'])->get();
    }

    public function store(Request $request)
    {
        try{
        $request->validate([
            'emetteur_id' => 'required|exists:users,id',
            'cible_id' => 'required|exists:users,id',
            'motif' => 'required|string',
        ]);

        $signalement = Signalements::create($request->all());

        return response()->json($signalement, 201);
        }catch (\Exception $e) {
            return response()->json([
                'error' => 'Erreur lors de la création de la réservation',
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function show($id)
    {
        $signalement = Signalements::with(['emetteur', 'cible'])->findOrFail($id);
        return response()->json($signalement);
    }

    public function update(Request $request, $id)
    {
        $signalement = Signalements::findOrFail($id);

        $request->validate([
            'emetteur_id' => 'exists:users,id',
            'cible_id' => 'exists:users,id',
            'motif' => 'string',
        ]);

        $signalement->update($request->all());

        return response()->json($signalement);
    }

    public function destroy($id)
    {
        $signalement = Signalements::findOrFail($id);
        $signalement->delete();

        return response()->json(['message' => 'Signalement supprimé avec succès.']);
    }
}
