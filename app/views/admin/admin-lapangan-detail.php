<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Lapangan - Admin Lifesports</title>
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
                <li><a href="<?= BASEURL; ?>/admin/lapangan" class="active"><i class="fas fa-building"></i> Semua Lapangan</a></li>
                <li><a href="<?= BASEURL; ?>/admin/booking"><i class="fas fa-calendar-check"></i> Semua Booking</a></li>
                <li><a href="<?= BASEURL; ?>/admin/pembayaran"><i class="fas fa-credit-card"></i> Semua Pembayaran</a></li>
                <li><a href="<?= BASEURL; ?>/admin/laporan"><i class="fas fa-file-invoice"></i> Laporan</a></li>
                <li><a href="<?= BASEURL; ?>/auth/login" class="nav-danger"><i class="fas fa-sign-out-alt"></i> Keluar</a></li>
            </ul>
        </aside>

        <main class="main-content">
            <header class="dashboard-header">
                <div class="dash-title">
                    <h1>Detail Lapangan</h1>
                    <p>Informasi lengkap lapangan beserta pengelola dan performa</p>
                </div>
                <a href="<?= BASEURL; ?>/admin/lapangan" class="btn-primary ghost-light" id="btn-back-lapangan">
                    <i class="fas fa-arrow-left"></i> Kembali
                </a>
            </header>

            <div class="detail-layout">

                <section class="table-container">
                    <div class="table-header">
                        <h2 class="table-title"><i class="fas fa-building"></i> Gelora Bung Karno Arena</h2>
                        <span class="status-badge status-success">Tersedia</span>
                    </div>
                    <div class="info-row">
                        <span><i class="fas fa-tags"></i> Kategori</span>
                        <strong>Futsal</strong>
                    </div>
                    <div class="info-row">
                        <span><i class="fas fa-map-marker-alt"></i> Lokasi</span>
                        <strong>Senayan, Jakarta Pusat</strong>
                    </div>
                    <div class="info-row">
                        <span><i class="fas fa-money-bill-wave"></i> Harga/Jam</span>
                        <strong>Rp 350.000</strong>
                    </div>
                    <div class="info-row">
                        <span><i class="fas fa-user-tie"></i> Pengelola</span>
                        <strong>Bpk. Sudirman</strong>
                    </div>
                    <div class="info-row">
                        <span><i class="fas fa-envelope"></i> Kontak</span>
                        <strong>sudirman@email.com</strong>
                    </div>
                    <div class="info-row">
                        <span><i class="fas fa-calendar-plus"></i> Ditambahkan</span>
                        <strong>15 Jan 2026</strong>
                    </div>
                </section>

                <div>

                    <section class="summary-panel">
                        <div class="table-header">
                            <h2 class="table-title"><i class="fas fa-chart-bar"></i> Performa</h2>
                        </div>
                        <div class="metric-grid">
                            <div class="metric-item">
                                <div class="metric-value">42x</div>
                                <div class="metric-label">Total Booking</div>
                            </div>
                            <div class="metric-item">
                                <div class="metric-value">Rp 14.7M</div>
                                <div class="metric-label">Pendapatan</div>
                            </div>
                            <div class="metric-item">
                                <div class="metric-value rating-row"><i class="fas fa-star"></i> 4.9</div>
                                <div class="metric-label">Rating</div>
                            </div>
                            <div class="metric-item">
                                <div class="metric-value">24</div>
                                <div class="metric-label">Review</div>
                            </div>
                        </div>
                    </section>

                    <section class="summary-panel">
                        <div class="table-header">
                            <h2 class="table-title"><i class="fas fa-cog"></i> Aksi Admin</h2>
                        </div>
                        <div class="stack">
                            <button class="btn-primary ghost-warning" id="btn-set-maintenance">
                                <i class="fas fa-tools"></i> Set Maintenance
                            </button>
                            <button class="btn-primary ghost-light" id="btn-set-nonaktif">
                                <i class="fas fa-power-off"></i> Nonaktifkan Lapangan
                            </button>
                            <button class="btn-primary danger" id="btn-hapus-lapangan">
                                <i class="fas fa-trash"></i> Hapus Lapangan
                            </button>
                        </div>
                    </section>
                </div>
            </div>

            <section class="table-container">
                <div class="table-header">
                    <h2 class="table-title"><i class="fas fa-history"></i> Riwayat Booking Lapangan Ini</h2>
                </div>
                <table class="data-table">
                    <thead>
                        <tr>
                            <th>Kode Booking</th>
                            <th>Pelanggan</th>
                            <th>Tanggal</th>
                            <th>Jam</th>
                            <th>Total</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><strong>BKG2026042812345</strong></td>
                            <td>Andi Saputra</td>
                            <td>28 Apr 2026</td>
                            <td>19:00 - 21:00</td>
                            <td>Rp 700.000</td>
                            <td><span class="status-badge status-success">Selesai</span></td>
                        </tr>
                        <tr>
                            <td><strong>BKG2026042867890</strong></td>
                            <td>Deni Ramdani</td>
                            <td>30 Apr 2026</td>
                            <td>20:00 - 22:00</td>
                            <td>Rp 700.000</td>
                            <td><span class="status-badge status-danger">Dibatalkan</span></td>
                        </tr>
                    </tbody>
                </table>
            </section>
        </main>
    </div>
</body>
</html>
