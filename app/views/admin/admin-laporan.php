<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Global - Admin Lifesports</title>
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
                <li><a href="<?= BASEURL; ?>/admin/booking"><i class="fas fa-calendar-check"></i> Semua Booking</a></li>
                <li><a href="<?= BASEURL; ?>/admin/pembayaran"><i class="fas fa-credit-card"></i> Semua Pembayaran</a></li>
                <li><a href="<?= BASEURL; ?>/admin/laporan" class="active"><i class="fas fa-file-invoice"></i> Laporan</a></li>
                <li><a href="<?= BASEURL; ?>/auth/login" class="nav-danger"><i class="fas fa-sign-out-alt"></i> Keluar</a></li>
            </ul>
        </aside>

        <main class="main-content">
            <header class="dashboard-header">
                <div class="dash-title">
                    <h1>Laporan Global</h1>
                    <p>Rekap performa platform Lifesports secara keseluruhan</p>
                </div>
                <div class="filter-bar compact">
                    <select class="form-control" id="select-bulan-laporan">
                        <option>Mei 2026</option>
                        <option>Apr 2026</option>
                        <option>Mar 2026</option>
                    </select>
                    <button class="btn-primary compact-button" id="btn-export-laporan">
                        <i class="fas fa-download"></i> Ekspor
                    </button>
                </div>
            </header>

            <div class="dash-stats">
                <div class="dash-card">
                    <div class="dash-card-icon"><i class="fas fa-wallet"></i></div>
                    <div class="dash-card-info">
                        <h3>Total Pendapatan</h3>
                        <div class="value value-compact">Rp 64M</div>
                        <small>Bulan ini</small>
                    </div>
                </div>
                <div class="dash-card">
                    <div class="dash-card-icon"><i class="fas fa-calendar-check"></i></div>
                    <div class="dash-card-info">
                        <h3>Total Booking</h3>
                        <div class="value">450</div>
                        <small>Selesai: 280</small>
                    </div>
                </div>
                <div class="dash-card">
                    <div class="dash-card-icon"><i class="fas fa-users"></i></div>
                    <div class="dash-card-info">
                        <h3>User Baru</h3>
                        <div class="value">18</div>
                        <small>Bulan ini</small>
                    </div>
                </div>
                <div class="dash-card">
                    <div class="dash-card-icon"><i class="fas fa-building"></i></div>
                    <div class="dash-card-info">
                        <h3>Lapangan Aktif</h3>
                        <div class="value">14</div>
                        <small>Dari 18 total</small>
                    </div>
                </div>
            </div>

            <div class="section-grid two-col">

                <section class="table-container">
                    <div class="table-header">
                        <h2 class="table-title"><i class="fas fa-trophy"></i> Lapangan Terpopuler</h2>
                    </div>
                    <table class="data-table">
                        <thead>
                            <tr>
                                <th>Lapangan</th>
                                <th>Pengelola</th>
                                <th>Total Booking</th>
                                <th>Pendapatan</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><strong>Gelora Bung Karno</strong><br><small>Futsal</small></td>
                                <td>Bpk. Sudirman</td>
                                <td>42x</td>
                                <td>Rp 14.700.000</td>
                            </tr>
                            <tr>
                                <td><strong>Cilandak Sport</strong><br><small>Tennis</small></td>
                                <td>Bpk. Sudirman</td>
                                <td>38x</td>
                                <td>Rp 5.700.000</td>
                            </tr>
                            <tr>
                                <td><strong>Taufik Hidayat Arena</strong><br><small>Badminton</small></td>
                                <td>Bpk. Sudirman</td>
                                <td>31x</td>
                                <td>Rp 3.100.000</td>
                            </tr>
                        </tbody>
                    </table>
                </section>

                <section class="table-container">
                    <div class="table-header">
                        <h2 class="table-title"><i class="fas fa-medal"></i> Pengelola Terbaik</h2>
                    </div>
                    <table class="data-table">
                        <thead>
                            <tr>
                                <th>Pengelola</th>
                                <th>Lapangan</th>
                                <th>Booking</th>
                                <th>Pendapatan</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><strong>Bpk. Sudirman</strong></td>
                                <td>3</td>
                                <td>111x</td>
                                <td>Rp 23.500.000</td>
                            </tr>
                            <tr>
                                <td><strong>Ibu Ratna</strong></td>
                                <td>2</td>
                                <td>68x</td>
                                <td>Rp 17.000.000</td>
                            </tr>
                        </tbody>
                    </table>
                </section>
            </div>

            <div class="section-grid two-col">
                <section class="table-container">
                    <div class="table-header">
                        <h2 class="table-title"><i class="fas fa-chart-pie"></i> Status Booking</h2>
                    </div>
                    <table class="data-table">
                        <tbody>
                            <tr>
                                <td><span class="status-badge status-warning">Pending</span></td>
                                <td>45 booking</td>
                                <td class="text-right">Rp 4.500.000</td>
                            </tr>
                            <tr>
                                <td><span class="status-badge status-info">Confirmed</span></td>
                                <td>120 booking</td>
                                <td class="text-right">Rp 18.000.000</td>
                            </tr>
                            <tr>
                                <td><span class="status-badge status-success">Selesai</span></td>
                                <td>280 booking</td>
                                <td class="text-right">Rp 45.000.000</td>
                            </tr>
                            <tr>
                                <td><span class="status-badge status-danger">Dibatalkan</span></td>
                                <td>5 booking</td>
                                <td class="text-right">Rp 500.000</td>
                            </tr>
                        </tbody>
                    </table>
                </section>

                <section class="table-container">
                    <div class="table-header">
                        <h2 class="table-title"><i class="fas fa-chart-bar"></i> Status Pembayaran</h2>
                    </div>
                    <table class="data-table">
                        <tbody>
                            <tr>
                                <td><span class="status-badge status-success">Lunas</span></td>
                                <td>410 transaksi</td>
                                <td class="text-right">Rp 64.000.000</td>
                            </tr>
                            <tr>
                                <td><span class="status-badge status-warning">Pending</span></td>
                                <td>30 transaksi</td>
                                <td class="text-right">Rp 3.000.000</td>
                            </tr>
                            <tr>
                                <td><span class="status-badge status-danger">Gagal</span></td>
                                <td>10 transaksi</td>
                                <td class="text-right">Rp 1.000.000</td>
                            </tr>
                        </tbody>
                    </table>
                </section>
            </div>
        </main>
    </div>
</body>
</html>
