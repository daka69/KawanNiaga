# KawanNiaga : Platform E-Commerce & Manajemen Penjualan

Aplikasi web untuk memudahkan penjual dan pembeli dalam melakukan transaksi jual-beli produk secara digital dan terintegrasi. Dilengkapi dengan fitur manajemen inventori, tracking pesanan, dan sistem promosi untuk pengalaman berbelanja yang lebih baik.

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
- **Sistem Otentikasi:** Registrasi dan login untuk pengguna dengan role pembeli.
- **Manajemen Produk (CRUD):** Admin dapat menambah, melihat, mengubah, dan menghapus data produk dengan kategori dan harga.
- **Tracking Inventori:** Sistem manajemen stok produk dengan perhitungan margin keuntungan otomatis.
- **Sistem Pesanan:** Pembeli dapat melakukan pemesanan dengan tracking status pesanan secara real-time.
- **Manajemen Penjualan:** Admin dapat memantau dan mengelola semua transaksi penjualan yang terjadi.
- **Kode Promo:** Sistem diskon dengan kode promo yang dapat dikonfigurasi oleh admin.

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
    Aplikasi dapat diakses melalui browser di alamat: **http://127.0.0.1:8000**
    
    Atau akses versi production di: **https://profound-surprise-production-d828.up.railway.app/store**

---

## Akun Default & Hak Akses (Testing Ready)

Untuk mempermudah proses pengujian dan demo aplikasi, sistem telah menyediakan akun default melalui mekanisme database seeder. Password default: **`password`**.

| Role Pengguna | Email Login | Password | Hak Akses Utama |
| :--- | :--- | :--- | :--- |
| **👨‍💼 Admin** | `admin@kawanniaga.com` | `password` | Manajemen penuh produk, pesanan, penjualan, dan kode promo. |
| **🛍️ Pembeli** | `pembeli@kawanniaga.com` | `password` | Menjelajahi katalog produk dan melakukan pemesanan. |

*(Catatan: Anda tetap dapat mendaftarkan akun baru secara organik melalui form halaman Register bawaan aplikasi)*

---

## Struktur Database

### Tabel `users`
| Kolom | Tipe | Keterangan |
| --- | --- | --- |
| `id` | BIGINT (PK) | Primary key auto-increment |
| `name` | VARCHAR | Nama lengkap pengguna |
| `email` | VARCHAR (unique) | Email login |
| `email_verified_at` | TIMESTAMP | Waktu verifikasi email |
| `password` | VARCHAR | Password terenkripsi |
| `address` | VARCHAR | Alamat pengguna (optional) |
| `phone` | VARCHAR | Nomor telepon pengguna (optional) |
| `remember_token` | VARCHAR | Token sesi "ingat saya" |
| `created_at` / `updated_at` | TIMESTAMP | Timestamp otomatis Laravel |

### Tabel `products`
| Kolom | Tipe | Keterangan |
| --- | --- | --- |
| `id` | BIGINT (PK) | Primary key auto-increment |
| `name` | VARCHAR | Nama produk |
| `category` | VARCHAR | Kategori produk (nullable) |
| `stock` | INTEGER | Jumlah stok tersedia (default: 0) |
| `capital_price` | INTEGER | Harga modal (Rupiah) |
| `selling_price` | INTEGER | Harga jual (Rupiah) |
| `profit_margin` | INTEGER | Margin keuntungan (calculated field) |
| `created_at` / `updated_at` | TIMESTAMP | Timestamp otomatis Laravel |

### Tabel `orders`
| Kolom | Tipe | Keterangan |
| --- | --- | --- |
| `id` | BIGINT (PK) | Primary key auto-increment |
| `order_number` | VARCHAR (unique) | Nomor referensi pesanan |
| `user_id` | BIGINT (FK) | Relasi ke `users.id` (cascade delete) |
| `shipping_address` | TEXT | Alamat pengiriman |
| `payment_method` | VARCHAR | Metode pembayaran |
| `subtotal` | INTEGER | Total harga produk sebelum diskon |
| `delivery_fee` | INTEGER | Biaya pengiriman (default: 0) |
| `discount` | INTEGER | Potongan diskon (default: 0) |
| `total` | INTEGER | Total akhir pembayaran |
| `status` | ENUM | Status pesanan: `pending`, `paid`, `processing`, `shipped`, `completed`, `cancelled` (default: `paid`) |
| `created_at` / `updated_at` | TIMESTAMP | Timestamp otomatis Laravel |

### Tabel `order_items`
| Kolom | Tipe | Keterangan |
| --- | --- | --- |
| `id` | BIGINT (PK) | Primary key auto-increment |
| `order_id` | BIGINT (FK) | Relasi ke `orders.id` (cascade delete) |
| `product_id` | BIGINT (FK) | Relasi ke `products.id` (set null on delete) |
| `product_name` | VARCHAR | Nama produk saat pemesanan |
| `quantity` | INTEGER | Jumlah item yang dipesan |
| `price` | INTEGER | Harga per unit saat pemesanan |
| `subtotal` | INTEGER | Total untuk item ini (quantity × price) |
| `created_at` / `updated_at` | TIMESTAMP | Timestamp otomatis Laravel |

### Tabel `sales`
| Kolom | Tipe | Keterangan |
| --- | --- | --- |
| `id` | BIGINT (PK) | Primary key auto-increment |
| `product_id` | BIGINT (FK) | Relasi ke `products.id` (set null on delete) |
| `user_id` | BIGINT (FK) | Relasi ke `users.id` (cascade delete) |
| `quantity` | INTEGER | Jumlah produk terjual |
| `total_price` | INTEGER | Total harga penjualan |
| `total_profit` | INTEGER | Total keuntungan dari penjualan |
| `created_at` / `updated_at` | TIMESTAMP | Timestamp otomatis Laravel |

### Tabel `promo_codes`
| Kolom | Tipe | Keterangan |
| --- | --- | --- |
| `id` | BIGINT (PK) | Primary key auto-increment |
| `code` | VARCHAR (unique) | Kode promo unik |
| `discount_amount` | DECIMAL | Nilai diskon (Rp) |
| `min_purchase` | DECIMAL | Minimum pembelian untuk aktivasi (default: 0) |
| `valid_until` | DATETIME | Tanggal berlaku hingga (nullable) |
| `is_active` | BOOLEAN | Status aktif kode promo (default: true) |
| `created_at` / `updated_at` | TIMESTAMP | Timestamp otomatis Laravel |

---

## Hak Akses Pengguna

### 👨‍💼 Admin
- Memantau ringkasan statistik total data pada halaman utama Dashboard Admin.
- Melihat, melacak, dan mengelola seluruh data produk dengan CRUD lengkap.
- Memantau dan mengelola seluruh pesanan pelanggan serta tracking status.
- Mengelola data penjualan dan analisis keuntungan per produk.
- Membuat dan mengonfigurasi kode promo untuk campaign penjualan.

### 🛍️ Pembeli
- Menjelajahi beranda utama platform yang menampilkan seluruh daftar produk.
- Mengakses halaman detail produk untuk melihat informasi harga, kategori, dan stok.
- Melakukan pemesanan dengan metode pembayaran yang tersedia.
- Melacak status pesanan dari pending hingga pengiriman.
- Menggunakan kode promo untuk mendapatkan diskon pada pembelian.

---

## Lisensi

Proyek aplikasi web ini dikembangkan untuk keperluan e-commerce dan manajemen penjualan digital.

---

**Dibuat dengan ❤️ oleh Tim KawanNiaga**
