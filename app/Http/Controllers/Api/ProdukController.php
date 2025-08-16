<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProdukIndexRequest;
use App\Http\Resources\ProdukResource;
use App\Models\Produk;
use Illuminate\Support\Facades\Cache;

class ProdukController extends Controller
{
    public function index(ProdukIndexRequest $request)
    {
        $q = $request->validated();

        // Normalisasi param (Indonesia/Inggris)
        $term       = $q['cari']       ?? $q['search']     ?? null;
        $kategori   = $q['kategori']   ?? $q['category']   ?? null;
        $min        = $q['harga_min']  ?? $q['min_price']  ?? null;
        $max        = $q['harga_maks'] ?? $q['max_price']  ?? null;
        $page       = (int)($q['halaman'] ?? $q['page']  ?? 1);
        $limit      = (int)($q['batas']   ?? $q['limit'] ?? 10);
        $sortField  = $q['urut']         ?? $q['sort']  ?? null;   // nama/harga/dibuat vs name/price/created_at
        $sortDir    = $q['arah']         ?? $q['order'] ?? 'asc';

        // Key cache (ikutkan semua parameter & halaman)
        $cacheKey = 'produk:' . md5(json_encode([
            'term' => $term,
            'kategori' => $kategori,
            'min' => $min,
            'max' => $max,
            'page' => $page,
            'limit' => $limit,
            'sortField' => $sortField,
            'sortDir' => $sortDir
        ]));

        // Durasi cache (detik) — sesuaikan kebutuhan
        $ttl = 60;

        $paginator = Cache::remember($cacheKey, $ttl, function () use ($term, $kategori, $min, $max, $sortField, $sortDir, $limit, $q) {
            return Produk::query()
                ->denganDasar()
                ->cariNama($term)
                ->kategoriNama($kategori)
                ->hargaAntara($min, $max)
                ->urutkan($sortField, $sortDir)
                ->paginate($limit)
                ->appends($q);
        });

        return ProdukResource::collection($paginator)->additional([
            'status'  => 'sukses',
            'filter'  => [
                'cari'       => $term,
                'kategori'   => $kategori,
                'harga_min'  => $min,
                'harga_maks' => $max,
                'urut'       => $sortField,
                'arah'       => $sortDir,
            ],
        ]);
    }
}
