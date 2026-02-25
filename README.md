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
