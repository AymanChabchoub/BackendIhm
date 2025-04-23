<?php

namespace App\Http\Controllers;

use App\Models\Vehicule;
use Illuminate\Http\Request;

class VehiculeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Retourner la liste de tous les véhicules
        return response()->json(Vehicule::all(), 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Valider les données de la requête
        $request->validate([
            'user_id' => 'required|exists:users,id', // Vérifier que l'utilisateur existe
            'marque' => 'required|string|max:255',
            'modele' => 'required|string|max:255',
            'couleur' => 'nullable|string|max:255',
            'niveauComfort' => 'required|string|unique:vehicules,niveauComfort|max:255',
        ]);

        // Créer un nouveau véhicule
        $vehicule = Vehicule::create($request->all());

        // Retourner une réponse avec le véhicule créé
        return response()->json($vehicule, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Vehicule $vehicule)
    {
        // Retourner un véhicule spécifique
        return response()->json($vehicule, 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Vehicule $vehicule)
    {
        // Valider les données de la requête
        $request->validate([
            'marque' => 'required|string|max:255',
            'modele' => 'required|string|max:255',
            'couleur' => 'nullable|string|max:255',
            'niveauComfort' => 'required|string|unique:vehicules,niveauComfort,' . $vehicule->id . '|max:255',
        ]);

        // Mettre à jour le véhicule
        $vehicule->update($request->all());

        // Retourner une réponse avec le véhicule mis à jour
        return response()->json($vehicule, 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Vehicule $vehicule)
    {
        // Supprimer le véhicule
        $vehicule->delete();

        // Retourner une réponse
        return response()->json(null, 204);
    }
}
