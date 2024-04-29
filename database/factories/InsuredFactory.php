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
            'insurance_card_number' => fake()->randomNumber(4),
            'principal_insurer' => fake()->company(),
            'affiliated_insurer' => fake()->company(),
            'insurer_number' => fake()->randomNumber(7),
            'support_level' => fake()->word(),
            'gender' => fake()->randomElement(['男性', '女性']),
            'birth_date' => fake()->date(),
            'age' => fake()->numberBetween(0, 120),
            'checkup_date' => fake()->date(),
            'height' => fake()->randomFloat(1, 100, 300),
            'weight' => fake()->randomFloat(1, 1, 700),
            'bmi' => fake()->randomFloat(1, 10, 50),
            'waist' => fake()->randomFloat(1, 1, 500),
            'systolic1' => fake()->numberBetween(0, 300),
            'systolic2' => fake()->numberBetween(0, 300),
            'systolic_other' => fake()->numberBetween(0, 300),
            'diastolic1' => fake()->numberBetween(0, 300),
            'diastolic2' => fake()->numberBetween(0, 300),
            'diastolic_other' => fake()->numberBetween(0, 300),
            'triglycerides' => fake()->numberBetween(0, 900),
            'fasting_triglycerides' => fake()->numberBetween(0, 900),
            'casual_triglycerides' => fake()->numberBetween(0, 900),
            'hdl_cholesterol' => fake()->numberBetween(0, 200),
            'ldl_cholesterol' => fake()->numberBetween(0, 200),
            'got' => fake()->numberBetween(0, 300),
            'gpt' => fake()->numberBetween(0, 300),
            'gamma_gt' => fake()->numberBetween(0, 300),
            'fasting_glucose' => fake()->numberBetween(0, 300),
            'casual_glucose' => fake()->numberBetween(0, 300),
            'hba1c' => fake()->randomFloat(1, 0, 20),
            'medication1' => fake()->boolean(),
            'medication2' => fake()->boolean(),
            'medication3' => fake()->boolean(),
            'smoking' => fake()->boolean(),
            'initial_interview_date' => fake()->date(),
            'initial_interview_time' => fake()->time(),
            'characteristics' => fake()->text(),
        ];
    }
}
