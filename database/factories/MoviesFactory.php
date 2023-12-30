<?php

namespace Database\Factories;

use App\Models\Movies;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Movies>
 */
class MoviesFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->sentence(2), 
            'publish' => now(), 
            'image' =>  $this->faker->randomElement(['image1.jpg', 'image2.jpg', 'image3.jpg']),
        ];
    }
}
