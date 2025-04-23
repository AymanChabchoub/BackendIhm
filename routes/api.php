<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CommentaireController;
use App\Http\Controllers\NoteController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\SignalementsController;
use App\Http\Controllers\TrajetController;
use App\Http\Controllers\VehiculeController;

// Inscription et connexion (public)
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::apiResource('vehicules', VehiculeController::class);
Route::apiResource('signalements', SignalementsController::class);
Route::apiResource('commentaires', CommentaireController::class);
Route::apiResource('notes', NoteController::class);
Route::apiResource('reservations', ReservationController::class);
Route::apiResource('tragets', TrajetController::class);




// Exemple de route protégée (accessible uniquement si connecté avec Sanctum)
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {

    return $request->user();
});
