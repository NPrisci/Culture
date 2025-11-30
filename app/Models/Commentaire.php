<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Commentaire extends Model
{
    //
    protected $table = 'commentaires';
    protected $primaryKey = 'id_commentaire';

    protected $fillable = [
        'texte',
        'note',
        'date',
        'id_utilisateur',
        'id_contenu'
    ];

    public function utilisateur()
    {
        return $this->belongsTo(User::class, 'id_utilisateur');
    }

    public function contenu()
    {
        return $this->belongsTo(Contenu::class, 'id_contenu');
    }
}
