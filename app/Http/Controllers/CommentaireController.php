<?php

namespace App\Http\Controllers;

use App\Models\Commentaire;
use Illuminate\Http\Request;

class CommentaireController extends Controller
{
    public function index()
    {
        return Commentaire::all();
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'text' => 'required|string',
            'user_id' => 'required|exists:users,id',
            'trajet_id' => 'required|exists:trajets,id',
        ]);

        $commentaire = Commentaire::create($data);
        return response()->json($commentaire, 201);
    }

    public function show(Commentaire $commentaire)
    {
        return $commentaire;
    }

    public function update(Request $request, Commentaire $commentaire)
    {
        $data = $request->validate([
            'text' => 'sometimes|string',
            'user_id' => 'sometimes|exists:users,id',
            'trajet_id' => 'sometimes|exists:trajets,id',
        ]);

        $commentaire->update($data);
        return response()->json($commentaire);
    }

    public function destroy(Commentaire $commentaire)
    {
        $commentaire->delete();
        return response()->json(null, 204);
    }
}
