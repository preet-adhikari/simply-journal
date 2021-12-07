<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class CategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $name = $this->faker->words(7,true);
        $slug = strtolower($name);
        return [
            'name' => $name,
            'slug' => $slug
        ];
    }
}
