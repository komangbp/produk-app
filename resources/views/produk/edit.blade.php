{{-- resources/views/produk/edit.blade.php --}}
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Produk') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white p-6 shadow sm:rounded-lg">
                <form action="{{ route('produk.update', $produk) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label class="block">Nama Produk</label>
                        <input type="text" name="nama" value="{{ $produk->nama }}" class="border rounded w-full p-2" required>
                    </div>

                    <div class="mb-3">
                        <label class="block">Kategori</label>
                        <select name="kategori_id" class="border rounded w-full p-2">
                            @foreach($kategori as $k)
                                <option value="{{ $k->id }}" {{ $produk->kategori_id == $k->id ? 'selected' : '' }}>{{ $k->nama }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="block">Harga</label>
                        <input type="number" name="harga" value="{{ $produk->harga }}" class="border rounded w-full p-2" required>
                    </div>

                    <div class="mb-3">
                        <label class="block">Deskripsi</label>
                        <textarea name="deskripsi" class="border rounded w-full p-2">{{ $produk->deskripsi }}</textarea>
                    </div>

                    <button class="bg-yellow-500 text-white px-4 py-2 rounded">Update</button>
                    <a href="{{ route('produk.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded">Kembali</a>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
