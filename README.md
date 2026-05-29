# Lifesports

Lifesports adalah platform penyewaan lapangan olahraga berbasis web yang dirancang khusus untuk area Bandar Lampung. Aplikasi ini mencakup berbagai jenis olahraga populer seperti Futsal, Badminton, Basket, dan Tenis dengan manajemen modern.

Aplikasi ini dibangun menggunakan **PHP Native** murni dengan menerapkan pola arsitektur **MVC (Model-View-Controller)** kustom dari nol untuk menjaga kebersihan kode (*clean code*) dan modularitas sistem.

---

## Fitur Utama Berdasarkan Peran

### 1. Pelanggan (Customer)
- **Pencarian Lapangan**: Mencari lapangan aktif dengan sistem kategori dinamis.
- **Booking Lapangan**: Sistem checkout penyewaan dengan pemilihan jam, durasi, dan tanggal.
- **Pembayaran Mandiri**: Unggah bukti transfer (Bank BCA) langsung ke sistem.
- **Ulasan & Review**: Memberikan ulasan bintang dan umpan balik setelah penyewaan selesai.
- **Manajemen Profil**: Pembaruan profil akun secara aman.

### 2. Pengelola Lapangan (Partner Mitra)
- **Dashboard Ringkasan**: Monitor total lapangan aktif, pesanan masuk, dan total pendapatan.
- **CRUD Lapangan**: Menambahkan, mengedit, mengubah foto, serta menonaktifkan lapangan.
- **Verifikasi Pembayaran**: Menerima/menolak bukti transfer pemesanan dari pelanggan.
- **Laporan Keuangan**: Ringkasan performa penjualan bulanan dan tingkat popularitas lapangan.

### 3. Super Admin
- **Monitoring Global**: Pengawasan total transaksi, total user terdaftar, dan performa keuangan.
- **Kelola Kategori**: Pengaturan jenis olahraga terintegrasi dengan ikon Font Awesome.
- **Manajemen Pengguna**: Memantau aktivitas seluruh akun Pelanggan, Pengelola, dan Admin.

---

## Teknologi yang Digunakan
- **Backend**: PHP Native (PDO MySQL, OOP Model Layer)
- **Frontend**: HTML5, Vanilla CSS (Custom Responsive Layout), Font Awesome 6.4.0
- **Database**: MySQL

---

## Cara Instalasi di Lokal

1. **Persiapan Database**:
   - Buat database baru di MySQL dengan nama `lifesports`.
   - Impor berkas database `lifesports.sql` yang ada di root repositori.
   - *(Opsional)* Impor berkas `populate_dummy.sql` untuk mengisi data tiruan Bandar Lampung yang realistis.

2. **Konfigurasi Aplikasi**:
   - Salin folder proyek ke dalam direktori server lokal Anda (misal `htdocs` di XAMPP atau `www` di Laragon).
   - Sesuaikan kredensial koneksi database Anda di berkas `app/config/config.php`:
     ```php
     define('DB_HOST', 'localhost');
     define('DB_USER', 'root');
     define('DB_PASS', '');
     define('DB_NAME', 'lifesports');
     ```

3. **Jalankan Aplikasi**:
   - Buka peramban (browser) Anda dan akses `http://localhost/pemweb-t`.

---

## Akun Uji Coba (Kata Sandi: `password`)
- **Super Admin**: `admin@lifesports.com`
- **Mitra Pengelola**: `pengelola@lifesports.com`
- **Pelanggan**: `budi@gmail.com`
