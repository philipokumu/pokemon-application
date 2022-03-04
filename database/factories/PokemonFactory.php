<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Pokemon>
 */
class PokemonFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'id' => rand(1,100),
            'identifier' => 'bulbasaur',
            'species_id' => rand(1,100),
            'height' => rand(1,100),
            'weight' => rand(1,100),
            'base_experience' => rand(1,100),
            'order' => rand(1,100),
            'is_default' => rand(0,1),
        ];
    }
}
