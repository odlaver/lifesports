<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lapangan Saya - Lifesports</title>
    <link rel="stylesheet" href="<?= BASEURL; ?>/public/assets/css/styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>
    <div class="dashboard-container">
        <aside class="sidebar">
            <div class="sidebar-header"><div class="sidebar-brand">Lifesports</div><div class="role-label">PENGELOLA</div></div>
            <ul class="sidebar-menu">
                <li><a href="<?= BASEURL; ?>/pengelola"><i class="fas fa-home"></i> Dashboard</a></li>
                <li><a href="<?= BASEURL; ?>/pengelola/lapangan" class="active"><i class="fas fa-building"></i> Lapangan Saya</a></li>
                <li><a href="<?= BASEURL; ?>/pengelola/booking"><i class="fas fa-calendar-check"></i> Booking Masuk</a></li>
                <li><a href="<?= BASEURL; ?>/pengelola/pembayaran"><i class="fas fa-credit-card"></i> Pembayaran</a></li>
                <li><a href="<?= BASEURL; ?>/pengelola/laporan"><i class="fas fa-file-invoice"></i> Laporan</a></li>
                <li><a href="<?= BASEURL; ?>/auth/logout" class="nav-danger"><i class="fas fa-sign-out-alt"></i> Keluar</a></li>
            </ul>
        </aside>
        <main class="main-content">
            <header class="dashboard-header">
                <div class="dash-title"><h1>Lapangan Saya</h1><p>Kelola status, harga, dan performa lapangan.</p></div>
                <a href="<?= BASEURL; ?>/pengelola/lapangan_form" class="btn-primary"><i class="fas fa-plus"></i> Tambah Lapangan</a>
            </header>
            <section class="table-container">
                <div class="filter-bar compact">
                    <input class="form-control" placeholder="Cari nama lapangan">
                    <select class="form-control"><option>Semua Status</option><option>Tersedia</option><option>Maintenance</option><option>Nonaktif</option></select>
                    <select class="form-control"><option>Semua Kategori</option><option>Futsal</option><option>Tennis</option><option>Badminton</option></select>
                    <button class="btn-primary compact-button"><i class="fas fa-filter"></i> Filter</button>
                </div>
                <table class="data-table">
                    <thead><tr><th>Lapangan</th><th>Kategori</th><th>Harga</th><th>Total Booking</th><th>Status</th><th>Aksi</th></tr></thead>
                    <tbody>
                        <?php if (empty($data['lapangan'])): ?>
                            <tr>
                                <td colspan="6" style="text-align: center; color: var(--text-muted); padding: 20px;">
                                    Belum ada data lapangan yang Anda miliki.
                                </td>
                            </tr>
                        <?php else: ?>
                            <?php foreach ($data['lapangan'] as $row): 
                                $status_class = $row['status'] === 'aktif' ? 'status-success' : 'status-danger';
                                $status_label = $row['status'] === 'aktif' ? 'Tersedia' : 'Nonaktif';
                            ?>
                                <tr>
                                    <td><strong><?= htmlspecialchars($row['nama_lapangan']); ?></strong><br><small>Bandar Lampung</small></td>
                                    <td><?= htmlspecialchars($row['nama_kategori']); ?></td>
                                    <td>Rp <?= number_format($row['harga_per_jam'], 0, ',', '.'); ?>/jam</td>
                                    <td><?= $row['total_booking']; ?>x</td>
                                    <td><span class="status-badge <?= $status_class; ?>"><?= $status_label; ?></span></td>
                                    <td><a href="<?= BASEURL; ?>/pengelola/lapangan_form/<?= $row['id']; ?>" class="btn-action"><i class="fas fa-pen"></i></a></td>
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
