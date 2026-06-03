<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Pengelola - Lifesports</title>
    <link rel="stylesheet" href="<?= BASEURL; ?>/public/assets/css/styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>

    <div class="dashboard-container">

        <aside class="sidebar">
            <div class="sidebar-header">
                <div class="sidebar-brand">Lifesports</div>
                <div class="role-label">PENGELOLA</div>
            </div>

            <ul class="sidebar-menu">
                <li><a href="<?= BASEURL; ?>/pengelola" class="active"><i class="fas fa-home"></i> Dashboard</a></li>
                <li><a href="<?= BASEURL; ?>/pengelola/lapangan"><i class="fas fa-building"></i> Lapangan Saya</a></li>
                <li><a href="<?= BASEURL; ?>/pengelola/booking"><i class="fas fa-calendar-check"></i> Booking Masuk</a></li>
                <li><a href="<?= BASEURL; ?>/pengelola/pembayaran"><i class="fas fa-credit-card"></i> Pembayaran</a></li>
                <li><a href="<?= BASEURL; ?>/pengelola/laporan"><i class="fas fa-file-invoice"></i> Laporan</a></li>
                <li><a href="<?= BASEURL; ?>/pengelola/profile"><i class="fas fa-user-cog"></i> Profil & Pembayaran</a></li>
                <li><a href="<?= BASEURL; ?>/auth/logout" class="nav-danger"><i class="fas fa-sign-out-alt"></i> Keluar</a></li>
            </ul>
        </aside>

        <main class="main-content">

            <header class="dashboard-header">
                <div class="dash-title">
                    <h1>Sistem Pengelola</h1>
                    <p>Sistem Manajemen Akses - <strong><?= htmlspecialchars($_SESSION['nama']); ?></strong></p>
                </div>

                <div class="dash-profile">
                    <div class="profile-info">
                        <div class="profile-name"><?= htmlspecialchars($_SESSION['nama']); ?></div>
                        <div class="profile-role">Mitra Pengelola</div>
                    </div>
                    <div class="profile-img">
                        <i class="fas fa-user-tie"></i>
                    </div>
                </div>
            </header>


            <?php if ($data['booking_pending_count'] > 0): ?>
            <div class="alert warning">
                <div>
                    <i class="fas fa-exclamation-triangle"></i>
                    <strong>Peringatan Sistem:</strong> Terdapat <?= $data['booking_pending_count']; ?> reservasi yang memerlukan verifikasi.
                </div>
                <a href="#booking-pending">Tinjau Reservasi</a>
            </div>
            <?php endif; ?>

            <div class="dash-stats">
                <div class="dash-card">
                    <div class="dash-card-icon"><i class="fas fa-building"></i></div>
                    <div class="dash-card-info">
                        <h3>Total Lapangan</h3>
                        <div class="value"><?= $data['total_lapangan']; ?></div>
                        <small>Tersedia: <?= $data['total_lapangan_aktif']; ?></small>
                    </div>
                </div>
                <div class="dash-card">
                    <div class="dash-card-icon warning"><i class="fas fa-clock"></i></div>
                    <div class="dash-card-info">
                        <h3>Booking Pending</h3>
                        <div class="value value-warning"><?= $data['booking_pending_count']; ?></div>
                        <small>Perlu konfirmasi</small>
                    </div>
                </div>
                <div class="dash-card">
                    <div class="dash-card-icon"><i class="fas fa-calendar-check"></i></div>
                    <div class="dash-card-info">
                        <h3>Total Booking</h3>
                        <div class="value"><?= $data['total_booking']; ?></div>
                        <small>Selesai: <?= $data['total_booking_selesai']; ?></small>
                    </div>
                </div>
                <div class="dash-card">
                    <div class="dash-card-icon"><i class="fas fa-wallet"></i></div>
                    <div class="dash-card-info">
                        <h3>Pendapatan Bulan Ini</h3>
                        <div class="value value-compact">Rp <?= number_format($data['pendapatan_total'], 0, ',', '.'); ?></div>
                    </div>
                </div>
            </div>

            <div class="section-grid two-col" id="booking-pending">

                <div class="table-container">
                    <div class="table-header">
                        <h2 class="table-title"><i class="fas fa-clock icon-warning"></i>Booking Pending</h2>
                        <a href="<?= BASEURL; ?>/pengelola/booking" class="btn-primary compact-button">Lihat Semua</a>
                    </div>

                    <div class="stack">
                        <?php if (empty($data['booking_pending'])): ?>
                            <div style="text-align: center; padding: 25px; color: var(--text-muted); font-size: 0.9rem;">
                                Tidak ada booking pending saat ini.
                            </div>
                        <?php else: ?>
                            <?php foreach ($data['booking_pending'] as $row): ?>
                                <div class="list-row">
                                    <div>
                                        <h4><?= htmlspecialchars($row['kode_booking']); ?></h4>
                                        <p><?= htmlspecialchars($row['nama_lapangan']); ?> (<?= htmlspecialchars($row['nama_kategori']); ?>)</p>
                                        <small><?= htmlspecialchars($row['nama_pelanggan']); ?> - <?= date('d M Y', strtotime($row['tanggal_main'])); ?> - <?= date('H:i', strtotime($row['jam_mulai'])); ?>-<?= date('H:i', strtotime($row['jam_selesai'])); ?></small>
                                    </div>
                                    <a href="<?= BASEURL; ?>/pengelola/booking_detail/<?= $row['id']; ?>" class="btn-primary compact-button ghost-warning"><i class="fas fa-check-circle"></i> Tinjau</a>
                                </div>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </div>
                </div>

                <div class="table-container">
                    <div class="table-header">
                        <h2 class="table-title"><i class="fas fa-calendar-day icon-info"></i>Booking Hari Ini</h2>
                    </div>

                    <div class="stack">
                        <?php if (empty($data['booking_hari_ini'])): ?>
                            <div style="text-align: center; padding: 25px; color: var(--text-muted); font-size: 0.9rem;">
                                Tidak ada booking hari ini.
                            </div>
                        <?php else: ?>
                            <?php foreach ($data['booking_hari_ini'] as $row): ?>
                                <div class="list-row">
                                    <div>
                                        <p><?= htmlspecialchars($row['nama_lapangan']); ?></p>
                                        <small><?= htmlspecialchars($row['nama_pelanggan']); ?> - <?= date('H:i', strtotime($row['jam_mulai'])); ?> - <?= date('H:i', strtotime($row['jam_selesai'])); ?></small>
                                    </div>
                                    <span class="status-badge status-success"><?= htmlspecialchars(ucfirst($row['status'])); ?></span>
                                </div>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </div>
                </div>

            </div>

            <div class="table-container" id="lapangan-populer">
                <div class="table-header">
                    <h2 class="table-title"><i class="fas fa-trophy"></i>Lapangan Paling Populer</h2>
                </div>

                <table class="data-table">
                    <thead>
                        <tr>
                            <th>Nama Lapangan</th>
                            <th>Kota</th>
                            <th>Harga/Jam</th>
                            <th>Rating</th>
                            <th>Total Booking</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (empty($data['lapangan_populer'])): ?>
                            <tr>
                                <td colspan="6" style="text-align: center; color: var(--text-muted); padding: 20px;">
                                    Belum ada data lapangan.
                                </td>
                            </tr>
                        <?php else: ?>
                            <?php foreach ($data['lapangan_populer'] as $row): ?>
                                <tr>
                                    <td><strong><?= htmlspecialchars($row['nama_lapangan']); ?></strong></td>
                                    <td>Bandar Lampung</td>
                                    <td>Rp <?= number_format($row['harga_per_jam'], 0, ',', '.'); ?></td>
                                    <td><i class="fas fa-star" style="color: var(--text-gold);"></i> 5.0</td>
                                    <td><?= $row['total_booking']; ?>x</td>
                                    <td><span class="status-badge status-success"><?= htmlspecialchars(ucfirst($row['status'])); ?></span></td>
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
