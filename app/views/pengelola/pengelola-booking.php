<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking Masuk - Lifesports</title>
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
                <li><a href="<?= BASEURL; ?>/pengelola/booking" class="active"><i class="fas fa-calendar-check"></i> Booking Masuk</a></li>
                <li><a href="<?= BASEURL; ?>/pengelola/pembayaran"><i class="fas fa-credit-card"></i> Pembayaran</a></li>
                <li><a href="<?= BASEURL; ?>/pengelola/laporan"><i class="fas fa-file-invoice"></i> Laporan</a></li>
                <li><a href="<?= BASEURL; ?>/auth/logout" class="nav-danger"><i class="fas fa-sign-out-alt"></i> Keluar</a></li>
            </ul>
        </aside>
        <main class="main-content">
            <header class="dashboard-header"><div class="dash-title"><h1>Booking Masuk</h1><p>Konfirmasi reservasi dan pantau jadwal harian.</p></div></header>
            <section class="table-container">
                <div class="filter-bar compact"><input class="form-control" placeholder="Cari pelanggan atau kode"><select class="form-control"><option>Semua Status</option><option>Pending</option><option>Confirmed</option><option>Selesai</option></select><input class="form-control" type="date"><button class="btn-primary compact-button"><i class="fas fa-filter"></i> Filter</button></div>
                <table class="data-table">
                    <thead><tr><th>Kode</th><th>Pelanggan</th><th>Lapangan</th><th>Jadwal</th><th>Status</th><th>Aksi</th></tr></thead>
                    <tbody>
                        <?php if (empty($data['booking'])): ?>
                            <tr>
                                <td colspan="6" style="text-align: center; color: var(--text-muted); padding: 20px;">
                                    Belum ada booking masuk.
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
                                    <td><?= date('d M Y', strtotime($row['tanggal_main'])); ?>, <?= date('H:i', strtotime($row['jam_mulai'])); ?></td>
                                    <td><span class="status-badge <?= $status_class; ?>"><?= $status_label; ?></span></td>
                                    <td><a href="<?= BASEURL; ?>/pengelola/booking_detail/<?= $row['id']; ?>" class="btn-action"><i class="fas fa-eye"></i></a></td>
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
