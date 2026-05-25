<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Semua Booking - Admin Lifesports</title>
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
                    <h1>Monitoring Booking</h1>
                    <p>Seluruh data booking dari semua pengelola dan pelanggan</p>
                </div>
            </header>

            <div class="dash-stats">
                <div class="dash-card">
                    <div class="dash-card-icon"><i class="fas fa-calendar-check"></i></div>
                    <div class="dash-card-info">
                        <h3>Total Booking</h3>
                        <div class="value">450</div>
                    </div>
                </div>
                <div class="dash-card">
                    <div class="dash-card-icon warning"><i class="fas fa-clock"></i></div>
                    <div class="dash-card-info">
                        <h3>Pending</h3>
                        <div class="value value-warning">45</div>
                    </div>
                </div>
                <div class="dash-card">
                    <div class="dash-card-icon"><i class="fas fa-check-circle"></i></div>
                    <div class="dash-card-info">
                        <h3>Selesai</h3>
                        <div class="value">280</div>
                    </div>
                </div>
                <div class="dash-card">
                    <div class="dash-card-icon"><i class="fas fa-times-circle"></i></div>
                    <div class="dash-card-info">
                        <h3>Dibatalkan</h3>
                        <div class="value">5</div>
                    </div>
                </div>
            </div>

            <section class="table-container">
                <div class="table-header">
                    <h2 class="table-title"><i class="fas fa-list"></i> Daftar Booking</h2>
                </div>
                <div class="filter-bar compact">
                    <input class="form-control" id="input-search-booking" placeholder="Cari kode booking atau pelanggan...">
                    <select class="form-control" id="select-status-booking">
                        <option>Semua Status</option>
                        <option>Pending</option>
                        <option>Confirmed</option>
                        <option>Selesai</option>
                        <option>Dibatalkan</option>
                    </select>
                    <input class="form-control" id="input-tgl-booking" type="date">
                    <button class="btn-primary compact-button" id="btn-filter-booking"><i class="fas fa-filter"></i> Filter</button>
                </div>
                <table class="data-table">
                    <thead>
                        <tr>
                            <th>Kode</th>
                            <th>Pelanggan</th>
                            <th>Lapangan</th>
                            <th>Pengelola</th>
                            <th>Tanggal</th>
                            <th>Jam</th>
                            <th>Total</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><strong>BKG2026042812345</strong></td>
                            <td>Andi Saputra</td>
                            <td>Gelora Bung Karno</td>
                            <td>Bpk. Sudirman</td>
                            <td>28 Apr 2026</td>
                            <td>19:00-21:00</td>
                            <td>Rp 700.000</td>
                            <td><span class="status-badge status-success">Selesai</span></td>
                            <td><a href="<?= BASEURL; ?>/admin/booking_detail" class="btn-action" title="Detail"><i class="fas fa-eye"></i></a></td>
                        </tr>
                        <tr>
                            <td><strong>BKG2026042898765</strong></td>
                            <td>Budi Santoso</td>
                            <td>Cilandak Sport</td>
                            <td>Bpk. Sudirman</td>
                            <td>29 Apr 2026</td>
                            <td>08:00-10:00</td>
                            <td>Rp 300.000</td>
                            <td><span class="status-badge status-warning">Pending</span></td>
                            <td><a href="<?= BASEURL; ?>/admin/booking_detail" class="btn-action" title="Detail"><i class="fas fa-eye"></i></a></td>
                        </tr>
                        <tr>
                            <td><strong>BKG2026042854321</strong></td>
                            <td>Citra Lestari</td>
                            <td>Taufik Hidayat Arena</td>
                            <td>Bpk. Sudirman</td>
                            <td>29 Apr 2026</td>
                            <td>15:00-17:00</td>
                            <td>Rp 200.000</td>
                            <td><span class="status-badge status-info">Confirmed</span></td>
                            <td><a href="<?= BASEURL; ?>/admin/booking_detail" class="btn-action" title="Detail"><i class="fas fa-eye"></i></a></td>
                        </tr>
                        <tr>
                            <td><strong>BKG2026042867890</strong></td>
                            <td>Deni Ramdani</td>
                            <td>Gelora Bung Karno</td>
                            <td>Bpk. Sudirman</td>
                            <td>30 Apr 2026</td>
                            <td>20:00-22:00</td>
                            <td>Rp 700.000</td>
                            <td><span class="status-badge status-danger">Dibatalkan</span></td>
                            <td><a href="<?= BASEURL; ?>/admin/booking_detail" class="btn-action" title="Detail"><i class="fas fa-eye"></i></a></td>
                        </tr>
                    </tbody>
                </table>
            </section>
        </main>
    </div>
</body>
</html>
