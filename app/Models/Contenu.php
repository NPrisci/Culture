<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Contenu extends Model
{
    //
    protected $table = 'contenus';
    protected $primaryKey = 'id_contenu';

    protected $fillable = [
        'titre',
        'texte',
        'date_creation',
        'statut',
        'parent_id',
        'date_validation',
        'id_region',
        'id_langue',
        'id_moderateur',
        'id_type_contenu',
        'id_auteur',
    ];

     public function region()
    {
        return $this->belongsTo(Region::class, 'id_region');
    }

    public function langue()
    {
        return $this->belongsTo(Langue::class, 'id_langue');
    }

    public function auteur()
    {
        return $this->belongsTo(User::class, 'id_auteur');
    }
    public function moderateur()
    {
        return $this->belongsTo(User::class, 'id_moderateur');
    }

    public function typeContenu()
    {
        return $this->belongsTo(TypeContenu::class, 'id_type_contenu');
    }

    public function medias()
    {
        return $this->hasMany(Media::class, 'id_contenu');
    }

    public function commentaires()
    {
        return $this->hasMany(Commentaire::class, 'id_contenu');
    }

      public function paiements()
    {
        return $this->hasMany(Paiement::class);
    }
}
