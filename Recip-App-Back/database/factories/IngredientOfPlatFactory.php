<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\IngredientOfPlat>
 */
class IngredientOfPlatFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'plat_id' => \App\Models\Plat::factory(),
            'ingredient_id' => \App\Models\Ingredient::factory(),
        ];
    }
}
