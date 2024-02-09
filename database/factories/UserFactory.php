<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'role' => fake()->randomElement(['guru', 'siswa', 'admin']),
            'nama' => fake()->name,
            'username' => fake()->userName,
            'nomor_induk' => fake()->word,
            'email' => fake()->unique()->safeEmail,
            'email_verified_at' => now(),
            'no_hp' => fake()->phoneNumber,
            'password' => bcrypt('password'), // Default password, bisa diganti sesuai kebutuhan
            'avatar' => 'avatar.webp',
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     *
     * @return static
     */
    public function unverified()
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}
