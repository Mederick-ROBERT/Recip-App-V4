<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
         \App\Models\User::factory(10)->create();

         \App\Models\Type::factory()->create([
             'name' => 'Entrée',
         ]);
        \App\Models\Type::factory()->create([
            'name' => 'Plat',
        ]);
        \App\Models\Type::factory()->create([
            'name' => 'Desert',
        ]);

        \App\Models\Importance::factory()->create([
            'name' => 'Midi',
        ]);
        \App\Models\Importance::factory()->create([
            'name' => 'Soir',
        ]);
        \App\Models\Importance::factory()->create([
            'name' => 'Semaine',
        ]);
        \App\Models\Importance::factory()->create([
            'name' => 'Week-End',
        ]);

        \App\Models\Unite::factory()->create([
            'name' => 'Gramme',
            'symbole' => 'g'
        ]);

        \App\Models\Unite::factory()->create([
            'name' => 'Millilitre',
            'symbole' => 'ml'
        ]);

        \App\Models\Unite::factory()->create([
            'name' => 'Unite',
            'symbole' => 'unité(s)'
        ]);

        \App\Models\Plat::factory(30)->create();

        \App\Models\Favoris::factory(10)->create();

        \App\Models\Ingredient::factory(30)->create();

        \App\Models\Etape::factory(30)->create();

        \App\Models\Commentaire::factory(30)->create();

        \App\Models\IngredientOfPlat::factory(60)->create();

    }
}
