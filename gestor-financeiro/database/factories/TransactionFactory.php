<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Transaction>
 */
class TransactionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => fake()->numberBetween(1, 10),
            'category_id' => fake()->numberBetween(1, 10),
            'name' => fake()->name(),
            'recurrent' => fake()->boolean(),
            'is_spent' => fake()->boolean(),
            'value' => fake()->randomFloat(2, -2000, 2000),
            'date' => fake()->dateTimeBetween('-20 days', '+10days'),
        ];
    }
}