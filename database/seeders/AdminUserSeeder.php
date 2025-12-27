<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class AdminUserSeeder extends Seeder
{
    public function run()
    {
        // plusieurs utilisateurs de test
        $users = [
            [
                'nom' => 'Administrateur',
                'prenom' => 'Admin',
                'email' => 'admin@beninculture.com',
                'password' => Hash::make('password123'),
                'email_verified_at' => now(),
                'date_inscription' => now(),
                'statut' => 'actif',
                'id_role' => 1,
                'id_langue' => 2,
            ],
            [
                'nom' => 'Doe',
                'prenom' => 'John',
                'email' => 'john@beninculture.com',
                'password' => Hash::make('password123'),
                'email_verified_at' => now(),
                'date_inscription' => now(),
                'statut' => 'actif',
                'id_role' => 2,
                'id_langue' => 3,
            ],
            [
                'nom' => 'LISE',
                'prenom' => 'Lisa',
                'email' => 'lisa@beninculture.com',
                'password' => Hash::make('password123'),
                'email_verified_at' => now(),
                'date_inscription' => now(),
                'statut' => 'actif',
                'id_role' => 3,
                'id_langue' => 3,
            ],
            [
                'nom' => 'COMLAN',
                'prenom' => 'Maurice',
                'email' => 'mauricecomlan@uac.bj',
                'password' => Hash::make('Eneam123'),
                'email_verified_at' => now(),
                'date_inscription' => now(),
                'statut' => 'actif',
                'id_role' => 1,
                'id_langue' => 3,
            ],

        ];

        foreach ($users as $user) {
            User::create($user);
        }
    }
}
