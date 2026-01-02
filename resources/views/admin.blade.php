@extends('layout.template_admin')
@section('content')


<h1 align="center" class="display-font">Selamat Datang Pada Control Panel!</h1>

<!--begin::App Main-->
      <main class="app-main">
        <!--begin::App Content Header-->
        <div class="app-content-header">
          <!--begin::Container-->
          <div class="container-fluid">
            <!--begin::Row-->
            <div class="row">
              <div class="col-sm-6">
                <h3 class="mb-3">Admin selalu memantau membernya</h3>
                <a href="/tambah_data">
                  <button class="btn-sm btn btn-primary">Tambah Data</button>
                </a>
              </div>
              
              <div class="col-sm-6 d-flex flex-column align-items-end">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item active" aria-current="page">Data Barang</li>
                </ol>
                <form class="mt-2" method="get">
                  <div class="input-group">
                  <input 
                    type="text" 
                    class="form-control" 
                    name="keyword" 
                    placeholder="Cari produk..."
                  >
                  <button class="btn btn-primary" type="submit" name="tombol_search">
                    <i class="bi bi-search"></i> Cari
                  </button>
                </div>
                </form>
              </div>
            </div>
            <!--end::Row-->
          </div>
          <!--end::Container-->
        </div>
        <!--end::App Content Header-->
        <!--begin::App Content-->
        <div class="app-content tabel">
          <!--begin::Container-->
          <div class="container-fluid">
            <!--begin::Row-->
            <div class="row">
              <!--begin::Col-->
              <div class="col">
              <!-- =============== ISI TABEL ADA DI SINI =============== -->
              <div class="table-responsive">  
                <table class="table table-striped table-hover ">
                    <thead>
                    <tr>
                      <th>No.</th>
                      <th>ID Produk</th>
                      <th>Nama Produk</th>
                      <th>Deskripsi</th>
                      <th>Stok</th>
                      <th>Gambar</th>
                      <th>Harga</th>
                      <th>Tanggal Input</th>
                      <th>Aksi</th>
                    </tr>
                    </thead>
                    <tbody>
                      @foreach ($produk as $p)
                      <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $p->id }}</td>
                        <td>{{ $p->nama_produk }}</td>
                        <td>{{ $p->deskripsi_produk }}</td>
                        <td>{{ $p->stok_produk }}</td>
                        <td><img src="{{ asset('gambar_produk/' . $p->gambar_produk) }}" alt="{{ $p->nama_produk }}" style="width:80px; height:100px; object-fit:cover;" ></td>
                        <td>Rp {{ number_format($p->harga_produk, 0, ',', '.') }}</td>
                        <td>{{ $p->tanggal_input }}</td>
                        <td>
                          <!-- Tombol Aksi: Show, Edit, Delete -->
                          <a href="/produk/{{ $p->id }}" class="btn btn-info btn-sm">Show</a>
                          <a href="/edit/{{ $p->id }}/edit" class="btn btn-warning btn-sm">Edit</a>
                          <form action="/admin/{{ $p->id }}" method="POST" style="display:inline-block;" onsubmit="return confirm('Apakah Anda yakin ingin menghapus produk ini?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                          </form>
                          <!-- End Tombol Aksi -->
                        </td>
                      </tr>
                      @endforeach
                    </tbody>
                  </table>
              </div>
              <!--end::Col-->
            </div>
            <!--end::Row-->
          </div>
          <!--end::Container-->
        </div>
        <!--end::App Content-->
      </main>

@endsection