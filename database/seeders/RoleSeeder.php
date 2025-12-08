<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $this ->call([
            RoleSeeder::class,
        ]);

        $roles = [
            [
                'id_role' => 1,
                'nom_role' => 'Administrateur',
            ],
            [
                'id_role' => 2,
                'nom_role' => 'Modérateur',
            ],
            [
                'id_role' => 3,
                'nom_role' => 'Utilisateur',
            ],
            
        ];
        
    }
}
