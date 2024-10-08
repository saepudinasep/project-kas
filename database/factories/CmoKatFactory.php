<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\CmoKat>
 */
class CmoKatFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'cmo_id' => \App\Models\User::factory(), // CMO user will be created automatically
            'kat_id' => \App\Models\Kat::factory(), // KAT user will be created automatically
        ];
    }
}
