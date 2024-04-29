<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Insured>
 */
class InsuredFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'first_name_kana' => fake()->firstKanaName(),
            'last_name_kana' => fake()->lastKanaName(),
            'insurance_card_symbol' => fake()->randomNumber(4),
            'insurance_card_number' => fake()->randomNumber(8),
        ];
    }
}
