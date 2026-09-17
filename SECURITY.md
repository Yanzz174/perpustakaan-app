# SECURITY POLICY

## Supported Versions

| Version | Supported |
|---------|-----------|
| 13.x    | ✅ Yes |

## Reporting a Security Vulnerability

Please report security issues via email at **taylor@laravel.com** or through the [Laravel security page](https://laravel.com/security).

## What to Expect After Reporting

1. **Acknowledgment** - You will receive an acknowledgment within 48 hours
2. **Triage** - The vulnerability will be triaged within 5 business days
3. **Fix** - A patch will be released as soon as possible
4. **Credit** - Security researchers will be credited in the release notes (unless requested otherwise)

## Security Best Practices for This Project

- Jangan pernah mengupload file `.env` ke repository
- Gunakan `.env.example` sebagai referensi konfigurasi
- Gunakan password kuat untuk database dan admin
- Update dependensi secara berkala (`composer update`, `npm update`)
- Validasi input pengguna pada semua form
- Gunakan CSRF protection (sudah terintegrasi di Laravel)