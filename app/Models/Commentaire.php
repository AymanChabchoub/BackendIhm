<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Commentaire extends Model
{
    protected $fillable = [
        'text',
        'user_id',
        'trajet_id'
    ];

    // Relations (optionnel mais conseillé pour Eloquent)
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function trajet()
    {
        return $this->belongsTo(Trajet::class);
    }
}
