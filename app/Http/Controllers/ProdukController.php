<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use Illuminate\Http\Request;

class ProdukController extends Controller
{
    
   
    
    /**
     * Display a listing of the resource.
     */
        // READ (menampilkan semua data produk)
    public function index()
    {
        // login admin check
        if (! session()->has('admin_id')) {
            return redirect('/login')->with('error', 'Silakan login sebagai admin untuk mengakses halaman admin.');
        }


        // Mengambil semua data produk dari database, kalau udah login sebagai admin
        $produk = Produk::all();
        return view('admin', compact('produk'));

        
    }

    /**
     * Show the form for creating a new resource.
     */
        // FORM CREATE (tambah data produk)
    public function create()
    {
        return view('project.tambah_data');
    }

    
    /**
     * Store a newly created resource in storage.
     */
        // Menyimpan data produk baru
        
    public function store(Request $request)
    {

        $filename = null;
        if ($request->hasFile('gambar_produk')) {
            $file = $request->file('gambar_produk');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('gambar_produk'), $filename);
        }

        Produk::create([
            'nama_produk' => $request->nama_produk,
            'deskripsi_produk' => $request->deskripsi_produk,
            'stok_produk' => $request->stok_produk,
            'gambar_produk' => $filename, // simpan nama file yang sudah dipindah
            'harga_produk' => $request->harga_produk,
            'tanggal_input' => date('Y-m-d H:m:s'),
        ]);
        return redirect('/admin')->with('success', 'Produk berhasil ditambahkan.');
    }


    /**
 
     */// SHOW (menampilkan detail produk)
    public function show($id)
    {
        // Cari produk berdasarkan id
        $produk = Produk::find($id);
        if (! $produk) {
            return redirect('/admin')->with('error', 'Produk tidak ditemukan.');
        }

        // Tampilkan view detail produk (lihat resources/views/project/show_produk.blade.php)
        return view('project.show_produk', compact('produk'));
    }

    /**
     * Show the form for editing the specified resource.
     * 
     */ // FORM EDIT (tampilkan form edit produk)
    public function edit($id)
    {
        // get product or redirect back with an error
        $produk = Produk::find($id);
        if (! $produk) {
            return redirect('/admin')->with('error', 'Produk tidak ditemukan.');
        }

        return view('project.edit', ['produk' => $produk]);
    }

    /**
     * Update the specified resource in storage.
     */
        // UPDATE (memperbarui data produk)
    public function update(Request $request, $id)
    {
        $produk = Produk::find($id);
        if (! $produk) {
            return redirect('/admin')->with('error', 'Produk tidak ditemukan.');
        }

        // Validasi input dan simpan hasil ke variabel untuk penggunaan berikutnya
        $data = $request->validate([
            'nama_produk' => 'required|string|max:255',
            'deskripsi_produk' => 'required|string',
            'stok_produk' => 'required|integer',
            'gambar_produk' => 'nullable|image|mimes:jpg,jpeg,png,gif,svg|max:5120',
            'harga_produk' => 'required|numeric',
            'tanggal_input' => 'nullable|date',
        ]);

        // Jika ada file gambar baru: pindahkan file baru dan hapus file lama (jika ada)
        if ($request->hasFile('gambar_produk')) {
            $file = $request->file('gambar_produk');
            // aman: ubah spasi jadi underscore pada nama file
            $filename = time() . '_' . preg_replace('/\s+/', '_', $file->getClientOriginalName());
            $file->move(public_path('gambar_produk'), $filename);

            // mengapus foto difolder jika ada
            if ($produk->gambar_produk && file_exists(public_path('gambar_produk/' . $produk->gambar_produk))) {
                @unlink(public_path('gambar_produk/' . $produk->gambar_produk));
            }

            $produk->gambar_produk = $filename;
        }

        // Update fields (pakai $data hasil validasi agar jelas)
        $produk->fill([
            'nama_produk' => $data['nama_produk'],
            'deskripsi_produk' => $data['deskripsi_produk'],
            'stok_produk' => $data['stok_produk'],
            'harga_produk' => $data['harga_produk'],
            'tanggal_input' => $data['tanggal_input'] ?? $produk->tanggal_input,
        ]);
        $produk->save();

        return redirect('/admin')->with('success', 'Produk berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
        // DELETE (menghapus data produk)
    public function destroy($id)
    {
        // Cari produk berdasarkan id
        $produk = Produk::find($id);
        if (! $produk) {
            return redirect('/admin')->with('error', 'Produk tidak ditemukan.');
        }

        // Hapus file gambar jika ada di folder
        if ($produk->gambar_produk && file_exists(public_path('gambar_produk/' . $produk->gambar_produk))) {
            @unlink(public_path('gambar_produk/' . $produk->gambar_produk));
        }

        // Hapus data produk dari database
        $produk->delete();
        return redirect('/admin')->with('success', 'Produk berhasil dihapus.');
    }


   // Mencari produk berdasarkan nama, deskripsi, atau harga 
   public function search(Request $request)
    {
      $keyword = $request->keyword;

      $produk = Produk::where('nama_produk', 'like', "%$keyword%")
                            ->orWhere('deskripsi_produk', 'like', "%$keyword%")
                            ->orWhere("harga_produk", "like","%$keyword%")
                            ->get();
         return view('admin', compact('produk'));
    }

    // LOGIS DI USER CONTROLLER YA NIH

    /**
     * user - tampilkan katalog 
     */
    public function shop()
    {
        $produk = Produk::all();
        return view('project.user', compact('produk'));
    }

    /**
     * beli produk, kurangi stok dengan if/else
     */
    public function buy(Request $request, $id)
    {
        // qty default 1; pastikan integer >= 1
        $qty = (int) $request->input('qty', 1);
        if ($qty < 1) {
            return redirect('/user')->with('error', 'Jumlah pembelian tidak valid.');
        }

        $produk = Produk::find($id);
        if (! $produk) {
            return redirect('/user')->with('error', 'Produk tidak ditemukan.');
        }

        if ($produk->stok_produk < $qty) {
            return redirect('/user')->with('error', 'Stok tidak cukup untuk pembelian.');
        }

        // Kurangi stok dan simpan (sederhana, tanpa transaksi)
        $produk->stok_produk = $produk->stok_produk - $qty;
        $produk->save();

        return redirect('/user')->with('success', 'Pembelian berhasil — stok diperbarui.');
    }

    

    


}
