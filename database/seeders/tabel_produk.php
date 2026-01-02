<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\produk;

class tabel_produk extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'nama_produk' => 'BLUE LOCK',
                'deskripsi_produk' => 'Manga tentang sepak bola tapi harus skizo parah biar jago',
                'stok_produk' => 100,
                'gambar_produk' => 'Blue lock_MANGA.jpg',
                'harga_produk' => 50000,
                'tanggal_input' => now(),
            ],
            [
                'nama_produk' => 'RTX 4070 TI',
                'deskripsi_produk' => 'Kartu grafis terbaru dari PSTI',
                'stok_produk' => 150,
                'gambar_produk' => 'g3.jpeg',
                'harga_produk' => 10000000,
                'tanggal_input' => now(),
            ],
            [
                'nama_produk' => 'Laptop ASUS ROG STIX g16',
                'deskripsi_produk' => 'Bisa rata kanan',
                'stok_produk' => 10,
                'gambar_produk' => 'laptop.jpg',
                'harga_produk' => 12000000,
                'tanggal_input' => now(),
            ],
            // data awal
        ];
        Produk::insert($data);
    }
}
