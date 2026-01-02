<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    // Model untuk tabel 'produks'
    protected $table = 'produks';
    protected $fillable = [
        'nama_produk',
        'deskripsi_produk',
        'stok_produk',
        'gambar_produk',
        'harga_produk',
        'tanggal_input',
    ];
}
