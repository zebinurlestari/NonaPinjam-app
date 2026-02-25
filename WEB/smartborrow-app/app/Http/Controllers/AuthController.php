<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User; // Mengimpor model User agar registrasi lancar
use Illuminate\Support\Facades\Hash; // Untuk keamanan password

class AuthController extends Controller
{
    // 1. Menampilkan halaman Login
    public function showLogin() {
        return view('login');
    }

    // 2. Memproses Login
    public function login(Request $request) {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            // Jika sukses, masuk ke halaman pinjam barang
            return redirect('/pinjam');
        }

        // Jika gagal, balik ke login dengan pesan error
        return back()->with('error', 'Email atau Password salah!');
    }

    // 3. Menampilkan halaman Register (Daftar Akun)
    public function showRegister() {
        return view('auth.register'); // Pastikan file ini ada di resources/views/auth/register.blade.php
    }

    // 4. Memproses pendaftaran user baru ke MySQL
    public function register(Request $request) {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed', // 'confirmed' butuh input password_confirmation di view
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password), // Password diacak agar aman di database
        ]);

        return redirect('/login')->with('success', 'Registrasi berhasil! Silakan login.');
    }

    // 5. Keluar dari aplikasi
    public function logout() {
        Auth::logout();
        return redirect('/login');
    }
}