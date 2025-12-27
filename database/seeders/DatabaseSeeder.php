<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([

            //RoleSeeder::class,
            LangueSeeder::class,
            RegionSeeder::class,
            TypeContenuSeeder::class,
            TypeMediaSeeder::class,
            AdminUserSeeder::class,
            ContenuSeeder::class,
            MediaSeeder::class,
            CommentaireSeeder::class,
        ]);
    }
}
