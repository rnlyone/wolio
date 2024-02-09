<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Materi>
 */
class MateriFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $kategoriIds = \App\Models\Kategori::pluck('id')->toArray();

        return [
            'id_kategori' => $this->faker->randomElement($kategoriIds),
            'slug' => $this->faker->unique()->slug,
            'judul' => $this->faker->sentence,
            'konten' => $this->faker->paragraphs(3, true),
        ];
    }
}
