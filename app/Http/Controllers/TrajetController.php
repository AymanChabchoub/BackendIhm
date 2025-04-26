<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;


use App\Models\Trajet;
use Illuminate\Http\Request;

class TrajetController extends Controller
{
    // Lister tous les trajets
    public function index()
    {
        return response()->json(Trajet::all(), 200);
    }

    // Créer un nouveau trajet
    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'dateDepart' => 'required|date',
                'heureDepart' => 'required|date_format:H:i:s',  // Updated format to H:i:s
                'villeDepart' => 'required|string',
                'villeArrivee' => 'required|string',
                'prix' => 'required|numeric',
                'placesDisponibles' => 'required|integer',
                'animauxAutorises' => 'required|boolean',
                'fumeursAutorises' => 'required|boolean',
                'bagagesAutorises' => 'required|boolean',
                'typesBagages' => 'required|string',
                'vehicule_id' => 'required|exists:vehicules,id',
                'user_id' => 'required|exists:users,id',
            ]);
            
    
            // Assign default values if not provided
            if (!$request->has('dateDepart')) {
                $request->merge(['dateDepart' => now()->toDateString()]);
            }
            
            $validated['heureDepart'] = $validated['heureDepart'] ?? now()->format('H:i');
    
            $trajet = Trajet::create($validated);
    
            return response()->json([
                'message' => 'Trajet créé avec succès',
                'trajet' => $trajet
            ], 201);
    
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Erreur lors de la création du trajet',
                'message' => $e->getMessage()
            ], 500);
        }
    }
    
    


    // Afficher un trajet spécifique
    public function show(Trajet $trajet)
    {
        return response()->json($trajet, 200);
    }

    // Mettre à jour un trajet
    public function update(Request $request, Trajet $trajet)
    {
        $validated = $request->validate([
            'date' => 'sometimes|date',
            'heure' => 'sometimes|date_format:H:i',
            'villeDepart' => 'sometimes|string',
            'villeArrivee' => 'sometimes|string',
            'prix' => 'sometimes|numeric',
            'placesDisponibles' => 'sometimes|integer',
            'animauxAutorises' => 'sometimes|boolean',
            'fumeursAutorises' => 'sometimes|boolean',
            'bagagesAutorises' => 'sometimes|boolean',
            'typesBagages' => 'nullable|string',
            'user_id' => 'required|exists:users,id', // <== ajoute ça

        ]);

        $trajet->update($validated);

        return response()->json([
            'message' => 'Trajet mis à jour avec succès',
            'trajet' => $trajet
        ]);
    }

    // Supprimer un trajet
    public function destroy(Trajet $trajet)
    {
        $trajet->delete();

        return response()->json(['message' => 'Trajet supprimé avec succès']);
    }
}
