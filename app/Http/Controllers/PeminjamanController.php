<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Peminjaman; // Import Model agar bisa dipanggil langsung

class PeminjamanController extends Controller
{
    // Menampilkan halaman form sekaligus daftar data
    public function index()
    {
        $peminjamans = Peminjaman::all(); // Mengambil semua data
        return view('pinjam', compact('peminjamans'));
    }

    // Menyimpan data dan kembali ke halaman sebelumnya
    public function store(Request $request)
    {
        Peminjaman::create($request->all()); // Simpan data menggunakan Model
        return redirect('/pinjam')->with('success', 'Data Berhasil Disimpan!');
    }

    // Fungsi untuk menghapus data
    public function destroy($id)
    {
        Peminjaman::destroy($id); // Lebih rapi tanpa \App\Models\ karena sudah di-import
        return redirect('/pinjam')->with('success', 'Data Berhasil Dihapus!');
    }

    // Fungsi untuk menyimpan perubahan (Update)
    public function update(Request $request, $id)
    {
        $peminjaman = Peminjaman::findOrFail($id); // Mencari data berdasarkan ID
        $peminjaman->update($request->all()); // Simpan perubahan
        return redirect('/pinjam')->with('success', 'Data Berhasil Diperbarui!');
    }
}
