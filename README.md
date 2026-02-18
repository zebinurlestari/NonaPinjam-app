# 🎀 NonaPinjam App (SmartBorrow System)
Aplikasi manajemen peminjaman barang asrama berbasis web yang dirancang untuk mempermudah pendataan peminjaman inventaris secara digital, transparan, dan terorganisir.

---

## 📑 1. Latar Belakang
Proyek ini dibuat untuk memudahkan taruni meminjam barang asrama dengan lebih teorganisir dan terjamin untuk peminjaman dan pengembalian karena semua tercatat di web NonaPinjam.

## 🚀 2. Fitur Utama
* **Autentikasi Ganda**: Sistem login dan registrasi akun untuk memastikan hanya penghuni resmi yang bisa mengakses dashboard.
* **Dashboard Personal**: Menampilkan sapaan dinamis berdasarkan sesi user yang sedang aktif.
* **Form Peminjaman Terintegrasi**: Pengguna dapat menginput nama, NIM, nama barang, dan tanggal peminjaman dalam satu formulir.
* **Tabel Monitoring Real-Time**: Daftar riwayat peminjaman yang dilengkapi dengan status barang (Dipinjam/Kembali) untuk memudahkan kontrol.

## 📂 3. Struktur Folder & File
Berikut adalah arsitektur file yang digunakan dalam pengembangan sistem ini:
* `config.php`: Berisi script koneksi antara PHP dan database MySQL.
* `login.php` & `register.php`: Menangani proses autentikasi dan pendaftaran user baru.
* `index.php`: Halaman dashboard utama yang menggabungkan fitur input dan tabel monitoring.
* `peminjaman.php`: Logika pemrosesan data (Create, Update, Delete) ke database.
* `logout.php`: Menghapus sesi aktif untuk keamanan akun.

## 📊 4. Analisis Sistem

### A. Activity Diagram
Alur kerja sistem dari proses masuk hingga pengelolaan data:

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
