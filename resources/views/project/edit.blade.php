@extends('layout.template_admin')
@section('content')

<h1 class="h3 mb-4">Edit Produk</h1>

<div class="col-md-6">
    <form action="{{ url('/admin/' . $produk->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label class="form-label">Nama Produk</label>
            <input type="text" class="form-control" name="nama_produk" value="{{ old('nama_produk', $produk->nama_produk) }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Deskripsi</label>
            <textarea class="form-control" name="deskripsi_produk" rows="3" required>{{ old('deskripsi_produk', $produk->deskripsi_produk) }}</textarea>
        </div>

        <div class="mb-3">
            <label class="form-label">Stok</label>
            <input type="number" class="form-control" name="stok_produk" value="{{ old('stok_produk', $produk->stok_produk) }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Gambar (biarkan kosong jika tidak ingin mengganti)</label>
            <input type="file" class="form-control" name="gambar_produk">
            @if($produk->gambar_produk)
            <div class="mt-2">
                <img src="{{ asset('gambar_produk/' . $produk->gambar_produk) }}" width="100" alt="{{ $produk->nama_produk }}">
            </div>
            @endif
        </div>

        <div class="mb-3">
            <label class="form-label">Harga</label>
            <input type="number" class="form-control" name="harga_produk" value="{{ old('harga_produk', $produk->harga_produk) }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Tanggal Input</label>
            <input type="date" class="form-control" name="tanggal_input" value="{{ old('tanggal_input', optional($produk->tanggal_input)->format('Y-m-d')) }}">
        </div>

        <button type="submit" class="btn btn-primary">Update</button>
        <a href="{{ url('/admin') }}" class="btn btn-secondary">Batal</a>
    </form>
</div>

@endsection