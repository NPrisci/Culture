<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Commentaire;
use Carbon\Carbon;

class CommentaireSeeder extends Seeder
{
    public function run(): void
    {
        $commentaires = [
            [
                'texte' => 'Très bon article sur la culture Fon.',
                'note' => 5,
                'date' => Carbon::now(),
                'id_utilisateur' => 1, 
                'id_contenu' => 1,     
            ],
            [
                'texte' => 'Intéressant mais manque des détails sur le festival de Ouidah.',
                'note' => 4,
                'date' => Carbon::now(),
                'id_utilisateur' => 2,
                'id_contenu' => 2,
            ],
        ];

        foreach ($commentaires as $commentaire) {
            Commentaire::create($commentaire);
        }
    }
}
