<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Peminjaman extends Model
{
    protected $table = 'peminjamans';
    protected $fillable = ['nama_peminjam', 'nama_barang', 'tanggal_pinjam'];
}
