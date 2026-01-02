@extends('layout.template_admin')
@section('content')

<h1 class="h3 mb-4">Detail Produk</h1>

<div class="card" style="max-width:900px">
  <div class="card-body d-flex gap-4">
    <div style="flex:0 0 180px;">
      @if($produk->gambar_produk)
        <img src="{{ asset('gambar_produk/' . $produk->gambar_produk) }}" alt="{{ $produk->nama_produk }}" style="width:160px; height:200px; object-fit:cover;">
      @else
        <div class="text-muted">No image</div>
      @endif
    </div>

    <div style="flex:1 1 auto;">
      <h3>{{ $produk->nama_produk }}</h3>
      <p><strong>Deskripsi:</strong></p>
      <p>{{ $produk->deskripsi_produk }}</p>
      <p><strong>Stok:</strong> {{ $produk->stok_produk }}</p>
      <p><strong>Harga:</strong> Rp {{ number_format($produk->harga_produk, 0, ',', '.') }}</p>
      <p><strong>Tanggal Input:</strong> {{ $produk->tanggal_input ? \Carbon\Carbon::parse($produk->tanggal_input)->format('Y-m-d') : '-' }}</p>

      <div class="mt-3">
        <a href="{{ url('/edit/'.$produk->id.'/edit') }}" class="btn btn-warning btn-sm">Edit</a>
        <a href="{{ url('/admin') }}" class="btn btn-secondary btn-sm">Kembali</a>
      </div>
    </div>
  </div>
</div>

@endsection
