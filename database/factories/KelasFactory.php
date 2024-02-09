<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Kelas>
 */
class KelasFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'tingkat' => $this->faker->numberBetween(1, 12),
            'nama_kelas' => $this->faker->word . ' ' . $this->faker->randomLetter,
        ];
    }
}
