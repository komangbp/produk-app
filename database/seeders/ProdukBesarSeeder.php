<?php

// database/seeders/ProdukBesarSeeder.php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Kategori;
use App\Models\Produk;
use App\Models\ProdukVarian;
use App\Models\Review;

class ProdukBesarSeeder extends Seeder
{
    public function run(): void
    {
        // 1️⃣ Buat kategori tetap
        $daftarKategori = ['Elektronik', 'Fashion', 'Buku', 'Olahraga', 'Rumah Tangga'];
        foreach ($daftarKategori as $nama) {
            Kategori::create(['nama' => $nama]);
        }

        // 2️⃣ Buat 1000 produk
        Produk::factory(1000)->create()->each(function ($produk) {
            // 3️⃣ Tambah 1–5 varian untuk tiap produk
            ProdukVarian::factory(rand(1, 5))->create([
                'produk_id' => $produk->id
            ]);

            // 4️⃣ Tambah 1–3 review untuk tiap produk
            Review::factory(rand(1, 3))->create([
                'produk_id' => $produk->id
            ]);
        });
    }
}
