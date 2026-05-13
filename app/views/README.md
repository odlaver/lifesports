# Views

Folder ini berisi halaman yang ditampilkan ke pengguna. File HTML sudah dikelompokkan berdasarkan area/role agar lebih mudah dipakai saat routing dan controller backend mulai dibuat.

## Struktur Folder

```txt
app/views/
  public/
  auth/
  pelanggan/
  pengelola/
  admin/
```

## Halaman Publik

- `public/index.html` - Landing page Lifesports
- `public/lapangan.html` - Daftar lapangan dengan filter

## Auth

- `auth/login.html` - Halaman masuk
- `auth/register.html` - Halaman daftar akun

## Alur Pelanggan

- `pelanggan/pelanggan.html` - Dashboard pelanggan
- `pelanggan/pelanggan-lapangan.html` - Daftar lapangan khusus pelanggan
- `pelanggan/pelanggan-detail-lapangan.html` - Detail lapangan khusus pelanggan
- `pelanggan/detail-lapangan.html` - Detail lapangan, jadwal, fasilitas, review, tombol booking
- `pelanggan/booking.html` - Riwayat booking pelanggan dengan filter status
- `pelanggan/booking-detail.html` - Detail booking, status pembayaran, aksi bayar/batal/review
- `pelanggan/pembayaran.html` - Ringkasan biaya, metode pembayaran, upload bukti
- `pelanggan/review.html` - Form rating dan komentar setelah booking selesai
- `pelanggan/profile.html` - Data akun pelanggan dan tombol edit

## Alur Pengelola

- `pengelola/pengelola.html` - Dashboard pengelola
- `pengelola/pengelola-lapangan.html` - Daftar lapangan milik pengelola
- `pengelola/pengelola-lapangan-form.html` - Tambah / edit lapangan
- `pengelola/pengelola-booking.html` - Daftar booking masuk dengan filter status
- `pengelola/pengelola-booking-detail.html` - Detail booking pelanggan, tombol konfirmasi/batalkan
- `pengelola/pengelola-pembayaran.html` - Verifikasi pembayaran dan bukti transfer
- `pengelola/pengelola-laporan.html` - Ringkasan pendapatan, booking, lapangan populer

## Alur Admin

- `admin/admin.html` - Dashboard super admin
- `admin/admin-users.html` - Kelola semua user (filter role, status, aksi edit/hapus)
- `admin/admin-user-form.html` - Tambah / edit user
- `admin/admin-kategori.html` - Kelola kategori olahraga
- `admin/admin-lapangan.html` - Monitoring semua lapangan dari semua pengelola
- `admin/admin-lapangan-detail.html` - Detail lapangan lengkap beserta pengelola dan performa
- `admin/admin-booking.html` - Monitoring seluruh booking
- `admin/admin-booking-detail.html` - Detail booking lintas sistem dengan aksi force admin
- `admin/admin-pembayaran.html` - Status semua transaksi pembayaran
- `admin/admin-laporan.html` - Laporan global sistem (KPI, lapangan terpopuler, pengelola terbaik)
