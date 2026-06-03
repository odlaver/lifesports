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
                <li><a href="<?= BASEURL; ?>/auth/logout" class="nav-danger"><i class="fas fa-sign-out-alt"></i> Keluar</a></li>
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
                        <div class="value value-compact">Rp <?= number_format($data['total_revenue'], 0, ',', '.'); ?></div>
                        <small>Seluruh Waktu</small>
                    </div>
                </div>
                <div class="dash-card">
                    <div class="dash-card-icon"><i class="fas fa-calendar-check"></i></div>
                    <div class="dash-card-info">
                        <h3>Total Booking</h3>
                        <div class="value"><?= $data['total_booking']; ?></div>
                        <small>Selesai: <?= $data['selesai_booking']; ?></small>
                    </div>
                </div>
                <div class="dash-card">
                    <div class="dash-card-icon"><i class="fas fa-users"></i></div>
                    <div class="dash-card-info">
                        <h3>Total User</h3>
                        <div class="value"><?= $data['total_user']; ?></div>
                        <small>Termasuk Pengelola</small>
                    </div>
                </div>
                <div class="dash-card">
                    <div class="dash-card-icon"><i class="fas fa-building"></i></div>
                    <div class="dash-card-info">
                        <h3>Total Lapangan</h3>
                        <div class="value"><?= $data['total_lapangan']; ?></div>
                        <small>Telah Terdaftar</small>
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
                            <?php if (empty($data['top_lapangan'])): ?>
                                <tr><td colspan="4" style="text-align: center;">Data tidak tersedia</td></tr>
                            <?php else: ?>
                                <?php foreach ($data['top_lapangan'] as $lap): ?>
                                <tr>
                                    <td><strong><?= htmlspecialchars($lap['nama_lapangan']); ?></strong><br><small><?= htmlspecialchars($lap['nama_kategori']); ?></small></td>
                                    <td><?= htmlspecialchars($lap['nama_pengelola']); ?></td>
                                    <td><?= $lap['total_booking']; ?>x</td>
                                    <td>Rp <?= number_format($lap['pendapatan'], 0, ',', '.'); ?></td>
                                </tr>
                                <?php endforeach; ?>
                            <?php endif; ?>
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
                            <?php if (empty($data['top_pengelola'])): ?>
                                <tr><td colspan="4" style="text-align: center;">Data tidak tersedia</td></tr>
                            <?php else: ?>
                                <?php foreach ($data['top_pengelola'] as $peng): ?>
                                <tr>
                                    <td><strong><?= htmlspecialchars($peng['nama_pengelola']); ?></strong></td>
                                    <td><?= $peng['jumlah_lapangan']; ?></td>
                                    <td><?= $peng['total_booking']; ?>x</td>
                                    <td>Rp <?= number_format($peng['pendapatan'], 0, ',', '.'); ?></td>
                                </tr>
                                <?php endforeach; ?>
                            <?php endif; ?>
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
                                <td><?= $data['booking_stats']['pending']['count'] ?? 0; ?> booking</td>
                                <td class="text-right">Rp <?= number_format($data['booking_stats']['pending']['total'] ?? 0, 0, ',', '.'); ?></td>
                            </tr>
                            <tr>
                                <td><span class="status-badge status-info">Confirmed</span></td>
                                <td><?= $data['booking_stats']['dikonfirmasi']['count'] ?? 0; ?> booking</td>
                                <td class="text-right">Rp <?= number_format($data['booking_stats']['dikonfirmasi']['total'] ?? 0, 0, ',', '.'); ?></td>
                            </tr>
                            <tr>
                                <td><span class="status-badge status-success">Selesai</span></td>
                                <td><?= $data['booking_stats']['selesai']['count'] ?? 0; ?> booking</td>
                                <td class="text-right">Rp <?= number_format($data['booking_stats']['selesai']['total'] ?? 0, 0, ',', '.'); ?></td>
                            </tr>
                            <tr>
                                <td><span class="status-badge status-danger">Dibatalkan</span></td>
                                <td><?= $data['booking_stats']['dibatalkan']['count'] ?? 0; ?> booking</td>
                                <td class="text-right">Rp <?= number_format($data['booking_stats']['dibatalkan']['total'] ?? 0, 0, ',', '.'); ?></td>
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
                                <td><?= $data['payment_stats']['valid']['count'] ?? 0; ?> transaksi</td>
                                <td class="text-right">Rp <?= number_format($data['payment_stats']['valid']['total'] ?? 0, 0, ',', '.'); ?></td>
                            </tr>
                            <tr>
                                <td><span class="status-badge status-warning">Pending</span></td>
                                <td><?= $data['payment_stats']['menunggu']['count'] ?? 0; ?> transaksi</td>
                                <td class="text-right">Rp <?= number_format($data['payment_stats']['menunggu']['total'] ?? 0, 0, ',', '.'); ?></td>
                            </tr>
                            <tr>
                                <td><span class="status-badge status-danger">Gagal</span></td>
                                <td><?= $data['payment_stats']['tidak_valid']['count'] ?? 0; ?> transaksi</td>
                                <td class="text-right">Rp <?= number_format($data['payment_stats']['tidak_valid']['total'] ?? 0, 0, ',', '.'); ?></td>
                            </tr>
                        </tbody>
                    </table>
                </section>
            </div>
        </main>
    </div>
</body>
</html>
