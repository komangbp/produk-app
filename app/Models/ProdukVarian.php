<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProdukVarian extends Model
{
    use HasFactory;

    protected $table = 'varian_produk';
    protected $fillable = ['produk_id', 'nama_varian', 'harga'];

    public function produk()
    {
        return $this->belongsTo(Produk::class, 'produk_id');
    }
}
