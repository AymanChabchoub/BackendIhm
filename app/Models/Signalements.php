<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Signalements extends Model
{
    protected $fillable = [
        'emetteur_id',
        'cible_id',
        'motif',
    ];

    // Relations
    public function emetteur()
    {
        return $this->belongsTo(User::class, 'emetteur_id');
    }

    public function cible()
    {
        return $this->belongsTo(User::class, 'cible_id');
    }
}
