{{-- resources/views/produk/index.blade.php --}}
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Daftar Produk') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm sm:rounded-lg p-6">

                @if (session('success'))
                    <div class="bg-green-100 text-green-800 p-2 rounded mb-3">
                        {{ session('success') }}
                    </div>
                @endif

                <a href="{{ route('produk.create') }}"
                    class="bg-blue-500 hover:bg-blue-600 text-white px-3 py-2 rounded mb-3 inline-block">+ Tambah
                    Produk</a>

                <form method="GET" action="{{ route('produk.index') }}" class="mb-4 flex">
                    <input type="text" name="search" value="{{ $search ?? '' }}" placeholder="Cari produk..."
                        class="border rounded-l p-2 w-full">
                    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-r">Cari</button>
                </form>

                <table class="table-auto w-full border">
                    <thead>
                        <tr class="bg-gray-100">
                            <th class="px-4 py-2 border">Nama</th>
                            <th class="px-4 py-2 border">Kategori</th>
                            <th class="px-4 py-2 border">Harga</th>
                            <th class="px-4 py-2 border">Deskripsi</th>
                            <th class="px-4 py-2 border text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($produks as $produk)
                            <tr>
                                <td class="border px-4 py-2">{{ $produk->nama }}</td>
                                <td class="border px-4 py-2">{{ $produk->kategori->nama ?? '-' }}</td>
                                <td class="border px-4 py-2">Rp {{ number_format($produk->harga, 0, ',', '.') }}</td>
                                <td class="border px-4 py-2">{{ $produk->deskripsi }}</td>
                                <td class="border px-4 py-2 text-center space-x-2">
                                    <a href="{{ route('produk.show', $produk) }}"
                                        class="bg-blue-500 text-white px-2 py-1 rounded">Detail</a>
                                    <a href="{{ route('produk.edit', $produk) }}"
                                        class="bg-yellow-500 text-white px-2 py-1 rounded">Edit</a>
                                    <form action="{{ route('produk.destroy', $produk) }}" method="POST"
                                        class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button class="bg-red-500 text-white px-2 py-1 rounded"
                                            onclick="return confirm('Yakin hapus produk?')">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center py-3">Belum ada produk</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>

                <div class="mt-4">
                    {{ $produks->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
