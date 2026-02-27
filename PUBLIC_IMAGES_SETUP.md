# Panduan Setup Images untuk Landing Page

## 📁 Copy File Images

Untuk menampilkan design landing page dengan sempurna, Anda perlu menyimpan 2 file image ke folder `public/images`:

### 1. Logo Injourney Airports
- **File yang diberikan**: Logo Injourney Airports (gambar pertama)
- **Simpan sebagai**: `public/images/injourney-logo.png`
- **Ukuran yang disarankan**: Gunakan ukuran original
- **Format**: PNG dengan background transparan

### 2. Background Terminal Bandara  
- **File yang diberikan**: Foto terminal bandara (gambar kedua)
- **Simpan sebagai**: `public/images/airport-terminal.jpg`
- **Ukuran yang disarankan**: Minimal 1920x1080px untuk kualitas terbaik
- **Format**: JPG atau PNG

## 📂 Struktur Folder

Pastikan struktur folder seperti ini:

```
Website-Magang/
└── public/
    └── images/
        ├── injourney-logo.png      ← Logo company
        └── airport-terminal.jpg    ← Background terminal
```

## 🎨 Hasil Design Baru

Setelah images di-copy, landing page akan menampilkan:

✅ **Landing Page** (`/`)
- Navbar dengan logo Injourney Airports  
- Hero section dengan background terminal bandara yang stunning
- Animasi modern dan smooth
- 6 benefit cards dengan icon colorful
- Section persyaratan yang informatif
- Footer lengkap dengan logo

✅ **Register Page** (`/daftar`)
- Header dengan logo
- Form yang lebih modern dengan icon
- Better UX dengan animasi
- File upload yang lebih user-friendly

✅ **Success Page** (`/berhasil`)
- Success animation yang menarik
- Timeline steps yang jelas
- Design yang lebih engaging

## 🚀 Testing

Setelah copy images, jalankan aplikasi:

```powershell
php artisan serve
```

Kemudian buka: `http://localhost:8000`

## 💡 Tips

- Jika logo terlihat terlalu besar/kecil, sesuaikan class `h-12` di file blade
- Background terminal menggunakan parallax effect untuk tampilan lebih dinamis
- Semua animasi otomatis berjalan saat page load

## 🎯 Browser Support

Design ini menggunakan modern CSS dan sudah tested di:
- Chrome/Edge (Recommended)
- Firefox
- Safari

---

**Note**: Images tidak ikut dalam repository untuk menjaga ukuran repo tetap kecil. Silakan copy images sesuai instruksi di atas.
