# 💍 Undangan Pernikahan Online — Laravel

Undangan pernikahan digital dengan animasi elegan dan panel admin lengkap untuk manajemen tamu.

---

## 🚀 Cara Instalasi

### 1. Copy file ke project Laravel baru

```bash
composer create-project laravel/laravel wedding-invitation
cd wedding-invitation
```

### 2. Copy semua file dari package ini ke folder Laravel

Salin semua folder berikut ke project Laravel Anda:
- `app/` → `app/`
- `database/` → `database/`
- `resources/views/` → `resources/views/`
- `routes/web.php` → `routes/web.php`

### 3. Setting environment

```bash
cp .env.example .env
php artisan key:generate
```

Edit `.env` untuk database:
```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=wedding_db
DB_USERNAME=root
DB_PASSWORD=
```

### 4. Jalankan migrasi

```bash
php artisan migrate
```

### 5. Jalankan server

```bash
php artisan serve
```

---

## 📋 URL Penting

| URL | Keterangan |
|-----|-----------|
| `http://localhost:8000/` | Undangan umum |
| `http://localhost:8000/undangan/{slug}` | Undangan personal per tamu |
| `http://localhost:8000/admin/guests` | Panel admin daftar tamu |
| `http://localhost:8000/admin/guests/create` | Form tambah tamu |

---

## ✨ Fitur

### Undangan (Frontend)
- ✅ **Cover amplop** animasi dengan tombol "Buka Undangan"
- ✅ **Petal jatuh** animasi bunga
- ✅ **Countdown** hitung mundur real-time
- ✅ **Nama personal** per tamu di cover dan hero
- ✅ **Tracking** kapan undangan dibuka (opened_at)
- ✅ **RSVP form** konfirmasi kehadiran, jumlah tamu, ucapan
- ✅ **Scroll reveal** animasi saat scroll
- ✅ Music toggle button
- ✅ Mobile responsive

### Admin Panel (Backend)
- ✅ **Dashboard** statistik: total, sudah buka, konfirmasi, total pax
- ✅ **Tambah tamu** satu per satu
- ✅ **Import massal** dari textarea (copy-paste banyak nama)
- ✅ **Edit & hapus** tamu
- ✅ **Copy link** undangan langsung dari tabel
- ✅ **Filter kategori**: Keluarga, Teman, Rekan Kerja, Lainnya
- ✅ **Search** real-time di tabel
- ✅ Status tracking per tamu

---

## 🔒 Keamanan Admin

Untuk production, tambahkan middleware auth di `routes/web.php`:

```php
Route::prefix('admin')->middleware(['auth'])->name('admin.')->group(function () {
    // routes...
});
```

Lalu jalankan:
```bash
php artisan make:auth
# atau gunakan Laravel Breeze / Jetstream
```

---

## 🎨 Kustomisasi

### Ganti nama pengantin
Edit `resources/views/invitation.blade.php`, cari semua `Rizki` dan `Aulia`.

### Ganti tanggal
Cari `12 Juli 2025` dan `2025-07-12T08:00:00` di `invitation.blade.php`.

### Ganti lokasi
Cari `Masjid Al-Ikhlas` dan `Gedung Graha Kartika` di `invitation.blade.php`.

---

## 🛠 Tech Stack

- **Laravel 10+** — PHP framework
- **MySQL / SQLite** — Database
- **Blade** — Template engine
- **Vanilla CSS + JS** — Animasi tanpa dependency tambahan
- **Google Fonts** — Cormorant Garamond + Jost
