<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin - Lifesports</title>
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
                <li><a href="<?= BASEURL; ?>/admin" class="active"><i class="fas fa-home"></i> Dashboard</a></li>
                <li><a href="<?= BASEURL; ?>/admin/users"><i class="fas fa-users"></i> Kelola User</a></li>
                <li><a href="<?= BASEURL; ?>/admin/kategori"><i class="fas fa-tags"></i> Kategori</a></li>
                <li><a href="<?= BASEURL; ?>/admin/lapangan"><i class="fas fa-building"></i> Semua Lapangan</a></li>
                <li><a href="<?= BASEURL; ?>/admin/booking"><i class="fas fa-calendar-check"></i> Semua Booking</a></li>
                <li><a href="<?= BASEURL; ?>/admin/pembayaran"><i class="fas fa-credit-card"></i> Semua Pembayaran</a></li>
                <li><a href="<?= BASEURL; ?>/admin/laporan"><i class="fas fa-file-invoice"></i> Laporan</a></li>
                <li><a href="<?= BASEURL; ?>/auth/logout" class="nav-danger"><i class="fas fa-sign-out-alt"></i> Keluar</a></li>
            </ul>
        </aside>

        <main class="main-content">

            <header class="dashboard-header">
                <div class="dash-title">
                    <h1>Dashboard Admin</h1>
                    <p>Ringkasan keseluruhan sistem penyewaan lapangan</p>
                </div>

                <div class="dash-profile">
                    <div class="profile-info">
                        <div class="profile-name"><?= htmlspecialchars($_SESSION['nama']); ?></div>
                        <div class="profile-role">Super Admin</div>
                    </div>
                    <div class="profile-img">
                        <i class="fas fa-user-shield"></i>
                    </div>
                </div>
            </header>


            <div class="dash-stats">
                <div class="dash-card">
                    <div class="dash-card-icon"><i class="fas fa-users"></i></div>
                    <div class="dash-card-info">
                        <h3>Total User</h3>
                        <div class="value"><?= $data['total_user']; ?></div>
                    </div>
                </div>
                <div class="dash-card">
                    <div class="dash-card-icon"><i class="fas fa-building"></i></div>
                    <div class="dash-card-info">
                        <h3>Total Lapangan</h3>
                        <div class="value"><?= $data['total_lapangan']; ?></div>
                    </div>
                </div>
                <div class="dash-card">
                    <div class="dash-card-icon"><i class="fas fa-calendar-check"></i></div>
                    <div class="dash-card-info">
                        <h3>Total Booking</h3>
                        <div class="value"><?= $data['total_booking']; ?></div>
                    </div>
                </div>
                <div class="dash-card">
                    <div class="dash-card-icon"><i class="fas fa-wallet"></i></div>
                    <div class="dash-card-info">
                        <h3>Pendapatan</h3>
                        <div class="value value-compact">Rp <?= number_format($data['total_revenue'], 0, ',', '.'); ?></div>
                    </div>
                </div>
            </div>

            <div class="section-grid two-col">

                <div class="table-container" id="statistik-booking">
                    <div class="table-header">
                        <h2 class="table-title">Statistik Booking</h2>
                    </div>
                    <table class="data-table">
                        <tbody>
                            <tr>
                                <td><span class="status-badge status-warning">Pending</span></td>
                                <td><?= $data['booking_stats']['pending']['count']; ?> booking</td>
                                <td class="text-right">Rp <?= number_format($data['booking_stats']['pending']['total'], 0, ',', '.'); ?></td>
                            </tr>
                            <tr>
                                <td><span class="status-badge status-info">Confirmed</span></td>
                                <td><?= $data['booking_stats']['dikonfirmasi']['count']; ?> booking</td>
                                <td class="text-right">Rp <?= number_format($data['booking_stats']['dikonfirmasi']['total'], 0, ',', '.'); ?></td>
                            </tr>
                            <tr>
                                <td><span class="status-badge status-success">Selesai</span></td>
                                <td><?= $data['booking_stats']['selesai']['count']; ?> booking</td>
                                <td class="text-right">Rp <?= number_format($data['booking_stats']['selesai']['total'], 0, ',', '.'); ?></td>
                            </tr>
                            <tr>
                                <td><span class="status-badge status-danger">Dibatalkan</span></td>
                                <td><?= $data['booking_stats']['dibatalkan']['count']; ?> booking</td>
                                <td class="text-right">Rp <?= number_format($data['booking_stats']['dibatalkan']['total'], 0, ',', '.'); ?></td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <div class="table-container" id="statistik-pembayaran">
                    <div class="table-header">
                        <h2 class="table-title">Statistik Pembayaran</h2>
                    </div>
                    <table class="data-table">
                        <tbody>
                            <tr>
                                <td><span class="status-badge status-warning">Pending</span></td>
                                <td><?= $data['payment_stats']['menunggu']['count']; ?> transaksi</td>
                                <td class="text-right">Rp <?= number_format($data['payment_stats']['menunggu']['total'], 0, ',', '.'); ?></td>
                            </tr>
                            <tr>
                                <td><span class="status-badge status-success">Lunas / Valid</span></td>
                                <td><?= $data['payment_stats']['valid']['count']; ?> transaksi</td>
                                <td class="text-right">Rp <?= number_format($data['payment_stats']['valid']['total'], 0, ',', '.'); ?></td>
                            </tr>
                            <tr>
                                <td><span class="status-badge status-danger">Gagal / Tidak Valid</span></td>
                                <td><?= $data['payment_stats']['tidak_valid']['count']; ?> transaksi</td>
                                <td class="text-right">Rp <?= number_format($data['payment_stats']['tidak_valid']['total'], 0, ',', '.'); ?></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="table-container" id="booking-terbaru">
                <div class="table-header">
                    <h2 class="table-title">Booking Terbaru</h2>
                    <a href="<?= BASEURL; ?>/admin/booking" class="btn-primary compact-button">Lihat Semua</a>
                </div>

                <table class="data-table">
                    <thead>
                        <tr>
                            <th>Kode</th>
                            <th>Pelanggan</th>
                            <th>Lapangan</th>
                            <th>Tanggal</th>
                            <th>Jam</th>
                            <th>Total</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (empty($data['booking_terbaru'])): ?>
                            <tr>
                                <td colspan="7" style="text-align: center; color: var(--text-muted); padding: 20px;">
                                    Belum ada booking terbaru.
                                </td>
                            </tr>
                        <?php else: ?>
                            <?php foreach ($data['booking_terbaru'] as $row): 
                                $status_class = 'status-pending';
                                $status_label = 'Pending';
                                if ($row['status'] === 'dibayar') {
                                    $status_class = 'status-info';
                                    $status_label = 'Dibayar';
                                } elseif ($row['status'] === 'dikonfirmasi') {
                                    $status_class = 'status-warning';
                                    $status_label = 'Dikonfirmasi';
                                } elseif ($row['status'] === 'selesai') {
                                    $status_class = 'status-success';
                                    $status_label = 'Selesai';
                                } elseif ($row['status'] === 'dibatalkan') {
                                    $status_class = 'status-danger';
                                    $status_label = 'Dibatalkan';
                                }
                            ?>
                                <tr>
                                    <td><strong><?= htmlspecialchars($row['kode_booking']); ?></strong></td>
                                    <td><?= htmlspecialchars($row['nama_pelanggan']); ?></td>
                                    <td><?= htmlspecialchars($row['nama_lapangan']); ?> (<?= htmlspecialchars($row['nama_kategori']); ?>)</td>
                                    <td><?= date('d M Y', strtotime($row['tanggal_main'])); ?></td>
                                    <td><?= date('H:i', strtotime($row['jam_mulai'])); ?> - <?= date('H:i', strtotime($row['jam_selesai'])); ?></td>
                                    <td>Rp <?= number_format($row['total_harga'], 0, ',', '.'); ?></td>
                                    <td><span class="status-badge <?= $status_class; ?>"><?= $status_label; ?></span></td>
                                </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>

        </main>
    </div>

</body>
</html>
