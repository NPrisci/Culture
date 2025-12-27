<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\TypeMedia;

class TypeMediaSeeder extends Seeder
{
    public function run(): void
    {
        $types = [
            ['nom_media' => 'Image'],
            ['nom_media' => 'Vidéo'],
            ['nom_media' => 'Audio'],
        ];

        foreach ($types as $type) {
            TypeMedia::updateOrCreate([
                // Conditions de recherche : nom unique
                'nom_media' => $type['nom_media'],
            ], $type);
        }
    }
}
