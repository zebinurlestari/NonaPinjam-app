# 📦 NonaPinjam 

**Sistem Manajemen Peminjaman Barang Terintegrasi (Web & Mobile)**

![PHP Native](https://img.shields.io/badge/PHP-Native-777BB4?style=flat-square&logo=php)
![Java](https://img.shields.io/badge/Java-Android-007396?style=flat-square&logo=java)
![MySQL](https://img.shields.io/badge/Database-MySQL-4479A1?style=flat-square&logo=mysql)
![Status](https://img.shields.io/badge/Status-Stable-brightgreen?style=flat-square)

<br>

**NonaPinjam** adalah aplikasi untuk meminjam inventaris asrama putri yang terdiri dari **Web Admin Dashboard** dan **Mobile Client App**. Sistem ini dirancang untuk memudahkan proses pencatatan dan pemantauan sirkulasi barang secara *real-time* yang tersinkronisasi di semua perangkat.

---

## 📊 Diagram Sistem

### 1. Use Case Diagram
Diagram ini menggambarkan hak akses antara Admin di Web dan User di Mobile.

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
