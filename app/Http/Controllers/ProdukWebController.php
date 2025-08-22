<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use App\Models\Kategori;
use Illuminate\Http\Request;

class ProdukWebController extends Controller
{
    /**
     * Tampilkan daftar produk dengan pagination + search
     */
    public function index(Request $request)
    {
        $search = $request->input('search');

        $produks = Produk::with('kategori')
            ->when($search, function ($query, $search) {
                return $query->where('nama', 'like', "%{$search}%")
                    ->orWhereHas('kategori', function ($q) use ($search) {
                        $q->where('nama', 'like', "%{$search}%");
                    });
            })
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('produk.index', compact('produks', 'search'));
    }

    /**
     * Form tambah produk
     */
    public function create()
    {
        $kategori = Kategori::all();
        return view('produk.create', compact('kategori'));
    }

    /**
     * Simpan produk baru
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'kategori_id' => 'required|exists:kategori,id',
            'harga' => 'required|numeric|min:0',
            'deskripsi' => 'nullable|string',
        ]);

        Produk::create($request->all());

        return redirect()->route('produk.index')->with('success', 'Produk berhasil ditambahkan!');
    }

    /**
     * Tampilkan detail produk
     */
    public function show(Produk $produk)
    {
        $produk->load('kategori');
        return view('produk.show', compact('produk'));
    }

    /**
     * Form edit produk
     */
    public function edit(Produk $produk)
    {
        $kategori = Kategori::all();
        return view('produk.edit', compact('produk', 'kategori'));
    }

    /**
     * Update produk
     */
    public function update(Request $request, Produk $produk)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'kategori_id' => 'required|exists:kategori,id',
            'harga' => 'required|numeric|min:0',
            'deskripsi' => 'nullable|string',
        ]);

        $produk->update($request->all());

        return redirect()->route('produk.index')->with('success', 'Produk berhasil diperbarui!');
    }

    /**
     * Hapus produk
     */
    public function destroy(Produk $produk)
    {
        $produk->delete();
        return redirect()->route('produk.index')->with('success', 'Produk berhasil dihapus!');
    }
}
