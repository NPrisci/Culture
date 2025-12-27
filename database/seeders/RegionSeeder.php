<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Region;

class RegionSeeder extends Seeder
{
    public function run(): void
    {
        $regions = [
            [
                'nom_region'  => 'Atlantique',
                'description' => 'Région côtière abritant Cotonou, centre économique du Bénin',
                'population'  => 1390000,
                'superficie'  => 3233,
                'localisation' => 'Sud du Bénin',
            ],
            [
                'nom_region'  => 'Ouémé',
                'description' => 'Région du sud-est avec Porto-Novo comme ville principale',
                'population'  => 1100000,
                'superficie'  => 1281,
                'localisation' => 'Sud-Est du Bénin',
            ],
            [
                'nom_region'  => 'Borgou',
                'description' => 'Grande région du nord avec Parakou comme centre urbain',
                'population'  => 1400000,
                'superficie'  => 25856,
                'localisation' => 'Nord du Bénin',
            ],
            [
                'nom_region'  => 'Atacora',
                'description' => 'Région montagneuse et touristique du nord-ouest',
                'population'  => 800000,
                'superficie'  => 20499,
                'localisation' => 'Nord-Ouest du Bénin',
            ],
            [
                'nom_region'  => 'Mono',
                'description' => 'Région du sud-ouest à forte activité agricole',
                'population'  => 500000,
                'superficie'  => 1605,
                'localisation' => 'Sud-Ouest du Bénin',
            ],
        ];

        foreach ($regions as $region) {
            Region::updateOrCreate(
                [
                    // Conditions de recherche : nom unique
                    'nom_region' => $region['nom_region'],
                ],
                // Données à créer/mettre à jour
                $region
            );
        }
    }
}
