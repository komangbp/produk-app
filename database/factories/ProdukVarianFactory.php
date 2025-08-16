<?php

namespace Database\Factories;

use App\Models\Produk;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ProdukVarian>
 */
class ProdukVarianFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'produk_id' => Produk::query()->inRandomOrder()->value('id') ?? Produk::factory(),
            'nama_varian' => $this->faker->word(),
            'harga' => $this->faker->randomFloat(2, 10000, 5000000),
        ];
    }
}
