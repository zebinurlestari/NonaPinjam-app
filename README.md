# 🎀 NonaPinjam App (SmartBorrow System)
Aplikasi manajemen peminjaman barang asrama putri berbasis web untuk pendataan yang lebih transparan dan teratur.

---

## 📑 1. Deskripsi Proyek
NonaPinjam adalah sistem informasi yang dikembangkan untuk mendigitalkan proses peminjaman barang di asrama putri. Proyek ini menggunakan **PHP Prosedural** dengan database **MySQL**.

## 🚀 2. Fitur Utama
* **Autentikasi User**: Login dan registrasi untuk keamanan akses.
* **Dashboard Dinamis**: Sapaan personal sesuai user yang login.
* **Form Peminjaman**: Penginputan Nama, NIM, Barang, dan Tanggal.
* **Monitoring Tabel**: Daftar transaksi peminjaman secara real-time.

## 📂 3. Struktur File
* `config.php`: Koneksi database.
* `login.php` & `logout.php`: Manajemen sesi user.
* `index.php`: Dashboard & Form utama.
* `peminjaman.php`: Proses CRUD data.
* `daftar_peminjaman.php`: Tabel riwayat pinjaman.

## 📊 4. Activity Diagram
Alur proses dari login hingga simpan data peminjaman:

```mermaid
flowchart TD
    Start([Start]) --> Login[Halaman Login]
    Login --> PunyaAkun{Sudah Punya Akun?}
    
    PunyaAkun -- Tidak --> Register[Register New Account]
    Register --> Login
    
    PunyaAkun -- Ya --> Auth[Input Email & Password]
    Auth --> Val{Validasi Database}
    Val -- Gagal --> Login
    
    Val -- Sukses --> Dash[Dashboard NonaPinjam]
    Dash --> Action{Pilih Aktivitas}
    
    Action -- Ajukan Pinjaman --> Form[Isi Nama, Barang, Tanggal]
    Action -- Kelola Data --> Table[Lihat Tabel Data]
    
    Form --> Simpan[Simpan ke Database]
    Simpan --> Dash
    
    Dash --> Logout[Klik Logout]
    Logout --> End([End])

