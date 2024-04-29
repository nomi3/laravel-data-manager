<?php

namespace Database\Seeders;

use App\Models\Insured;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        Insured::factory()->create([
            'name' => 'Test Insured',
            'first_name_kana' => 'テスト',
            'last_name_kana' => 'インシュアード',
            'insurance_card_symbol' => 1234,
            'insurance_card_number' => 1234567890,
            'email' => 'test@example.com',
        ]);
    }
}
