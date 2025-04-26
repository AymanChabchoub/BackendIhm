<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Trajet extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'dateDepart',
        'heureDepart',
        'villeDepart',
        'villeArrivee',
        'prix',
        'placesDisponibles',
        'animauxAutorises',
        'fumeursAutorises',
        'bagagesAutorises',
        'typesBagages',
        'vehicule_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
