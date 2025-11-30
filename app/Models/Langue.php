<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Langue extends Model
{
    //
    protected $table = 'langues';

    protected $primaryKey = 'id_langue';

    protected $fillable = [
        'nom_langue',
        'code_langue',
        'description',
    ];

    public function utilisateurs()
    {
        return $this->hasMany(User::class, 'id_langue');
    }

    public function regions()
    {
        return $this->belongsToMany(Region::class, 'parler', 'id_langue', 'id_region');
    }

    public function contenus()
    {
        return $this->hasMany(Contenu::class, 'id_langue');
    }
}
