# 📚 Perpustakaan Digital

Aplikasi manajemen perpustakaan berbasis web yang dibangun dengan **Laravel 13** dan **Tailwind CSS**. Fitur lengkap untuk administrasi buku, anggota, dan sistem peminjaman dengan dashboard interaktif.

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
git clone https://github.com/[USERNAME]/perpustakaan-app.git
cd perpustakaan-app

# 2. Install dependensi PHP
composer install

# 3. Install dependensi JavaScript
npm install

# 4. Salin file .env dan generate APP_KEY
cp .env.example .env
php artisan key:generate

# 5. Jalankan migrasi database
php artisan migrate

# 6. Build aset frontend
npm run build

# 7. Jalankan server pengembangan
php artisan serve

# 8. Jalankan Vite dev server (untuk hot-reload)
npm run dev
```

Buka browser dan kunjungi `http://localhost:8000`.

---

## 📂 Struktur Proyek

```
perpustakaan-app/
├── app/
│   ├── Http/Controllers/     # Controller aplikasi
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
│   └── ...
├── database/
│   ├── migrations/           # Migrasi database
│   └── seeders/              # Seeders
├── resources/
│   ├── views/                # Blade templates
│   │   ├── welcome.blade.php         # Halaman publik (katalog)
│   │   ├── dashboard.blade.php       # Dashboard admin
│   │   ├── check-borrowing.blade.php # Cek peminjaman
│   │   ├── books/                  # Views manajemen buku
│   │   ├── members/                # Views manajemen anggota
│   │   ├── borrowings/             # Views peminjaman
│   │   ├── categories/             # Views kategori
│   │   ├── settings/               # Views pengaturan
│   │   └── layouts/                # Layout utama
│   └── css/                    # Stylesheet
├── routes/
│   └── web.php                 # Routing aplikasi
├── public/                     # Aset publik
└── storage/                    # File yang diunggah (cover, logo)
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

## 📝 Lisensi

Proyek ini dilisensikan di bawah [MIT License](LICENSE).

---

## 👤 Penulis

Dibuat sebagai bagian dari portofolio pengembangan web.

---

## ⭐ Star History

Jika Anda menemukan proyek ini bermanfaat, jangan ragu untuk memberikan ⭐ star!
