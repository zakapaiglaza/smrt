<?php

namespace Database\Factories;

use App\Models\Customer;
use Illuminate\Database\Eloquent\Factories\Factory;

class TicketFactory extends Factory
{
    public function definition(): array
    {
        return [
            'customer_id' => Customer::factory(),
            'subject' => fake()->sentence(3),
            'body' => fake()->sentence(6),
            'status' => fake()->randomElement(['new', 'in_progress', 'processed']),
            'manager_response_at' => null,
        ];
    }
}