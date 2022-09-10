<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $address = ['Yangon', 'Mandalay', 'Pakokku', 'Myingyan', 'Pyay', 'Sagaing', 'Pyin Oo lwin'];
        return [
            'title' => $this->faker->sentence(rand(5, 8)),
            'description' => $this->faker->paragraph(rand(15, 25)),
            'price' => rand(20000, 50000),
            'address' => $address[array_rand($address)],
            'rating' => rand(0, 5)
        ];
    }
}