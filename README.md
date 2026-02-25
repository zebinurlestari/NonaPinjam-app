# 📦 NonaPinjam 

**Sistem Manajemen Peminjaman Barang Terintegrasi (Web & Mobile)**

![PHP Native](https://img.shields.io/badge/PHP-Native-777BB4?style=flat-square&logo=php)
![Java](https://img.shields.io/badge/Java-Android-007396?style=flat-square&logo=java)
![MySQL](https://img.shields.io/badge/Database-MySQL-4479A1?style=flat-square&logo=mysql)
![Status](https://img.shields.io/badge/Status-Stable-brightgreen?style=flat-square)

<br>

**NonaPinjam** adalah aplikasi untuk meminjam inventaris asrama putri yang terdiri dari **Web Admin Dashboard** dan **Mobile Client App**. Sistem ini dirancang untuk memudahkan proses pencatatan dan pemantauan sirkulasi barang secara *real-time* yang tersinkronisasi di semua perangkat.

---
<div align="center">
  <img src="https://img.shields.io/badge/Status-Pink_Vibes-FF69B4?style=for-the-badge" />
</div>

> [!NOTE]
> ### 🌸 Deskripsi Proyek
> NonaPinjam adalah aplikasi digital terintegrasi yang dirancang untuk peminjaman barang secara efisien. Proyek ini menggabungkan platform Web Admin sebagai pusat kendali data dan Aplikasi Mobile Android sebagai antarmuka utama bagi pengguna untuk melakukan transaksi peminjaman secara portabel. Dengan sinkronisasi real-time, setiap aktivitas yang dilakukan di aplikasi mobile akan langsung tercatat dalam basis data pusat.

> ### 🎯 Tujuan Utama
> Digitalisasi Inventaris: Menggantikan sistem pencatatan manual berbasis kertas dengan basis data MySQL yang terstruktur dan mudah diakses.

Efisiensi Manajemen: Mempermudah Biro Asrama Putri untuk mengoordinasi inventaris Asrama Putri 

Aksesibilitas Pengguna: Memberikan kemudahan bagi pengguna (mahasiswa/staf) untuk mendaftar akun dan menginput data peminjaman langsung dari device mereka.

Integritas Data: Menjamin keamanan akun pengguna melalui sistem autentikasi login dan registrasi yang terenkripsi.

Sinkronisasi Lintas Platform: Menghubungkan aplikasi Android dengan server lokal menggunakan REST API untuk pertukaran data yang cepat dan akurat.

## 📊 Diagram Sistem

### 1. Use Case Diagram
Diagram ini menggambarkan hak akses User di Mobile.

```mermaid
graph LR
    User((User / Mahasiswa))
    
    subgraph "Aplikasi NonaPinjam (Mobile)"
    UC1(Registrasi Akun)
    UC2(Login Akun)
    UC3(Input Peminjaman Barang)
    
    UC2 -.-> |include| UC3
    end
    
    User --> UC1
    User --> UC2
    
    style User fill:#FFB6C1,stroke:#FF69B4
    style UC1 fill:#FFF0F5,stroke:#FFB6C1
    style UC2 fill:#FFF0F5,stroke:#FFB6C1
    style UC3 fill:#FFF0F5,stroke:#FFB6C1
```

### 2. Activity Diagram (Alur Peminjaman Barang)
Diagram ini menjelaskan langkah-langkah yang dilakukan User di dalam aplikasi Mobile.

```mermaid
stateDiagram-v2
    [*] --> BukaAplikasi
    
    state "Halaman Auth" as Auth {
        BukaAplikasi --> CekAkun
        CekAkun --> Register : Belum Punya Akun
        Register --> Login
        CekAkun --> Login : Sudah Punya Akun
    }
    
    Login --> Dashboard : Berhasil Masuk
    
    state "Proses Input Data" as Input {
        Dashboard --> FormInput : Klik Tambah Pinjaman
        FormInput --> KirimData : Isi Nama & Barang
        KirimData --> API_PHP : Kirim via Volley
    }
    
    state "Server & Database" as Server {
        API_PHP --> MySQL : Simpan ke db_smartborrow
        MySQL --> ResponJSON : Data Tersimpan
    }
    
    ResponJSON --> Dashboard : Tampilkan Toast Berhasil
    Dashboard --> [*]

    %% Styling Warna Pink
    style Auth fill:#FFB6C1,stroke:#FF69B4
    style Input fill:#FFC0CB,stroke:#FF69B4
    style Server fill:#FFF0F5,stroke:#FFB6C1
```
