<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    protected $fillable = [
        'date',
        'nbPlaces',
        'status',
        'prixTotal',
        'user_id',
        'trajet_id'
    ];
}
