<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Note extends Model
{
    protected $fillable = [
        'auteur_id',
        'destinataire_id',
        'note',
        'commentaire'
    ];

    // Relations (facultatives mais pratiques)
    public function auteur()
    {
        return $this->belongsTo(User::class, 'auteur_id');
    }

    public function destinataire()
    {
        return $this->belongsTo(User::class, 'destinataire_id');
    }
}
