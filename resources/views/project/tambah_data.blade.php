@extends('layout.template_admin')
@section('content')

<h1 class="h3 mb-4 text-gray-800">Tambah Produk</h1>

<div class="col-md-6">
    <form action="{{ url('/tambah_data') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mb-3">
            <label class="form-label">Nama Produk</label>
            <input type="text" class="form-control" name="nama_produk" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Deskripsi</label>
            <textarea class="form-control" name="deskripsi_produk" rows="3" required></textarea>
        </div>

        <div class="mb-3">
            <label class="form-label">Stok</label>
            <input type="number" class="form-control" name="stok_produk" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Gambar</label>
            <input type="file" class="form-control" name="gambar_produk" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Harga</label>
            <input type="number" class="form-control" name="harga_produk" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Tanggal Input</label>
            <input type="date" class="form-control" name="tanggal_input" required>
        </div>

        <button type="submit" class="btn btn-primary">Simpan</button>
    </form>
</div>

@endsection
