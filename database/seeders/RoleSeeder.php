<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roles = [
            ['nom_role' => 'admin'],
            ['nom_role' => 'moderateur'],
            ['nom_role' => 'utilisateur'],
        ];

        foreach ($roles as $role) {
            Role::updateOrCreate(
                ['nom_role' => $role['nom_role']],  // Conditions de recherche
                $role                        // Données à créer/mettre à jour
            );
        }
    }
}
