<?php


// class User extends Authenticatable
// {
//     use HasFactory, Notifiable;

//     /**
//      * Spécifier la clé primaire personnalisée
//      */
//     protected $primaryKey = 'id_utilisateur';

//     /**
//      * Spécifier que la clé n'est pas auto-incrémentée (si nécessaire)
//      */
//     public $incrementing = true;

//     /**
//      * Spécifier le type de la clé
//      */
//     protected $keyType = 'int';

//     protected $fillable = [
//         'nom',
//         'prenom', 
//         'email',
//         'password',
//         'sexe',
//         'date_inscription',
//         'date_naissance',
//         'statut',
//         'photo',
//         'id_role',
//         'id_langue',
//     ];

//     protected $hidden = [
//         'password',
//         'remember_token',
//     ];

//     protected function casts(): array
//     {
//         return [
//             'email_verified_at' => 'datetime',
//             'password' => 'hashed',
//             'date_inscription' => 'date',
//             'date_naissance' => 'date',
//         ];
//     }

//     /**
//      * Get the name of the unique identifier for the user.
//      */
//     public function getAuthIdentifierName()
//     {
//         return 'id_utilisateur';
//     }

//     /**
//      * Get the unique identifier for the user.
//      */
//     public function getAuthIdentifier()
//     {
//         return $this->id_utilisateur;
//     }

//     // Relations
//     public function role()
//     {
//         return $this->belongsTo(Role::class, 'id_role');
//     }

//     public function langue()
//     {
//         return $this->belongsTo(Langue::class, 'id_langue');
//     }

//     public function contenus()
//     {
//         return $this->hasMany(Contenu::class, 'id_auteur');
//     }

//     public function commentaires()
//     {
//         return $this->hasMany(Commentaire::class, 'id_utilisateur');
//     }

//     /**
//      * Accessor pour le nom complet
//      */
//     public function getNomCompletAttribute()
//     {
//         return $this->prenom . ' ' . $this->nom;
//     }
// }


namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = 'users'; 
    protected $primaryKey = 'id_utilisateur';
    public $incrementing = true;
    protected $keyType = 'int';

    protected $fillable = [
        'nom',
        'prenom',
        'email',
        'password',
        'sexe',
        'date_inscription',
        'date_naissance',
        'statut',
        'photo',
        'id_role',
        'id_langue',
    ];

    protected $hidden = [
        'password',
    ];

    // Si ton mot de passe s'appelle mot_de_passe instead of password
    public function getAuthPassword()
    {
        return $this->password;
    }
    public function role()
{
    return $this->belongsTo(Role::class, 'id_role', 'id_role');
}

     public function langue()
     {
        return $this->belongsTo(Langue::class, 'id_langue');
     }

     public function contenus()
    {
        return $this->hasMany(Contenu::class, 'id_auteur');
     }
     public function commentaires()
    {
         return $this->hasMany(Commentaire::class, 'id_utilisateur');
     }
}

