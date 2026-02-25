# 📦 NonaPinjam 

**Sistem Manajemen Peminjaman Barang Terintegrasi (Web & Mobile)**

![PHP Native](https://img.shields.io/badge/PHP-Native-777BB4?style=flat-square&logo=php)
![Java](https://img.shields.io/badge/Java-Android-007396?style=flat-square&logo=java)
![MySQL](https://img.shields.io/badge/Database-MySQL-4479A1?style=flat-square&logo=mysql)
![Status](https://img.shields.io/badge/Status-Stable-brightgreen?style=flat-square)

<br>

**NonaPinjam** adalah ekosistem manajemen inventaris dan peminjaman barang yang terdiri dari **Web Admin Dashboard** dan **Mobile Client App**. Sistem ini dirancang untuk memudahkan proses pencatatan dan pemantauan sirkulasi barang secara *real-time* yang tersinkronisasi di semua perangkat.

---

## 📊 Diagram Sistem

### 1. Use Case Diagram
Diagram ini menggambarkan hak akses antara Admin di Web dan User di Mobile.

```mermaid
graph TD
    User([User / Mahasiswa])
    Admin([Admin / Petugas])
    
    User -->|Mobile App| Login(Login Akun)
    User -->|Mobile App| Pinjam(Input Peminjaman Barang)
    User -->|Mobile App| Lihat(Lihat Status Pinjaman)
    
    Admin -->|Web| KelolaData(Kelola & Monitoring Data)
    Admin -->|Web| HapusData(Hapus Data Peminjaman)
sequenceDiagram
    participant App as Mobile App
    participant API as PHP API (smartborrow)
    participant DB as MySQL Database
    
    App->>API: POST Data (Nama, Barang, Tgl)
    API->>DB: INSERT INTO pinjaman
    DB-->>API: Success Response
    API-->>App: JSON {"status":"success"}
erDiagram
    USERS ||--o{ PINJAMAN : "melakukan"
    USERS {
        int id PK
        string name
        string email
        string password
    }
    PINJAMAN {
        int id PK
        string nama_peminjam
        string nama_barang
        date tgl_pinjam
    }
