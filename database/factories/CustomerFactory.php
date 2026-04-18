<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class CustomerFactory extends Factory
{
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'phone' => '+38099' . fake()->unique()->numerify('#######'),
            'email' => fake()->unique()->safeEmail(),
        ];
    }
}