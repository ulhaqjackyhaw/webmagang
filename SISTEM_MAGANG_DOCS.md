# Sistem Manajemen Magang

Sistem manajemen magang dengan 3 role: **Admin**, **TU (Tata Usaha)**, dan **HC (Human Capital)**.

## Fitur Utama

### Role TU (Tata Usaha)
- Login ke sistem
- CRUD data anak magang:
  - Nama
  - NIM
  - Asal Kampus
  - Program Studi
  - No WhatsApp
  - Upload file: Proposal, CV, Surat Magang dari Kampus
- Lihat data magang yang dibuat sendiri
- Edit/hapus data magang yang dibuat sendiri

### Role HC (Human Capital)
- Login ke sistem
- Lihat semua data magang dari TU
- Lihat detail data magang beserta file-filenya
- Approve/Reject data magang
  - **Saat Approve**: Otomatis redirect ke WhatsApp dengan template pesan
  - **Saat Reject**: Status berubah menjadi ditolak
- Export data magang ke Excel berdasarkan status:
  - Semua data
  - Menunggu persetujuan
  - Diterima
  - Ditolak

### Role Admin
- Akses semua fitur TU dan HC
- Kelola user (Tambah/Edit/Hapus akun TU dan HC)

## Akun Default

Setelah setup, gunakan akun berikut untuk login:

| Role  | Email              | Password  |
|-------|-------------------|-----------|
| Admin | admin@magang.com  | password  |
| TU    | tu@magang.com     | password  |
| HC    | hc@magang.com     | password  |

## Instalasi

1. Clone repository
```bash
git clone <repository-url>
cd Website-Magang
```

2. Install dependencies
```bash
composer install
npm install
```

3. Copy file environment
```bash
copy .env.example .env
```

4. Generate application key
```bash
php artisan key:generate
```

5. Konfigurasi database di file `.env`
```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=sistem_magang
DB_USERNAME=root
DB_PASSWORD=
```

6. Jalankan migration dan seeder
```bash
php artisan migrate:fresh --seed
```

7. Buat symbolic link untuk storage
```bash
php artisan storage:link
```

8. Jalankan aplikasi
```bash
php artisan serve
```

9. Akses aplikasi di browser: `http://localhost:8000`

## Struktur Database

### Tabel `users`
- id
- name
- email
- password
- role (admin, tu, hc)
- timestamps

### Tabel `interns`
- id
- nama
- nim
- asal_kampus
- program_studi
- no_wa
- file_proposal
- file_cv
- file_surat
- status (pending, approved, rejected)
- created_by (foreign key ke users)
- timestamps

## Alur Kerja

1. **TU** login dan menambahkan data anak magang beserta file-filenya
2. Data masuk dengan status "Menunggu Persetujuan"
3. **HC** login dan melihat semua data yang dikirim TU
4. **HC** membuka detail data dan melihat file-file lampiran
5. **HC** memutuskan:
   - **Approve**: Otomatis redirect ke WhatsApp dengan template pesan
   - **Reject**: Status berubah menjadi ditolak
6. **HC** dapat export data berdasarkan status ke Excel
7. **Admin** dapat melakukan semua hal di atas plus mengelola akun user

## Template Pesan WhatsApp

Ketika HC approve data magang, sistem akan redirect ke:
```
https://wa.me/62xxxxxxxxx?text=Halo {nama}, selamat! Pengajuan magang Anda telah disetujui. Silakan hubungi kami untuk informasi lebih lanjut.
```

## Export Excel

HC dan Admin dapat export data dengan format:
- Nama
- NIM
- Asal Kampus
- Program Studi
- No WA
- Status

Filter export:
- Semua data
- Menunggu Persetujuan
- Diterima
- Ditolak

## Teknologi

- Laravel 11
- MySQL
- Tailwind CSS (via CDN)
- Font Awesome (icons)
- Maatwebsite/Laravel-Excel (export)

## Keamanan

- Password di-hash menggunakan bcrypt
- Role-based access control menggunakan middleware
- CSRF protection
- File validation (size & type)

## Support

Untuk pertanyaan dan dukungan, silakan hubungi developer.
