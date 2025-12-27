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
                'statut' => 'approuvé',
            ],
            [
                'texte' => 'Intéressant mais manque des détails sur le festival de Ouidah.',
                'note' => 4,
                'date' => Carbon::now(),
                'id_utilisateur' => 2,
                'id_contenu' => 2,
                'statut' => 'approuvé',
            ],
        ];

        foreach ($commentaires as $commentaire) {
            Commentaire::updateOrCreate(
                [
                    // Conditions : un utilisateur ne peut commenter qu'une fois par contenu
                    'id_utilisateur' => $commentaire['id_utilisateur'],
                    'id_contenu' => $commentaire['id_contenu'],
                ],
                $commentaire
            );
        }
    }
}
