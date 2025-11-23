# Panduan Instalasi Project

Berikut adalah cara menjalankan project ini di komputer Anda setelah di-download:

## 1. Persiapan

Pastikan di komputer sudah terinstall:

-   PHP & Composer
-   Git
-   Database (XAMPP/MySQL)

## 2. Langkah Instalasi

**Langkah 1: Clone Repository**
Buka terminal/cmd, lalu jalankan:
git clone https://github.com/akwalsyarf/presensiKaryawan-laravel.git
cd presensiKaryawan-laravel

**Langkah 2: Install Vendor (Library)**
Karena folder vendor tidak ikut di-upload, install manual dengan:
composer install

**Langkah 3: Copy File Environment**
Duplikat file contoh konfigurasi:
cp .env.example .env
_(Untuk Windows gunakan: copy .env.example .env)_

**Langkah 4: Generate Key**
Buat kunci enkripsi aplikasi:
php artisan key:generate

**Langkah 5: Setup Database**

1. Buat database baru di phpMyAdmin (misal: `nama_db_laravel`).
2. Buka file `.env` di text editor.
3. Sesuaikan konfigurasi DB:
   DB_DATABASE=nama_db_laravel
   DB_USERNAME=root
   DB_PASSWORD=

**Langkah 6: Migrasi Database**
Masukkan tabel ke database:
php artisan migrate

**Langkah 7: Jalankan Server**
php artisan serve

Akses di browser: http://127.0.0.1:8000
