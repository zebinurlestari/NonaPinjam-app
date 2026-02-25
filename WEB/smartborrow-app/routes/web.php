<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\AuthController;
// BARIS DI BAWAH INI ADALAH KUNCI UNTUK MEMPERBAIKI ERROR KAMU:
use App\Http\Controllers\PeminjamanController;

Route::get('/', function () {
    // 1. Cek jika ada permintaan ganti bahasa dari URL (?lang=...)
    if (request()->has('lang')) {
        $lang = request('lang');
        Session::put('locale', $lang); 
    }

    // 2. Ambil bahasa dari Session, kalau kosong defaultnya 'id'
    $locale = Session::get('locale', 'id');
    App::setLocale($locale);

    return view('auth.login');
});

// Rute Login & Register (Fitur lama kamu tetap aman)
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/logout', [AuthController::class, 'logout']);

Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);

// Proteksi Halaman Pinjam (Sekarang tidak akan error lagi)
Route::middleware('auth')->group(function () {
    Route::get('/pinjam', [PeminjamanController::class, 'index'])->name('pinjam.index');
    Route::post('/pinjam', [PeminjamanController::class, 'store'])->name('pinjam.store');
    Route::delete('/pinjam/{id}', [PeminjamanController::class, 'destroy'])->name('pinjam.destroy');
    Route::put('/pinjam/{id}', [PeminjamanController::class, 'update'])->name('pinjam.update');
});