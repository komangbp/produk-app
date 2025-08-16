<?php

namespace Database\Factories;

use App\Models\Kategori;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Produk>
 */
class ProdukFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nama' => $this->faker->words(3, true),
            'kategori_id' => Kategori::query()->inRandomOrder()->value('id') ?? Kategori::factory(),
            'deskripsi' => $this->faker->paragraph(),
            'harga' => $this->faker->randomFloat(2, 10000, 5000000),
        ];
    }
}
