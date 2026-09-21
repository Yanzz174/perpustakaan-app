# 📚 Perpustakaan Digital SMK

Aplikasi Manajemen Perpustakaan Berbasis Web yang Modern, Responsif, dan Interaktif. Dibangun menggunakan **Laravel 13**, **Tailwind CSS**, dan **Alpine.js** dengan dukungan penuh **Mode Gelap/Terang** (Dark/Light Mode) serta antarmuka berbasis Pop-Up Modal interaktif.

![Laravel](https://img.shields.io/badge/Laravel-13.x-FF2D20?style=for-the-badge&logo=laravel&logoColor=white)
![Tailwind CSS](https://img.shields.io/badge/Tailwind_CSS-3.x-38B2AC?style=for-the-badge&logo=tailwind-css&logoColor=white)
![Alpine.js](https://img.shields.io/badge/Alpine.js-3.x-8BC0D0?style=for-the-badge&logo=alpine.js&logoColor=black)
![MySQL](https://img.shields.io/badge/MySQL-8.0-00000F?style=for-the-badge&logo=mysql&logoColor=white)
![Build Status](https://img.shields.io/badge/CI%2FCD-GitHub_Actions-brightgreen?style=for-the-badge&logo=githubactions)

---

## 🎯 Fitur Utama

### 🔍 Untuk Pengunjung (Public)
- **Katalog Buku Interactive** — Cari koleksi buku berdasarkan judul atau pengarang dengan pagination dan status ketersediaan stok.
- **Pengecekan Peminjaman** — Cek riwayat dan status peminjaman siswa berbasis NISN.
- **Pengajuan Pinjaman Mandiri** — Ajukan peminjaman buku secara online melalui formulir publik.
- **Responsive & Dark Mode** — Tampilan fleksibel untuk berbagai ukuran layar dengan skema warna Slate/Indigo yang mendukung mode gelap.

### 🛠️ Untuk Admin/Petugas (Dashboard)
- **Dashboard Ringkasan** — Statistik real-time total buku, anggota, peminjaman aktif, dan total denda keterlambatan.
- **Interactive Pop-Up Modals** — Pengelolaan data (Buku, Anggota, Peminjaman) berbasis Alpine.js tanpa reload halaman.
- **Import & Export Excel** — Fitur *import* data anggota secara massal dari file Excel (.xls, .csv) serta *export* laporan rekapitulasi terstruktur.
- **Sistem Transaksi Peminjaman** — Buat peminjaman manual, setujui/tolak pengajuan mandiri, dan proses pengembalian buku.
- **Kalkulasi Denda Otomatis** — Perhitungan denda Keterlambatan otomatis berdasarkan selisih tanggal kembali dan konfigurasi tarif.
- **Pengaturan Web Dynamic** — Atur nama situs, besaran denda per hari, maksimal hari pinjam, dan logo portal.
- **Manajemen Profil** — Fitur pembaruan profil petugas, pengubahan kata sandi, dan keamanan akun.

---

## 🏗️ Teknologi yang Digunakan

| Teknologi | Keterangan / Versi |
|-----------|--------------------|
| **PHP** | 8.3+ |
| **Laravel** | 13.x |
| **Tailwind CSS** | 3.x (Slate & Indigo Palette) |
| **Alpine.js** | 3.x (Modal & Dynamic UI State) |
| **Vite** | 5.x |
| **Database** | MySQL / SQLite |
| **CI/CD** | GitHub Actions (Automated Test & Build) |

---

## 🚀 Instalasi & Menjalankan

### Prasyarat
- PHP >= 8.3
- Composer >= 2.x
- Node.js >= 18.x & NPM
- Database MySQL / MariaDB

### Langkah-langkah

```bash
# 1. Clone repository
git clone [https://github.com/Yanzz174/perpustakaan-app.git](https://github.com/Yanzz174/perpustakaan-app.git)
cd perpustakaan-app

# 2. Install dependensi PHP
composer install

# 3. Install dependensi JavaScript
npm install

# 4. Salin file .env dan generate APP_KEY
cp .env.example .env
php artisan key:generate

# 5. Jalankan migrasi database & seeder
php artisan migrate --seed

# 6. Build aset frontend
npm run build

# 7. Jalankan server lokal
php artisan serve

---

## 📂 Struktur Proyek

```
perpustakaan-app/
├── app/
│   ├── Http/Controllers/     # Controller logika aplikasi
│   │   ├── PublicCatalogController.php
│   │   ├── BookController.php
│   │   ├── MemberController.php
│   │   ├── BorrowingController.php
│   │   ├── CategoryController.php
│   │   ├── SettingController.php
│   │   └── ProfileController.php
│   ├── Models/               # Model Eloquent
│   │   ├── Book.php
│   │   ├── Member.php
│   │   ├── Borrowing.php
│   │   ├── Category.php
│   │   ├── BorrowingDetail.php
│   │   └── Setting.php
│   └── Providers/            # Service Providers (AppServiceProvider safe-boot)
├── database/
│   ├── migrations/           # Migrasi skema database
│   └── seeders/              # Data awal aplikasi
├── resources/
│   ├── views/                # Blade templates & Alpine Modals
│   │   ├── welcome.blade.php         # Halaman publik (katalog)
│   │   ├── dashboard.blade.php       # Dashboard admin
│   │   ├── check-borrowing.blade.php # Cek peminjaman NISN
│   │   ├── books/                    # Manajemen buku
│   │   ├── members/                  # Manajemen anggota
│   │   ├── borrowings/               # Transaksi peminjaman
│   │   ├── profile/                  # Pengaturan profil
│   │   └── layouts/                  # Layout utama (App & Guest)
├── .github/workflows/        # Konfigurasi CI/CD Pipeline GitHub Actions
└── routes/
    └── web.php               # Routing aplikasi
```

---

## 🔄 Alur Kerja Sistem

1. **Pengunjung** mengakses halaman katalog publik
2. **Mencari** buku berdasarkan judul atau pengarang
3. **Mengajukan peminjaman** melalui formulir dengan memasukkan NISN
4. **Petugas** meninjau pengajuan di dashboard
5. **Menyetujui** atau **menolak** pengajuan
6. **Siswa** mengembalikan buku
7. **Sistem otomatis** menghitung denda jika terlambat

---

## 🎨 Fitur Unggulan

- **Import Massal Anggota** — Upload file Excel (.xls, .csv) untuk menambahkan banyak anggota sekaligus
- **Sistem Denda Otomatis** — Otomatis menghitung denda berdasarkan jumlah hari keterlambatan
- **Template Import Excel** — Download template import anggota dalam format .xls
- **Dashboard Interaktif** — Statistik real-time dengan animasi dan hover effects
- **Dark Mode** — Tampilan mode gelap yang nyaman untuk penggunaan lama
- **Responsive Design** — Beradaptasi dengan berbagai ukuran layar

---

## 🧪 Automated Testing & CI/CD

Aplikasi ini mengintegrasikan **GitHub Actions Workflow** (`.github/workflows/ci.yml`) untuk memastikan kualitas kode dan stabilitas aplikasi:
- Pengujian otomatis pada setiap *push* & *pull request*.
- Service container MySQL 8.0 terisolasi untuk tes migrasi database.
- Verifikasi kompilasi aset Vite dan tes otomatis (`php artisan test`).

---

## 📝 Lisensi

Proyek ini dilisensikan di bawah [MIT License](LICENSE).

---

## 👤 Penulis

Dibuat oleh **[Moch. Ferdiansyah](https://github.com/Yanzz174)** sebagai bagian dari portofolio pengembangan aplikasi web modern.

---

## ⭐ Star History

Jika Anda menemukan proyek ini bermanfaat, jangan ragu untuk memberikan ⭐ star!
