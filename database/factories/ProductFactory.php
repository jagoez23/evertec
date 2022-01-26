<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name,
            'description' => $this->faker->paragraph(),
            'price' => $this->faker->text(),
            'image' => $this-> faker->imageUrl($width = 200, $height = 200),
        ];
    }
}
