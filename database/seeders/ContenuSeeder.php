<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Contenu;
use Carbon\Carbon;

class ContenuSeeder extends Seeder
{
    public function run(): void
    {
        $contenus = [
            [
                'titre' => 'La culture Fon au Bénin',
                'texte' => 'Présentation des traditions et valeurs du peuple Fon.',
                'date_creation' => Carbon::now(),
                'statut' => 'publié',
                'parent_id' => null,
                'date_validation' => Carbon::now(),
                'id_region' => 1,   // Atlantique
                'id_langue' => 1,   // Fon
                'id_moderateur' => 2,
                'id_type_contenu' => 1, // Article
                'id_auteur' => 1,
            ],
            [
                'titre' => 'Festival culturel de Ouidah',
                'texte' => 'Retour sur le festival annuel célébrant les cultures béninoises.',
                'date_creation' => Carbon::now(),
                'statut' => 'publié',
                'parent_id' => null,
                'date_validation' => Carbon::now(),
                'id_region' => 1,   // Atlantique
                'id_langue' => 2,   // Yoruba
                'id_moderateur' => 2,
                'id_type_contenu' => 2, // Actualité
                'id_auteur' => 1,
            ],
            [
                'titre' => 'Conte traditionnel Bariba',
                'texte' => 'Un conte ancien transmis de génération en génération.',
                'date_creation' => Carbon::now(),
                'statut' => 'publié',
                'parent_id' => null,
                'date_validation' => Carbon::now(),
                'id_region' => 3,   // Borgou
                'id_langue' => 3,   // Bariba
                'id_moderateur' => 2,
                'id_type_contenu' => 1, // Article
                'id_auteur' => 1,
            ],
            [
                'titre' => 'Danse traditionnelle Adja',
                'texte' => 'Découverte des rythmes et danses du peuple Adja.',
                'date_creation' => Carbon::now(),
                'statut' => 'publié',
                'parent_id' => null,
                'date_validation' => Carbon::now(),
                'id_region' => 5,   // Mono
                'id_langue' => 5,   // Adja
                'id_moderateur' => 2,
                'id_type_contenu' => 3, // Événement
                'id_auteur' => 1,
            ],
            [
                'titre' => 'Traditions du peuple Dendi',
                'texte' => 'Les pratiques culturelles et sociales des Dendi.',
                'date_creation' => Carbon::now(),
                'statut' => 'publié',
                'parent_id' => null,
                'date_validation' => Carbon::now(),
                'id_region' => 4,   // Atacora
                'id_langue' => 4,   // Dendi
                'id_moderateur' => 2,
                'id_type_contenu' => 1, // Article
                'id_auteur' => 1,
            ],
        ];

        foreach ($contenus as $contenu) {
            Contenu::create($contenu);
        }
    }
}
