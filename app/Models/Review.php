<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;

    protected $table = 'review';
    protected $fillable = ['produk_id', 'nama_user', 'rating', 'komentar'];

    public function produk()
    {
        return $this->belongsTo(Produk::class, 'produk_id');
    }
}
