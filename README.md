# 📚 Perpustakaan Digital

Aplikasi manajemen perpustakaan berbasis web yang dibangun dengan **Laravel 13** dan **Tailwind CSS**. Fitur lengkap untuk administrasi buku, anggota, dan sistem peminjaman dengan dashboard interaktif.

![Laravel](https://img.shields.io/badge/Laravel-FF2D20?style=for-the-badge&logo=laravel&logoColor=white)
![Tailwind CSS](https://img.shields.io/badge/Tailwind_CSS-38B2AC?style=for-the-badge&logo=tailwind-css&logoColor=white)
![Alpine.js](https://img.shields.io/badge/Alpine.js-8BC0D0?style=for-the-badge&logo=alpine.js&logoColor=black)
![MySQL](https://img.shields.io/badge/MySQL-00000F?style=for-the-badge&logo=mysql&logoColor=white)
![Build Status](https://img.shields.io/badge/CI%2FCD-GitHub_Actions-brightgreen?style=for-the-badge&logo=githubactions)

---

## 🎯 Fitur Utama

### 🔍 Untuk Pengunjung (Public)
- **Katalog Buku** — Cari koleksi buku berdasarkan judul atau pengarang dengan pagination
- **Pengecekan Peminjaman** — Cek riwayat peminjaman berdasarkan NISN
- **Pengajuan Pinjaman Mandiri** — Ajukan peminjaman buku langsung melalui formulir online
- **Responsive Design** — Tampilan optimal di desktop, tablet, dan mobile
- **Dark Mode** — Mendukung mode gelap secara otomatis

### 🛠️ Untuk Admin/Petugas (Dashboard)
- **Dashboard Ringkasan** — Statistik total buku, anggota, peminjaman aktif, dan total denda
- **Manajemen Buku** — Tambah, edit, hapus buku dengan unggah gambar cover
- **Manajemen Kategori** — Kategori buku untuk pengelompokan koleksi
- **Manajemen Anggota** — Tambah, hapus anggota dengan fitur **import massal** dari file Excel (.xls, .csv)
- **Sistem Peminjaman** — Buat, setujui, tolak, dan kembalikan peminjaman
- **Manajemen Denda** — Otomatis menghitung denda keterlambatan berdasarkan pengaturan
- **Pengaturan Web** — Atur nama situs, besaran denda, maksimal hari pinjam, dan logo situs
- **Pencarian & Filter** — Cari buku dan anggota secara real-time

---

## 🏗️ Teknologi yang Digunakan

| Teknologi | Versi |
|-----------|-------|
| **PHP** | 8.3+ |
| **Laravel** | 13.x |
| **Tailwind CSS** | 3.x |
| **Alpine.js** | 3.x |
| **Vite** | 5.x |
| **Database** | SQLite / MySQL |
| **Frontend** | Blade Templates + Alpine.js |

---

## 📸 Screenshot

### Dashboard Admin
Dashboard menampilkan ringkasan statistik dalam bentuk kartu interaktif dan tabel transaksi terbaru.

### Katalog Publik
Halaman publik dengan desain modern, fitur pencarian, dan kartu buku yang responsif.

### Formulir Pengajuan Pinjaman
Modal interaktif untuk pengajuan peminjaman mandiri oleh siswa/anggota.

---

## 🚀 Instalasi & Menjalankan

### Prasyarat
- PHP 8.3+
- Composer 2.x
- Node.js 18+ & npm
- Database (SQLite atau MySQL)

### Langkah-langkah

```bash
# 1. Clone repository
git clone https://github.com/Yanzz174/perpustakaan-app.git
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

# 6. Buat symlink storage untuk akses file publik (gambar, dsb)
php artisan storage:link

# 7. Build aset frontend
npm run build

# 8. Jalankan server lokal
php artisan serve

# 9. Jalankan Vite dev server (untuk hot-reload)
npm run dev
```

Buka browser dan kunjungi `http://localhost:8000`.

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
