<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Produk extends Model
{
    use HasFactory;

    protected $table = 'produk';
    protected $fillable = ['nama', 'kategori_id', 'deskripsi', 'harga'];

    /** Relasi */
    public function kategori()
    {
        return $this->belongsTo(Kategori::class, 'kategori_id');
    }

    public function varian()
    {
        return $this->hasMany(ProdukVarian::class, 'produk_id');
    }

    public function review()
    {
        return $this->hasMany(Review::class, 'produk_id');
    }

    /** Scopes */

    // Pencarian nama (menerima 'cari' atau 'search')
    public function scopeCariNama($query, ?string $term)
    {
        if (!empty($term)) {
            $query->where('nama', 'like', "%{$term}%");
        }
        return $query;
    }

    // Filter kategori berdasarkan NAMA kategori (menerima 'kategori' atau 'category')
    public function scopeKategoriNama($query, ?string $namaKategori)
    {
        if (!empty($namaKategori)) {
            $query->whereHas('kategori', fn($q) => $q->where('nama', $namaKategori));
        }
        return $query;
    }

    // Filter rentang harga (menerima harga_min/harga_maks atau min_price/max_price)
    public function scopeHargaAntara($query, $min = null, $max = null)
    {
        if ($min !== null && $max !== null) {
            return $query->whereBetween('harga', [$min, $max]);
        }
        if ($min !== null) {
            return $query->where('harga', '>=', $min);
        }
        if ($max !== null) {
            return $query->where('harga', '<=', $max);
        }
        return $query;
    }

    // Sorting whitelist (menerima 'urut'/'sort' & 'arah'/'order')
    public function scopeUrutkan($query, ?string $field, ?string $direction)
    {
        // peta field Indonesia -> kolom DB
        $map = [
            'harga'      => 'harga',
            'nama'       => 'nama',
            'dibuat'     => 'created_at',
            'created_at' => 'created_at',
            'price'      => 'harga',
            'name'       => 'nama',
        ];

        $kolom = $map[$field] ?? null;
        $direction = strtolower($direction ?? 'asc');
        $direction = in_array($direction, ['asc','desc']) ? $direction : 'asc';

        if ($kolom) {
            $query->orderBy($kolom, $direction);
        }
        return $query;
    }

    // Eager loading + agregasi rating
    public function scopeDenganDasar($query)
    {
        return $query
            ->with(['kategori'])
            ->withCount('review')
            ->withAvg('review', 'rating'); // menghasilkan review_avg_rating
    }
}
