<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Pengelola - Lifesports</title>
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
                <li><a href="<?= BASEURL; ?>/pengelola/booking"><i class="fas fa-calendar-check"></i> Booking Masuk</a></li>
                <li><a href="<?= BASEURL; ?>/pengelola/pembayaran"><i class="fas fa-credit-card"></i> Pembayaran</a></li>
                <li><a href="<?= BASEURL; ?>/pengelola/laporan" class="active"><i class="fas fa-file-invoice"></i> Laporan</a></li>
                <li><a href="<?= BASEURL; ?>/auth/logout" class="nav-danger"><i class="fas fa-sign-out-alt"></i> Keluar</a></li>
            </ul>
        </aside>
        <main class="main-content">
            <header class="dashboard-header"><div class="dash-title"><h1>Laporan</h1><p>Ringkasan pendapatan, booking, dan lapangan populer.</p></div><button class="btn-primary"><i class="fas fa-download"></i> Export</button></header>
            <div class="metric-grid">
                <div class="metric-box"><span>Total Pendapatan</span><strong>Rp <?= number_format($data['pendapatan_total'], 0, ',', '.'); ?></strong></div>
                <div class="metric-box"><span>Total Booking</span><strong><?= $data['total_booking']; ?></strong></div>
                <div class="metric-box"><span>Lapangan Terpopuler</span><strong><?= htmlspecialchars($data['lapangan_populer']); ?></strong></div>
            </div>
            <section class="table-container">
                <table class="data-table">
                    <thead><tr><th>Bulan</th><th>Total Booking</th><th>Pendapatan</th><th>Rating Rata-rata</th></tr></thead>
                    <tbody>
                        <?php if (empty($data['monthly'])): ?>
                            <tr>
                                <td colspan="4" style="text-align: center; color: var(--text-muted); padding: 20px;">
                                    Belum ada data bulanan.
                                </td>
                            </tr>
                        <?php else: ?>
                            <?php foreach ($data['monthly'] as $row): ?>
                                <tr>
                                    <td><?= htmlspecialchars($row['bulan']); ?></td>
                                    <td><?= $row['booking_count']; ?>x sewa</td>
                                    <td>Rp <?= number_format($row['pendapatan'], 0, ',', '.'); ?></td>
                                    <td><i class="fas fa-star" style="color: var(--text-gold);"></i> <?= number_format($row['rating'], 1); ?></td>
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
