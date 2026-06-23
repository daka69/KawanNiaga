# KawanNiaga : Platform Perdagangan & Manajemen Kemitraan

Aplikasi web untuk memudahkan pelaku usaha dan komunitas dalam menjalin kemitraan bisnis serta mengelola transaksi perdagangan secara digital dan terintegrasi.

---

## Tim Pengembang

| Nama                             | Peran (Role) | GitHub        |
| -------------------------------- | ------------ |---------------|
| Badjradaka Herdinansyah Rahardjo | Backend      | @daka69       |
| Ahmad Luthfi Maulana             | Frontend     | @anomaliemas  |
| Amandha Citra Mustika            | Database     | @zvyaa        |

---

## Tech Stack

| Komponen          | Teknologi                      |
| ----------------- | ------------------------------ |
| Bahasa            | PHP, JavaScript, Blade         |
| Backend Framework | Laravel (v11.x)                |
| Frontend Engine   | Blade Templates & Tailwind CSS |
| Database          | SQLite / MySQL                 |
| Starter Kit Auth  | Laravel Breeze (Blade)         |
| Version Control   | GitHub                         |

---

## Fitur Utama
- Sistem Otentikasi Multi-Role: Registrasi dan login terpisah untuk Admin, Penyedia Layanan, dan Pembeli/Klien.
- Manajemen Data Bisnis (CRUD): Penyedia dapat menambah, melihat, mengubah, dan menghapus data layanan/produk mereka.
- Pencarian Mitra Efisien: Pembeli dapat menjelajahi daftar mitra bisnis lengkap dengan detail layanan, rating, dan integrasi kontak langsung.
- Panel Kendali Admin: Manajemen penuh terhadap data seluruh pengguna dan data bisnis yang terdaftar dalam sistem.
- Sistem Rating & Ulasan: Penilaian dan feedback untuk membangun kepercayaan dalam ekosistem perdagangan.

---

## Cara Instalasi

### Prasyarat

Pastikan perangkat Anda sudah terinstall komponen berikut:
- PHP (Minimal v8.2)
- Composer
- Node.js & NPM (Untuk kompilasi Tailwind CSS)

### Langkah Instalasi

1. Clone repository ke direktori lokal Anda:
    ```bash
    git clone https://github.com/daka69/KawanNiaga.git
    cd KawanNiaga
    ```

2. Install seluruh dependensi backend (PHP):
    ```bash
    composer install
    ```

3. Salin file konfigurasi environment:
    ```bash
    cp .env.example .env
    ```

4. Buat kunci enkripsi aplikasi baru:
    ```bash
    php artisan key:generate
    ```

5. Konfigurasi basis data SQLite lokal:
    - Di Windows (Command Prompt), buat file database kosong:
    ```bash
    type nul > database/database.sqlite
    ```
    - Buka file `.env` Anda, lalu sesuaikan bagian database menjadi seperti ini:
    ```env
    DB_CONNECTION=sqlite
    # Hapus baris DB_HOST, DB_PORT, DB_DATABASE lama, cukup sisakan DB_CONNECTION
    ```

6. Jalankan migrasi database sekaligus tanam data tiruan (dummy data) awal:
    ```bash
    php artisan migrate --seed
    ```

7. Buat tautan simbolis (symbolic link) agar aset gambar hasil seeder dapat diakses oleh browser:
    ```bash
    php artisan storage:link
    ```

8. Install dependensi frontend dan lakukan kompilasi aset Tailwind CSS:
    ```bash
    npm install
    npm run build
    ```

