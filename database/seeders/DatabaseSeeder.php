<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        // Appeler la factory pour charger les produits JSON
        \App\Models\Product::factory()->definition();

        // On crée les rôles
        \App\Models\Role::create([
            'name' => \App\Models\Role::ADMIN,
        ]);

        \App\Models\Role::create([
            'name' => \App\Models\Role::RDC,
        ]);

        \App\Models\Role::create([
            'name' => \App\Models\Role::USER,
        ]);

        User::factory()->create([
            'first_name' => 'admin',
            'last_name' => 'admin',
            'email' => 'admin@example.com',
            'role_id' => 1,
        ]);

        // On crée notre utilisateur de test qui sera maintenant un utilisateur lambda
        User::factory()->create([
            'first_name' => 'user',
            'last_name' => 'user',
            'email' => 'test@example.com',
            'role_id' => 3,
        ]);


    }
}
