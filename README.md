# 🌸 NonaPinjam 

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

### 1. Use Case Diagram 🌸
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

### 2. Activity Diagram (Alur Peminjaman Barang) 🌸
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
### 3. Entity Relationship Diagram (ERD) 🌸
Struktur tabel inti pada server MySQL

```mermaid
erDiagram
    USERS ||--o{ PINJAMAN : "melakukan"
    
    USERS {
        int id PK "Auto Increment"
        string nama "Nama Lengkap"
        string email "Email Login"
        string password "Password Hashed"
    }

    PINJAMAN {
        int id PK "Auto Increment"
        string nama_peminjam "Relasi User"
        string nama_barang "Nama Barang"
        date tgl_pinjam "Tanggal Input"
    }
```
## 🛠️ Tech Stack

### 💻 Web Backend (Command Center)
* **Language**: PHP Native
* **Database**: MySQL 8.0
* **API**: RESTful JSON Endpoint

### 📱 Mobile (Digital Client)
* **Language**: Java
* **IDE**: Android Studio
* **Networking**: Volley Library
* **UI Components**: RecyclerView, CardView, TableLayout

## 📋 User Story

Bagian ini merincikan kebutuhan fungsional dari sudut pandang pengguna sistem, baik dari sisi Mobile maupun Web Dashboard.

| ID | User Story | Target | Priority |
|---|---|---|---|
| **US-01** | Sebagai **User**, saya ingin melakukan registrasi akun baru agar bisa mengakses fitur peminjaman. | Mobile | 💖 **High** |
| **US-02** | Sebagai **User**, saya ingin melakukan login dengan aman untuk melindungi data pribadi saya. | Mobile | 💖 **High** |
| **US-03** | Sebagai **User**, saya ingin menginput data barang yang akan dipinjam beserta tanggalnya melalui HP. | Mobile | 💖 **High** |
| **US-04** | Sebagai **User**, saya ingin data yang saya input di HP otomatis sinkron dengan database server pusat. | Mobile | 💖 **High** |
---

## 📝 SRS - Feature List

Berikut adalah daftar fitur utama yang diimplementasikan dalam ekosistem **NonaPinjam**:

### 🌐 Fitur Web (Admin Dashboard)
* **Pusat Monitoring**: Halaman utama untuk memantau seluruh aktivitas peminjaman barang secara real-time.
* **Management Data**: Fitur CRUD (Create, Read, Update, Delete) untuk mengelola inventaris dan data peminjam.
* **Database Integrator**: Mengelola sinkronisasi data langsung dengan MySQL database pusat.
* **API Provider**: Menyediakan endpoint RESTful JSON untuk melayani permintaan data dari aplikasi mobile.

### 📱 Fitur Mobile (Android Client)
* **Auth System**: Fitur Login dan Registrasi User untuk keamanan akses aplikasi.
* **Live Sync Dashboard**: Menarik dan menampilkan data peminjaman terbaru dari server menggunakan **Volley Library**.
* **Input Peminjaman**: Form interaktif untuk menginput nama barang dan tanggal pinjam langsung dari HP.
* **Responsive Layout**: Antarmuka yang rapi dan nyaman dipandang menggunakan **CardView** dan **TableLayout**.

---

## 🔗 API Documentation (NonaPinjam Sync)
Endpoint ini digunakan oleh aplikasi Android (via Volley) untuk mengambil dan mengirim data peminjaman ke server MySQL.

* **Endpoint**: `http://ip-laptop-kamu/smartborrow/get_data.php`
* **Method**: `GET / POST`
* **Response Format**: `JSON`

```json
{
    "status": "SUCCESS",
    "message": "DATA_PEMINJAMAN_SYNC_COMPLETE",
    "data": [
        {
            "id": 1,
            "nama_peminjam": "User Terdaftar",
            "nama_barang": "Laptop Pro",
            "tgl_pinjam": "2026-02-25"
        }
    ]
}


Gemini berkata
Waduh, siap bosku! Saya mengerti, format yang sebelumnya memang terlihat berantakan karena terlalu banyak teks merah dan simbol yang tidak perlu.

Agar README.md kamu terlihat rapi, bersih, dan profesional di GitHub, ini adalah versi final dengan format Clean & Aesthetic (tetap dengan nuansa pink di diagram).

Silakan Copy kode di bawah ini:

Markdown
# 🌸 NonaPinjam
**Sistem Manajemen Peminjaman Barang Terintegrasi (Web & Mobile)**

---

## 🔗 API Documentation (NonaPinjam Sync)
Endpoint untuk sinkronisasi data antara Web Admin dan Mobile Android.

* **URL**: `http://ip-laptop/smartborrow/get_data.php`
* **Method**: `GET`
* **Format**: `JSON`

**Response Success (200 OK):**
```json
{
    "status": "SUCCESS",
    "message": "DATA_PEMINJAMAN_SYNC_COMPLETE",
    "data": [
        {
            "id": 1,
            "nama_peminjam": "User Terdaftar",
            "nama_barang": "Laptop Pro",
            "tgl_pinjam": "2026-02-25"
        }
    ]
}

###🚀 **Instalasi & Setup (Localhost)**
Ikuti langkah berikut agar sistem berjalan lancar di lingkungan lokal.

TAHAP 1: Konfigurasi Server (Web)
Persiapan Folder: Pindahkan folder smartborrow ke direktori C:/xampp/htdocs/.

Database: Buat database db_smartborrow di phpMyAdmin, lalu import file .sql.

Running: Pastikan Apache dan MySQL di XAMPP dalam status Running.

Akses: Buka http://localhost/smartborrow/ di browser.

TAHAP 2: Konfigurasi Klien (Mobile)
Android Studio: Buka folder proyek mobile menggunakan Android Studio.

Sync Gradle: Tunggu proses build selesai (pastikan library Volley terpasang).

PENTING! Konfigurasi IP: Ganti localhost menjadi alamat IP Laptop kamu di file Java:
