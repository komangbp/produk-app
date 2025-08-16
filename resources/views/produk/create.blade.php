{{-- resources/views/produk/create.blade.php --}}
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Tambah Produk') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white p-6 shadow sm:rounded-lg">
                <form action="{{ route('produk.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label class="block">Nama Produk</label>
                        <input type="text" name="nama" class="border rounded w-full p-2" required>
                    </div>

                    <div class="mb-3">
                        <label class="block">Kategori</label>
                        <select name="kategori_id" class="border rounded w-full p-2">
                            @foreach($kategori as $k)
                                <option value="{{ $k->id }}">{{ $k->nama }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="block">Harga</label>
                        <input type="number" name="harga" class="border rounded w-full p-2" required>
                    </div>

                    <div class="mb-3">
                        <label class="block">Deskripsi</label>
                        <textarea name="deskripsi" class="border rounded w-full p-2"></textarea>
                    </div>

                    <button class="bg-green-500 text-white px-4 py-2 rounded">Simpan</button>
                    <a href="{{ route('produk.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded">Kembali</a>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
