<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\AuthController;

// Route untuk menampilkan halaman shop kepada user
Route::get('/user', [ProdukController::class, 'shop']);
// halaman awal redirect ke login
Route::get('/', function () {
    return redirect('/login');
});

// Auth (sederhana)
Route::get('/login', [AuthController::class, 'showLogin']);
Route::post('/login', [AuthController::class, 'login']);
Route::get('/logout', [AuthController::class, 'logout']);



// Route untuk menampilkan data produk di halaman admin (kenapa error terus pas diadmin lupa anjay gak dikasih route)
Route::get('/admin', [ProdukController::class, 'index']);
// Route untuk menampilkan form tambah data produk
Route::get('/tambah_data', [ProdukController::class,'create']);
Route::post('/tambah_data', [ProdukController::class, 'store']);

// Route untuk menampilkan form edit produk dan memperbarui data
Route::get('/edit/{id}/edit', [ProdukController::class, 'edit']);
Route::put('/admin/{id}', [ProdukController::class, 'update']);

// Route untuk menampilkan detail produk (show)
Route::get('/produk/{id}', [ProdukController::class, 'show']);


// Route untuk menghapus produk (method DELETE digunakan oleh form di admin)
Route::delete('/admin/{id}', [ProdukController::class, 'destroy']);

// Route untuk mencari produk
Route::get('/admin/search', [ProdukController::class, 'search']);

// Buy route : kurangi stok saat user membeli (qty optional, default 1)
Route::post('/user/buy/{id}', [ProdukController::class, 'buy']);
