<?php

namespace Database\Factories;

use App\Models\Produk;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Review>
 */
class ReviewFactory extends Factory
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
            'nama_user' => $this->faker->name(),
            'rating' => $this->faker->numberBetween(1, 5),
            'komentar' => $this->faker->sentence(),
        ];
    }
}
