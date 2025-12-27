<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Langue;

class LangueSeeder extends Seeder
{
    public function run(): void
    {
        $langues = [
            [
                'nom_langue' => 'Fon',
                'code_langue' => 'fon',
                'description' => 'Langue largement parlée dans le sud du Bénin',
            ],
            [
                'nom_langue' => 'Yoruba',
                'code_langue' => 'yor',
                'description' => 'Langue parlée à Porto-Novo et dans le sud-est du Bénin',
            ],
            [
                'nom_langue' => 'Bariba',
                'code_langue' => 'bba',
                'description' => 'Langue parlée dans le nord du Bénin',
            ],
            [
                'nom_langue' => 'Dendi',
                'code_langue' => 'ddn',
                'description' => 'Langue parlée dans le nord du Bénin, notamment à Malanville',
            ],
            [
                'nom_langue' => 'Adja',
                'code_langue' => 'adj',
                'description' => 'Langue parlée dans le sud-ouest du Bénin',
            ],
        ];

        foreach ($langues as $langue) {
            Langue::updateOrCreate(['code_langue' => $langue['code_langue']], $langue);
        }
    }
}
