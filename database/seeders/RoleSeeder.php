<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Role;
use Illuminate\Support\Facades\DB;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        // Désactiver les vérifications de clés étrangères
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        Role::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        $roles = [
            ['id_role' => 1, 'nom_role' => 'Administrateur'],
            ['id_role' => 2, 'nom_role' => 'Utilisateur'],
            ['id_role' => 3, 'nom_role' => 'Modérateur'],
        ];

        foreach ($roles as $role) {
            Role::create($role);
        }
    }
}
