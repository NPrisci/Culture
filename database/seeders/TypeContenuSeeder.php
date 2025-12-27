<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\TypeContenu;

class TypeContenuSeeder extends Seeder
{
    public function run(): void
    {
        $types = [
            ['nom_contenu' => 'Article'],
            ['nom_contenu' => 'Actualité'],
            ['nom_contenu' => 'Événement'],
        ];

        foreach ($types as $type) {
            TypeContenu::updateOrCreate([
                // Conditions de recherche : nom unique
                'nom_contenu' => $type['nom_contenu'],
            ], $type);
        }
    }
}
