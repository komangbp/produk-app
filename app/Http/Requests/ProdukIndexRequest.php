<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProdukIndexRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true; // proteksi dengan auth:sanctum di routes
    }

    public function rules(): array
    {
        return [
            'cari'        => ['nullable', 'string', 'max:255'],
            'search'      => ['nullable', 'string', 'max:255'],
            'kategori'    => ['nullable', 'string', 'max:255'],
            'category'    => ['nullable', 'string', 'max:255'],
            'harga_min'   => ['nullable', 'numeric', 'min:0'],
            'harga_maks'  => ['nullable', 'numeric', 'min:0'],
            'min_price'   => ['nullable', 'numeric', 'min:0'],
            'max_price'   => ['nullable', 'numeric', 'min:0'],
            'halaman'     => ['nullable', 'integer', 'min:1'],
            'page'        => ['nullable', 'integer', 'min:1'],
            'batas'       => ['nullable', 'integer', 'min:1', 'max:100'],
            'limit'       => ['nullable', 'integer', 'min:1', 'max:100'],
            'urut'        => ['nullable', 'string', 'max:50'], // nama/harga/dibuat
            'sort'        => ['nullable', 'string', 'max:50'], // name/price/created_at
            'arah'        => ['nullable', 'in:asc,desc'],
            'order'       => ['nullable', 'in:asc,desc'],
        ];
    }

    public function messages(): array
    {
        return [
            'arah.in'  => 'Arah pengurutan hanya boleh: asc atau desc.',
            'order.in' => 'Order hanya boleh: asc atau desc.',
        ];
    }
}
