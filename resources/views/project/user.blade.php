@extends('layout.template_user')
@section('content')
<link rel="stylesheet" href="/css/style.css">
    <h1 align="center">Selamat Datang Pada Toko Naquinity!</h1>

    @if(session('success'))
        <div style="text-align:center;background:#e6ffed;border:1px solid #b6f2c8;padding:8px;border-radius:6px;margin:14px auto;color:#11632a;">{{ session('success') }}</div>
    @endif
    @if(session('error'))
        <div style="text-align:center;background:#fff3f3;border:1px solid #f1c2c2;padding:8px;border-radius:6px;margin:14px auto;color:#a33;">{{ session('error') }}</div>
    @endif

    <div class="produk">
        @forelse($produk as $p)
        <div class="produk-item">
                  <!-- ngambil dari database -->
            @if($p->gambar_produk && file_exists(public_path('gambar_produk/'.$p->gambar_produk)))
                <img src="/gambar_produk/{{ $p->gambar_produk }}" alt="{{ $p->nama_produk }}">
            @else
                <div style="height:140px;display:flex;align-items:center;justify-content:center;color:#999">No Image</div>
            @endif

            <h3>{{ $p->nama_produk }}</h3>
            <p>{{ \Illuminate\Support\Str::limit($p->deskripsi_produk, 70) }}</p>
            <p style="font-weight:700">Rp {{ number_format($p->harga_produk,0,',','.') }}</p>
            <p style="color:#cfcfcf">Stok: {{ $p->stok_produk }}</p>

            <div style="display:flex;gap:8px;justify-content:center;margin-top:10px">
                @if($p->stok_produk > 0)
                <form action="/user/buy/{{ $p->id }}" method="POST" style="display:flex;gap:8px;align-items:center">
                    @csrf
                    <input type="number" name="qty" min="1" value="1" style="width:70px;padding:6px;border:1px solid #e6e6e6;border-radius:6px;font-size:14px;color:#111">
                    <button type="submit">Beli</button>
                </form>
                @else
                <button disabled>Beli</button>
                @endif
            </div>
        </div>
        @empty
            <p style="width:100%;text-align:center;color:#666;margin-top:20px">Belum ada produk.</p>
        @endforelse
    </div>

@endsection