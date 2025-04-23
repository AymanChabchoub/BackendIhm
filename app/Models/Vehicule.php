<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Vehicule extends Model
{
    protected $fillable = [
        'user_id', 'marque', 'modele', 'couleur', 'niveauComfort',
    ];
}
