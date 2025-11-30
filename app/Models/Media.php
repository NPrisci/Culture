<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Media extends Model
{
    //
    protected $table = 'medias';
    protected $primaryKey = 'id_media';

    protected $fillable = [
        'chemin',
        'description',
        'id_contenu',
        'id_type_media'
    ];

    public function contenu()
    {
        return $this->belongsTo(Contenu::class, 'id_contenu');
    }

    public function typeMedia()
    {
        return $this->belongsTo(TypeMedia::class, 'id_type_media');
    }
}
