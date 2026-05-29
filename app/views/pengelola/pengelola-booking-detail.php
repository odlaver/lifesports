<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Booking Masuk - Lifesports</title>
    <link rel="stylesheet" href="<?= BASEURL; ?>/public/assets/css/styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>
    <div class="dashboard-container">
        <aside class="sidebar">
            <div class="sidebar-header"><div class="sidebar-brand">Lifesports</div><div class="role-label">PENGELOLA</div></div>
            <ul class="sidebar-menu">
                <li><a href="<?= BASEURL; ?>/pengelola"><i class="fas fa-home"></i> Dashboard</a></li>
                <li><a href="<?= BASEURL; ?>/pengelola/booking" class="active"><i class="fas fa-calendar-check"></i> Booking Masuk</a></li>
                <li><a href="<?= BASEURL; ?>/pengelola/pembayaran"><i class="fas fa-credit-card"></i> Pembayaran</a></li>
                <li><a href="<?= BASEURL; ?>/auth/logout" class="nav-danger"><i class="fas fa-sign-out-alt"></i> Keluar</a></li>
            </ul>
        </aside>
        <main class="main-content">
            <?php 
            $row = $data['booking'];
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
            <header class="dashboard-header">
                <div class="dash-title">
                    <h1>Detail Booking Masuk</h1>
                    <p><?= htmlspecialchars($row['kode_booking']); ?> dari <?= htmlspecialchars($row['nama_pelanggan']); ?>.</p>
                </div>
                <a href="<?= BASEURL; ?>/pengelola/booking" class="btn-secondary"><i class="fas fa-arrow-left"></i> Kembali</a>
            </header>
            
            <?php Flasher::flash(); ?>

            <div class="detail-layout">
                <section class="detail-panel">
                    <h2 class="table-title"><i class="fas fa-user"></i>Data Pelanggan & Pemesanan</h2>
                    <div class="info-list">
                        <div class="info-row"><span>Nama Pelanggan</span><strong><?= htmlspecialchars($row['nama_pelanggan']); ?></strong></div>
                        <div class="info-row"><span>Email</span><strong><?= htmlspecialchars($row['email_pelanggan']); ?></strong></div>
                        <div class="info-row"><span>Lapangan</span><strong><?= htmlspecialchars($row['nama_lapangan']); ?> (<?= htmlspecialchars($row['nama_kategori']); ?>)</strong></div>
                        <div class="info-row"><span>Jadwal Main</span><strong><?= date('d M Y', strtotime($row['tanggal_main'])); ?>, <?= date('H:i', strtotime($row['jam_mulai'])); ?> - <?= date('H:i', strtotime($row['jam_selesai'])); ?></strong></div>
                        <div class="info-row"><span>Total Harga</span><strong>Rp <?= number_format($row['total_harga'], 0, ',', '.'); ?></strong></div>
                        <div class="info-row"><span>Status Reservasi</span><strong><span class="status-badge <?= $status_class; ?>"><?= $status_label; ?></span></strong></div>
                    </div>

                    <?php if (!empty($row['bukti_transfer'])): ?>
                        <div style="margin-top: 30px;">
                            <h3 class="table-title"><i class="fas fa-credit-card"></i> Bukti Pembayaran</h3>
                            <div class="info-row"><span>Metode</span><strong><?= htmlspecialchars($row['metode_pembayaran']); ?></strong></div>
                            <div class="info-row"><span>Status Transfer</span><strong><span class="status-badge <?= $row['status_pembayaran'] === 'valid' ? 'status-success' : ($row['status_pembayaran'] === 'tidak_valid' ? 'status-danger' : 'status-info'); ?>"><?= htmlspecialchars(ucfirst($row['status_pembayaran'])); ?></span></strong></div>
                            <div style="margin-top: 15px;">
                                <a href="<?= BASEURL; ?>/public/assets/uploads/pembayaran/<?= $row['bukti_transfer']; ?>" target="_blank">
                                    <img src="<?= BASEURL; ?>/public/assets/uploads/pembayaran/<?= $row['bukti_transfer']; ?>" alt="Bukti Transfer" style="max-width: 100%; max-height: 350px; border-radius: 8px; border: 1px solid rgba(255,255,255,0.1); display: block;">
                                </a>
                                <small style="display: block; color: var(--text-muted); margin-top: 5px;">Klik gambar untuk memperbesar</small>
                            </div>
                        </div>
                    <?php endif; ?>
                </section>
                
                <aside class="summary-panel">
                    <h2 class="table-title">Aksi Pengelola</h2>
                    
                    <?php if ($row['status'] === 'pending' || $row['status'] === 'dibayar'): ?>
                        <a href="<?= BASEURL; ?>/pengelola/konfirmasi_booking/<?= $row['id']; ?>/konfirmasi" class="btn-primary btn-auth" style="text-align: center; display: block; margin-bottom: 10px; text-decoration: none;"><i class="fas fa-check"></i> Setujui & Konfirmasi</a>
                        <a href="<?= BASEURL; ?>/pengelola/konfirmasi_booking/<?= $row['id']; ?>/batal" class="btn-secondary btn-auth" style="text-align: center; display: block; text-decoration: none; background: var(--status-danger);"><i class="fas fa-ban"></i> Batalkan Booking</a>
                    <?php elseif ($row['status'] === 'dikonfirmasi'): ?>
                        <a href="<?= BASEURL; ?>/pengelola/konfirmasi_booking/<?= $row['id']; ?>/selesai" class="btn-primary btn-auth" style="text-align: center; display: block; margin-bottom: 10px; text-decoration: none; background: var(--status-success);"><i class="fas fa-check-double"></i> Tandai Selesai</a>
                        <a href="<?= BASEURL; ?>/pengelola/konfirmasi_booking/<?= $row['id']; ?>/batal" class="btn-secondary btn-auth" style="text-align: center; display: block; text-decoration: none; background: var(--status-danger);"><i class="fas fa-ban"></i> Batalkan Booking</a>
                    <?php else: ?>
                        <div style="text-align: center; color: var(--text-muted); padding: 10px;">
                            Transaksi ini sudah selesai/dibatalkan. Tidak ada aksi lanjutan yang diperlukan.
                        </div>
                    <?php endif; ?>
                </aside>
            </div>
        </main>
    </div>
</body>
</html>
