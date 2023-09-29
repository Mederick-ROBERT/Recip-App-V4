<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Plat>
 */
class PlatFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'type_id'=> random_int(1, 3),
            'importance_id'=> random_int(1, 4),
            'name'=> $this->faker->word(),
            'slug'=> $this->faker->slug(),
            'preparation_time'=> $this->faker->time(),
            'cooking_time'=> $this->faker->time(),
            'person_number'=> random_int(1, 10),
            'picture_url'=> $this->faker->imageUrl(),
        ];
    }
}
