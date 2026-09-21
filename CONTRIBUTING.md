# 🤝 Kontribusi

Kontribusi terhadap proyek ini sangat kami sambut! Berikut panduan untuk berkontribusi:

## Setup Development

Sebelum berkontribusi, pastikan Anda sudah menjalankan project secara lokal. Lihat bagian [Instalasi & Menjalankan](README.md#-instalasi--menjalankan) di README untuk panduan lengkap.

## Cara Berkontribusi

1. **Fork** repository ini
2. Buat **branch** baru untuk fitur Anda (`git checkout -b fitur-baru`)
3. Lakukan **commit** dengan pesan yang jelas (`git commit -m 'feat: tambah fitur X'`)
4. Push ke branch Anda (`git push origin fitur-baru`)
5. Buat **Pull Request**

## Standar Penulisan Kode

- Ikuti standar penulisan kode Laravel
- Gunakan PHP 8.3+ fitur (typed properties, enums, dll.)
- Tulis dokumentasi untuk setiap fitur baru
- Pastikan semua test passing

Jalankan test dengan:
```bash
php artisan test
```

## Format Commit Message

Gunakan format [Conventional Commits](https://www.conventionalcommits.org/) agar riwayat commit mudah dibaca:

| Prefix | Kegunaan |
|--------|----------|
| `feat:` | Menambahkan fitur baru |
| `fix:` | Memperbaiki bug |
| `docs:` | Perubahan dokumentasi |
| `style:` | Perubahan format kode (tanpa mengubah logika) |
| `refactor:` | Perubahan kode tanpa mengubah fungsi |
| `test:` | Menambah atau memperbaiki test |

Contoh: `git commit -m 'fix: perbaiki validasi form peminjaman'`

## Laporan Issue

Jika menemukan bug atau ingin request fitur, silakan buka **Issue** baru dengan menyertakan informasi berikut:

**Untuk laporan bug:**
- Langkah-langkah untuk mereproduksi masalah
- Perilaku yang diharapkan vs yang benar-benar terjadi
- Screenshot (jika relevan)
- Environment (versi PHP, browser, OS)

**Untuk request fitur:**
- Deskripsi fitur yang diinginkan
- Alasan atau manfaat dari fitur tersebut
- Contoh penggunaan (jika ada)

---

Terima kasih sudah meluangkan waktu untuk berkontribusi pada proyek ini! 🙌