9. Jalankan server lokal Laravel:
    ```bash
    php artisan serve
    ```
    Aplikasi dapat diakses melalui browser di alamat: **(https://profound-surprise-production-d828.up.railway.app/store)**

---

## Akun Default & Hak Akses (Testing Ready)

Untuk mempermudah proses pengujian dan demo aplikasi, sistem telah menyediakan akun default dengan role yang berbeda melalui mekanisme database seeder. Semua akun menggunakan password seragam: **`password`**.

| Role Pengguna         | Email Login                | Password   | Hak Akses Utama                                                        | 
| --------------------- | -------------------------- | ---------- | ---------------------------------------------------------------------- |
| 👨‍💼 Admin             | `admin@kawanniaga.com`     | `password` | Manajemen penuh seluruh data pengguna dan data bisnis di platform.     |
| 🏢 Penyedia Layanan  | `penyedia@kawanniaga.com`  | `password` | Manajemen (CRUD) layanan/produk pribadi, rating, dan integrasi kontak. |
| 🛍️ Pembeli/Klien     | `pembeli@kawanniaga.com`   | `password` | Menjelajahi katalog mitra bisnis dan mengakses fitur hubungi penyedia. |

*(Catatan: tetap dapat mendaftarkan akun baru secara organik melalui form halaman Register bawaan aplikasi)*

---

## Struktur Database

### Tabel `users`
| Kolom                       | Tipe             | Keterangan                                                     |
| --------------------------- | ---------------- | -------------------------------------------------------------- |
| `id`                        | BIGINT (PK)      | Primary key auto-increment                                     |
| `name`                      | VARCHAR          | Nama lengkap pengguna                                          |
| `email`                     | VARCHAR (unique) | Email login                                                    |
| `email_verified_at`         | TIMESTAMP        | Waktu verifikasi email                                         |
| `password`                  | VARCHAR          | Password terenkripsi                                           |
| `role`                      | VARCHAR          | Hak akses: `admin`, `penyedia`, `pembeli` (default: `pembeli`) |
| `no_telepon`                | VARCHAR          | Nomor telepon/WhatsApp aktif penyedia                          |
| `remember_token`            | VARCHAR          | Token sesi "ingat saya"                                        |
| `created_at` / `updated_at` | TIMESTAMP        | Timestamp otomatis Laravel                                     |

### Tabel `layanan` (atau `produk`)
| Kolom                       | Tipe        | Keterangan                                 |
| --------------------------- | ----------- | ------------------------------------------ |
| `id`                        | BIGINT (PK) | Primary key auto-increment                 |
| `user_id`                   | BIGINT (FK) | Relasi ke `users.id` (cascade delete)      |
| `nama`                      | VARCHAR     | Nama layanan/produk                        |
| `kategori`                  | VARCHAR     | Kategori bisnis                            |
| `deskripsi`                 | TEXT        | Deskripsi detail layanan/produk            |
| `harga`                     | INTEGER     | Harga layanan (Rupiah)                     |
| `lokasi`                    | VARCHAR     | Lokasi/wilayah operasional                 |
| `status`                    | VARCHAR     | Status ketersediaan (default: `aktif`)     |
| `gambar`                    | VARCHAR     | Path file gambar produk/layanan (nullable) |
| `rating`                    | DECIMAL     | Rating rata-rata dari ulasan               |
| `created_at` / `updated_at` | TIMESTAMP   | Timestamp otomatis Laravel                 |

### Tabel `ulasan` (optional)
| Kolom                       | Tipe        | Keterangan                                  |
| --------------------------- | ----------- | ------------------------------------------- |
| `id`                        | BIGINT (PK) | Primary key auto-increment                  |
| `layanan_id`                | BIGINT (FK) | Relasi ke `layanan.id` (cascade delete)     |
| `user_id`                   | BIGINT (FK) | Relasi ke `users.id` yang memberikan ulasan |
| `rating`                    | INTEGER     | Rating 1-5 bintang                          |
| `komentar`                  | TEXT        | Komentar ulasan                             |
| `created_at` / `updated_at` | TIMESTAMP   | Timestamp otomatis Laravel                  |

---

## Hak Akses Pengguna

### 👨‍💼 Admin
- Memantau ringkasan statistik total data pada halaman utama Dashboard Admin.
- Melihat, melacak, dan mengelola seluruh data pengguna sistem.
- Memantau dan mengelola seluruh data layanan/produk yang dipublikasikan di platform.
- Mengelola kategori dan verifikasi bisnis.

### 🏢 Penyedia Layanan
- Mengakses panel Dashboard khusus Penyedia Layanan.
- Melakukan manajemen penuh (Create, Read, Update, Delete) pada layanan/produk pribadi miliknya.
- Menyantumkan nomor telepon/WhatsApp untuk memudahkan komunikasi dengan calon klien.
- Melihat rating dan ulasan dari pembeli/klien.

### 🛍️ Pembeli/Klien
- Menjelajahi beranda utama platform yang menampilkan seluruh daftar mitra bisnis.
- Mengakses halaman detail layanan untuk melihat informasi harga, deskripsi, lokasi, rating, serta gambar.
- Menghubungi penyedia layanan secara langsung melalui tautan telepon/WhatsApp.
- Memberikan rating dan ulasan untuk layanan yang telah digunakan.

---

## Lisensi

Proyek aplikasi web ini dikembangkan untuk keperluan bisnis dan perdagangan digital.

---


**Dibuat dengan ❤️ oleh Tim KawanNiaga**
