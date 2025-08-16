<?php

namespace Tests\Feature;

use App\Models\Kategori;
use App\Models\Produk;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProdukApiTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        // Buat data awal
        $kategori = Kategori::factory()->create(['nama' => 'Elektronik']);
        Produk::factory()->count(20)->create(['kategori_id' => $kategori->id]);
    }

    public function test_dapat_mengambil_semua_produk()
    {
        $response = $this->getJson('/api/products');
        $response->assertStatus(200)
                 ->assertJsonStructure([
                     'data' => [
                         '*' => ['id', 'nama', 'kategori', 'harga']
                     ]
                 ]);
    }

    public function test_dapat_mencari_produk()
    {
        $produk = Produk::first();
        $response = $this->getJson('/api/products?cari=' . urlencode($produk->nama));
        $response->assertStatus(200)
                 ->assertJsonFragment(['nama' => $produk->nama]);
    }

    public function test_dapat_filter_kategori()
    {
        $response = $this->getJson('/api/products?kategori=Elektronik');
        $response->assertStatus(200);
    }

    public function test_dapat_sorting_harga_desc()
    {
        $response = $this->getJson('/api/products?urut=harga&arah=desc');
        $response->assertStatus(200);
    }

    public function test_dapat_pagination()
    {
        $response = $this->getJson('/api/products?batas=5&halaman=2');
        $response->assertStatus(200);
    }
}
