# SECURITY POLICY

## Supported Versions

| Version | Supported |
|---------|-----------|
| 13.x    | ✅ Yes |

## Reporting a Security Vulnerability

Jika Anda menemukan celah keamanan pada project ini, silakan laporkan melalui email **zexian84@gmail.com** atau buka [issue privat/security advisory](https://github.com/Yanzz174/perpustakaan-app/security/advisories) di GitHub.

Mohon **jangan** mempublikasikan celah keamanan secara terbuka (public issue) sebelum ada perbaikan.

## What to Expect After Reporting

1. **Acknowledgment** — Laporan akan direspon secepat mungkin
2. **Triage** — Vulnerability akan ditinjau dan divalidasi
3. **Fix** — Patch akan dirilis setelah perbaikan siap
4. **Credit** — Peneliti keamanan akan dikreditkan pada release notes (kecuali diminta sebaliknya)

## Security Best Practices for This Project

- Jangan pernah mengupload file `.env` ke repository
- Gunakan `.env.example` sebagai referensi konfigurasi
- Gunakan password kuat untuk database dan admin
- Update dependensi secara berkala (`composer update`, `npm update`)
- Validasi input pengguna pada semua form
- Gunakan CSRF protection (sudah terintegrasi di Laravel)
