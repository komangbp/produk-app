{{-- resources/views/produk/show.blade.php --}}
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Detail Produk') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white p-6 shadow sm:rounded-lg">
                <p><strong>Nama:</strong> {{ $produk->nama }}</p>
                <p><strong>Kategori:</strong> {{ $produk->kategori->nama ?? '-' }}</p>
                <p><strong>Harga:</strong> Rp {{ number_format($produk->harga, 0, ',', '.') }}</p>
                <p><strong>Deskripsi:</strong> {{ $produk->deskripsi }}</p>

                <div class="mt-4">
                    <a href="{{ route('produk.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded">Kembali</a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
