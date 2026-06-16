# ECO-SHARE: Platform Manajemen Distribusi Energi & Swasembada Ekonomi

Repositori ini adalah template dasar proyek Laravel Fullstack untuk simulasi babak final Hackathon Play IT 2026. Fokus repositori ini sekarang adalah **Setup Awal Lingkungan Pengembangan (Development Environment Setup)** agar seluruh anggota tim memiliki basis kode dan database yang sinkron.

---

## Prasyarat Sistem (Prerequisites)
Sebelum memulai, pastikan laptop kamu sudah terinstal:
* **XAMPP / Laragon** (PHP versi 8.2 atau lebih tinggi & MySQL)
* **Composer** (Dependency Manager untuk PHP)
* **Node.js & NPM** (Untuk eksekusi Vite & Tailwind CSS)
* **Git / Git Bash**

---

## Langkah-Langkah Setup Awal (Untuk Anggota Tim)

Jika ketua tim sudah melakukan *push* kode awal ke GitHub, 2 anggota tim lainnya wajib mengikuti langkah-langkah di bawah ini untuk menjalankan proyek di laptop masing-masing:

### 1. Kloning Repositori
Buka Terminal atau Git Bash, lalu kloning proyek ini:
```bash
git clone <URL_REPOSITORI_GITHUB_KAMU>
cd eco-share

```

### 2. Instal Dependensi PHP (Composer)

Instal semua library PHP yang dibutuhkan oleh Laravel:

```bash
composer install

```

### 3. Instal Dependensi JavaScript & CSS (NPM)

Instal library frontend untuk kompilasi Tailwind CSS via Vite:

```bash
npm install

```

### 4. Setup Konfigurasi Lingkungan (.env)

Salin file template `.env.example` menjadi file `.env` utama:

```bash
cp .env.example .env

```

### 5. Generate Application Key

Buat kunci keamanan enkripsi unik untuk aplikasi kamu:

```bash
php artisan key:generate

```

### 6. Konfigurasi & Migrasi Database MySQL

1. Buka **phpMyAdmin** (`http://localhost/phpmyadmin`).
2. Buat database baru kosongan dengan nama: **`eco_share`**.
3. Buka file `.env` di VS Code kamu, lalu pastikan konfigurasinya sudah sesuai:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=eco_share
DB_USERNAME=root
DB_PASSWORD=(kosongkan jika tanpa pass)

```

*(Kosongkan bagian DB_PASSWORD jika kamu menggunakan XAMPP bawaan standar tanpa password)*

```

---

## Cara Menjalankan Aplikasi (Mode Koding & Auto-Refresh)

Agar fitur **Auto Refresh (Live Reload)** berjalan secara otomatis setiap kali ada perubahan pada file `.blade.php` atau Controller, kamu **WAJIB** membuka dua jendela terminal secara bersamaan:

* **Terminal 1 (Server Backend PHP):**

```bash
php artisan serve

```

* **Terminal 2 (Server Frontend Vite - JANGAN DITUTUP):**

```bash
npm run dev

```

Buka browser kamu dan akses link berikut: **`http://127.0.0.1:8000`**

---

Programmer by Putra!

```