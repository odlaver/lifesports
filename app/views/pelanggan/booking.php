<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Riwayat Booking - Lifesports</title>
    <link rel="stylesheet" href="<?= BASEURL; ?>/public/assets/css/styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>
    <div class="dashboard-container">
        <aside class="sidebar">
            <div class="sidebar-header">
                <div class="sidebar-brand">Lifesports</div>
                <div class="role-label">MEMBER</div>
            </div>
            <ul class="sidebar-menu">
                <li><a href="<?= BASEURL; ?>/pelanggan"><i class="fas fa-home"></i> Dashboard</a></li>
                <li><a href="<?= BASEURL; ?>/pelanggan/booking" class="active"><i class="fas fa-calendar-check"></i> Riwayat Booking</a></li>
                <li><a href="<?= BASEURL; ?>/pelanggan/profile"><i class="fas fa-user"></i> Profile Saya</a></li>
                <li><a href="<?= BASEURL; ?>/pelanggan/lapangan"><i class="fas fa-search"></i> Cari Lapangan</a></li>
                <li><a href="<?= BASEURL; ?>/auth/logout" class="nav-danger"><i class="fas fa-sign-out-alt"></i> Keluar</a></li>
            </ul>
        </aside>

        <main class="main-content">
            <header class="dashboard-header">
                <div class="dash-title">
                    <h1>Riwayat Booking</h1>
                    <p>Pantau jadwal main, pembayaran, dan review dari satu tempat.</p>
                </div>
                <a href="<?= BASEURL; ?>/pelanggan/lapangan" class="btn-primary"><i class="fas fa-plus"></i> Booking Baru</a>
            </header>

            <?php 
                $total = count($data['booking']);
                $pending = count(array_filter($data['booking'], function($b) { return $b['status'] === 'pending' || $b['status'] === 'dibayar'; }));
                $selesai = count(array_filter($data['booking'], function($b) { return $b['status'] === 'selesai'; }));
            ?>
            <div class="dash-stats">
                <div class="dash-card">
                    <div class="dash-card-icon"><i class="fas fa-calendar"></i></div>
                    <div class="dash-card-info"><h3>Total Booking</h3><div class="value"><?= $total; ?></div></div>
                </div>
                <div class="dash-card">
                    <div class="dash-card-icon warning"><i class="fas fa-clock"></i></div>
                    <div class="dash-card-info"><h3>Pending</h3><div class="value value-warning"><?= $pending; ?></div></div>
                </div>
                <div class="dash-card">
                    <div class="dash-card-icon"><i class="fas fa-check-circle"></i></div>
                    <div class="dash-card-info"><h3>Selesai</h3><div class="value"><?= $selesai; ?></div></div>
                </div>
                <div class="dash-card">
                    <div class="dash-card-icon"><i class="fas fa-wallet"></i></div>
                    <div class="dash-card-info">
                        <h3>Total Pengeluaran</h3>
                        <div class="value value-compact" style="font-size: 1.1rem; font-weight: 700; color: var(--text-gold);">
                            Rp <?= number_format(array_sum(array_map(function($b) { return $b['status'] !== 'dibatalkan' ? $b['total_harga'] : 0; }, $data['booking'])), 0, ',', '.'); ?>
                        </div>
                    </div>
                </div>
            </div>

            <section class="table-container">
                <table class="data-table">
                    <thead>
                        <tr>
                            <th>Kode</th>
                            <th>Lapangan</th>
                            <th>Jadwal Main</th>
                            <th>Total</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (empty($data['booking'])): ?>
                            <tr>
                                <td colspan="6" style="text-align: center; color: var(--text-muted); padding: 30px;">
                                    Belum ada transaksi pemesanan lapangan.
                                </td>
                            </tr>
                        <?php else: ?>
                            <?php foreach($data['booking'] as $row): 
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
                                    <td><?= htmlspecialchars($row['nama_lapangan']); ?><br><small><?= htmlspecialchars($row['nama_kategori']); ?></small></td>
                                    <td><?= date('d M Y', strtotime($row['tanggal_main'])); ?><br><small><?= date('H:i', strtotime($row['jam_mulai'])) . ' - ' . date('H:i', strtotime($row['jam_selesai'])); ?></small></td>
                                    <td>Rp <?= number_format($row['total_harga'], 0, ',', '.'); ?></td>
                                    <td><span class="status-badge <?= $status_class; ?>"><?= $status_label; ?></span></td>
                                    <td>
                                        <a href="<?= BASEURL; ?>/pelanggan/booking_detail/<?= $row['id']; ?>" class="btn-action"><i class="fas fa-eye"></i> Detail</a>
                                        <?php if ($row['status'] === 'selesai'): ?>
                                            <a href="<?= BASEURL; ?>/pelanggan/review/<?= $row['id']; ?>" class="btn-action warning" style="margin-left: 5px;"><i class="fas fa-star"></i> Review</a>
                                        <?php elseif ($row['status'] === 'pending'): ?>
                                            <a href="<?= BASEURL; ?>/pelanggan/pembayaran/<?= $row['id']; ?>" class="btn-action success" style="margin-left: 5px; background: rgba(46,139,87,0.1); color: var(--status-success); border: 1px solid rgba(46,139,87,0.3);"><i class="fas fa-wallet"></i> Bayar</a>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                </table>
            </section>
        </main>
    </div>
</body>
</html>

