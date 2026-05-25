<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Booking - Admin Lifesports</title>
    <link rel="stylesheet" href="<?= BASEURL; ?>/public/assets/css/styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>
    <div class="dashboard-container">
        <aside class="sidebar">
            <div class="sidebar-header">
                <div class="sidebar-brand">Lifesports</div>
                <div class="role-label">SUPER ADMIN</div>
            </div>
            <ul class="sidebar-menu">
                <li><a href="<?= BASEURL; ?>/admin"><i class="fas fa-home"></i> Dashboard</a></li>
                <li><a href="<?= BASEURL; ?>/admin/users"><i class="fas fa-users"></i> Kelola User</a></li>
                <li><a href="<?= BASEURL; ?>/admin/kategori"><i class="fas fa-tags"></i> Kategori</a></li>
                <li><a href="<?= BASEURL; ?>/admin/lapangan"><i class="fas fa-building"></i> Semua Lapangan</a></li>
                <li><a href="<?= BASEURL; ?>/admin/booking" class="active"><i class="fas fa-calendar-check"></i> Semua Booking</a></li>
                <li><a href="<?= BASEURL; ?>/admin/pembayaran"><i class="fas fa-credit-card"></i> Semua Pembayaran</a></li>
                <li><a href="<?= BASEURL; ?>/admin/laporan"><i class="fas fa-file-invoice"></i> Laporan</a></li>
                <li><a href="<?= BASEURL; ?>/auth/login" class="nav-danger"><i class="fas fa-sign-out-alt"></i> Keluar</a></li>
            </ul>
        </aside>

        <main class="main-content">
            <header class="dashboard-header">
                <div class="dash-title">
                    <h1>Detail Booking</h1>
                    <p>Informasi lengkap transaksi booking lintas sistem</p>
                </div>
                <a href="<?= BASEURL; ?>/admin/booking" class="btn-primary ghost-light" id="btn-back-booking">
                    <i class="fas fa-arrow-left"></i> Kembali
                </a>
            </header>

            <div class="detail-layout">

                <section class="table-container">
                    <div class="table-header">
                        <h2 class="table-title"><i class="fas fa-calendar-check"></i> BKG2026042812345</h2>
                        <span class="status-badge status-success">Selesai</span>
                    </div>
                    <div class="info-row">
                        <span><i class="fas fa-building"></i> Lapangan</span>
                        <strong>Gelora Bung Karno Arena</strong>
                    </div>
                    <div class="info-row">
                        <span><i class="fas fa-user"></i> Pelanggan</span>
                        <strong>Andi Saputra</strong>
                    </div>
                    <div class="info-row">
                        <span><i class="fas fa-user-tie"></i> Pengelola</span>
                        <strong>Bpk. Sudirman</strong>
                    </div>
                    <div class="info-row">
                        <span><i class="fas fa-calendar-alt"></i> Tanggal Main</span>
                        <strong>28 Apr 2026</strong>
                    </div>
                    <div class="info-row">
                        <span><i class="fas fa-clock"></i> Jam</span>
                        <strong>19:00 - 21:00 (2 jam)</strong>
                    </div>
                    <div class="info-row">
                        <span><i class="fas fa-tags"></i> Kategori</span>
                        <strong>Futsal</strong>
                    </div>
                    <div class="info-row">
                        <span><i class="fas fa-money-bill-wave"></i> Total Biaya</span>
                        <strong>Rp 700.000</strong>
                    </div>
                    <div class="info-row">
                        <span><i class="fas fa-credit-card"></i> Status Bayar</span>
                        <strong><span class="status-badge status-success">Lunas</span></strong>
                    </div>
                    <div class="info-row">
                        <span><i class="fas fa-calendar-plus"></i> Dibuat</span>
                        <strong>25 Apr 2026, 14:32</strong>
                    </div>
                </section>

                <div>

                    <section class="summary-panel">
                        <div class="table-header">
                            <h2 class="table-title"><i class="fas fa-receipt"></i> Pembayaran</h2>
                        </div>
                        <div class="info-row">
                            <span>Metode</span>
                            <strong>Virtual Account BCA</strong>
                        </div>
                        <div class="info-row">
                            <span>Waktu Bayar</span>
                            <strong>25 Apr 2026, 14:50</strong>
                        </div>
                        <div class="info-row">
                            <span>No. Transaksi</span>
                            <strong>TRX-202604250022</strong>
                        </div>
                        <div class="info-row">
                            <span>Status</span>
                            <strong><span class="status-badge status-success">Lunas</span></strong>
                        </div>
                    </section>

                    <section class="summary-panel">
                        <div class="table-header">
                            <h2 class="table-title"><i class="fas fa-cog"></i> Aksi Admin</h2>
                        </div>
                        <div class="stack">
                            <button class="btn-primary ghost-warning" id="btn-force-confirm">
                                <i class="fas fa-check-circle"></i> Force Confirm
                            </button>
                            <button class="btn-primary danger" id="btn-force-cancel">
                                <i class="fas fa-times-circle"></i> Force Batalkan
                            </button>
                        </div>
                    </section>
                </div>
            </div>
        </main>
    </div>
</body>
</html>
