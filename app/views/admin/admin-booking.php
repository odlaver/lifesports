<?php
$total_booking = count($data['booking']);
$total_pending = 0;
$total_confirmed = 0;
$total_selesai = 0;
foreach ($data['booking'] as $b) {
    if ($b['status'] === 'pending' || $b['status'] === 'dibayar') $total_pending++;
    elseif ($b['status'] === 'dikonfirmasi') $total_confirmed++;
    elseif ($b['status'] === 'selesai') $total_selesai++;
}
?>
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
                <li><a href="<?= BASEURL; ?>/auth/logout" class="nav-danger"><i class="fas fa-sign-out-alt"></i> Keluar</a></li>
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
                        <div class="value"><?= $total_booking; ?></div>
                    </div>
                </div>
                <div class="dash-card">
                    <div class="dash-card-icon warning"><i class="fas fa-clock"></i></div>
                    <div class="dash-card-info">
                        <h3>Pending / Paid</h3>
                        <div class="value value-warning"><?= $total_pending; ?></div>
                    </div>
                </div>
                <div class="dash-card">
                    <div class="dash-card-icon"><i class="fas fa-check-circle"></i></div>
                    <div class="dash-card-info">
                        <h3>Dikonfirmasi</h3>
                        <div class="value"><?= $total_confirmed; ?></div>
                    </div>
                </div>
                <div class="dash-card">
                    <div class="dash-card-icon"><i class="fas fa-flag-checkered"></i></div>
                    <div class="dash-card-info">
                        <h3>Selesai</h3>
                        <div class="value"><?= $total_selesai; ?></div>
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
                        <?php if (empty($data['booking'])): ?>
                            <tr>
                                <td colspan="9" style="text-align: center; color: var(--text-muted); padding: 20px;">
                                    Belum ada data booking.
                                </td>
                            </tr>
                        <?php else: ?>
                            <?php foreach ($data['booking'] as $row): 
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
                                    <td><?= htmlspecialchars($row['nama_pengelola']); ?></td>
                                    <td><?= date('d M Y', strtotime($row['tanggal_main'])); ?></td>
                                    <td><?= date('H:i', strtotime($row['jam_mulai'])); ?> - <?= date('H:i', strtotime($row['jam_selesai'])); ?></td>
                                    <td>Rp <?= number_format($row['total_harga'], 0, ',', '.'); ?></td>
                                    <td><span class="status-badge <?= $status_class; ?>"><?= $status_label; ?></span></td>
                                    <td>
                                        <button class="btn-action" title="Detail" onclick="alert('Kode Booking: <?= htmlspecialchars($row['kode_booking']); ?>\nPelanggan: <?= htmlspecialchars($row['nama_pelanggan']); ?>\nLapangan: <?= htmlspecialchars($row['nama_lapangan']); ?>\nPengelola: <?= htmlspecialchars($row['nama_pengelola']); ?>\nStatus: <?= ucfirst($row['status']); ?>')"><i class="fas fa-eye"></i></button>
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
