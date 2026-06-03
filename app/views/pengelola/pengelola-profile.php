<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $data['judul']; ?> - Lifesports</title>
    <link rel="stylesheet" href="<?= BASEURL; ?>/public/assets/css/styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>
    <div class="dashboard-container">
        <aside class="sidebar">
            <div class="sidebar-header"><div class="sidebar-brand">Lifesports</div><div class="role-label">PENGELOLA</div></div>
            <ul class="sidebar-menu">
                <li><a href="<?= BASEURL; ?>/pengelola"><i class="fas fa-home"></i> Dashboard</a></li>
                <li><a href="<?= BASEURL; ?>/pengelola/lapangan"><i class="fas fa-building"></i> Lapangan Saya</a></li>
                <li><a href="<?= BASEURL; ?>/pengelola/booking"><i class="fas fa-calendar-check"></i> Booking Masuk</a></li>
                <li><a href="<?= BASEURL; ?>/pengelola/pembayaran"><i class="fas fa-credit-card"></i> Pembayaran</a></li>
                <li><a href="<?= BASEURL; ?>/pengelola/laporan"><i class="fas fa-file-invoice"></i> Laporan</a></li>
                <li><a href="<?= BASEURL; ?>/pengelola/profile" class="active"><i class="fas fa-user-cog"></i> Profil & Pembayaran</a></li>
                <li><a href="<?= BASEURL; ?>/auth/logout" class="nav-danger"><i class="fas fa-sign-out-alt"></i> Keluar</a></li>
            </ul>
        </aside>
        <main class="main-content">
            <header class="dashboard-header">
                <div class="dash-title">
                    <h1>Profil & Pengaturan Pembayaran</h1>
                    <p>Atur informasi profil dan opsi dompet digital untuk pelanggan membayar pesanan.</p>
                </div>
            </header>

            <?php if (isset($_SESSION['flash'])) { Flasher::flash(); } ?>

            <section class="form-panel">
                <form action="<?= BASEURL; ?>/pengelola/proses_profile" method="POST">
                    <div class="form-grid">
                        <div class="form-group">
                            <label class="form-label">Nama</label>
                            <input class="form-control" name="nama" value="<?= isset($data['user']['nama']) ? htmlspecialchars($data['user']['nama']) : ''; ?>" required>
                        </div>
                        
                        <div class="form-group">
                            <label class="form-label">Email</label>
                            <input class="form-control" type="email" name="email" value="<?= isset($data['user']['email']) ? htmlspecialchars($data['user']['email']) : ''; ?>" required>
                        </div>

                        <div class="form-group full">
                            <label class="form-label">Info Dompet Digital (Wajib)</label>
                            <input class="form-control" name="info_pembayaran" value="<?= isset($data['user']['info_pembayaran']) ? htmlspecialchars($data['user']['info_pembayaran']) : ''; ?>" placeholder="Contoh: DANA - 0812345678 a.n Taufik" required>
                            <small>Satu opsi dompet digital yang digunakan pelanggan untuk membayar pesanan ke Anda.</small>
                        </div>

                        <div class="form-group full">
                            <label class="form-label">Password Baru (Opsional)</label>
                            <input class="form-control" type="password" name="password" placeholder="Kosongkan jika tidak ingin mengubah password">
                        </div>
                    </div>
                    
                    <button class="btn-primary" type="submit"><i class="fas fa-save"></i> Simpan Perubahan</button>
                </form>
            </section>
        </main>
    </div>
</body>
</html>
