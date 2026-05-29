<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Booking - Lifesports</title>
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
            <?php Flasher::flash(); ?>

            <?php 
                $row = $data['booking'];
                $status_class = 'status-pending';
                $status_label = 'Pending';
                if ($row['status'] === 'dibayar') {
                    $status_class = 'status-info';
                    $status_label = 'Dibayar (Menunggu Verifikasi)';
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
                    <h1>Detail Booking</h1>
                    <p>Kode booking <strong><?= htmlspecialchars($row['kode_booking']); ?></strong></p>
                </div>
                <a href="<?= BASEURL; ?>/pelanggan/booking" class="btn-secondary"><i class="fas fa-arrow-left"></i> Kembali</a>
            </header>

            <div class="detail-layout" style="display: grid; grid-template-columns: 1.2fr 0.8fr; gap: 30px;">
                <section class="detail-panel" style="background: rgba(255,255,255,0.01); border: 1px solid rgba(255,255,255,0.05); border-radius: 12px; padding: 25px;">
                    <div class="table-header" style="display: flex; justify-content: space-between; align-items: center; border-bottom: 1px solid rgba(255,255,255,0.05); padding-bottom: 15px; margin-bottom: 20px;">
                        <h2 class="table-title" style="font-size: 1.2rem; margin: 0; color: #fff;"><i class="fas fa-building" style="color: var(--text-gold); margin-right: 8px;"></i> <?= htmlspecialchars($row['nama_lapangan']); ?></h2>
                        <span class="status-badge <?= $status_class; ?>"><?= $status_label; ?></span>
                    </div>
                    
                    <div class="info-list" style="display: flex; flex-direction: column; gap: 15px;">
                        <div class="info-row" style="display: flex; justify-content: space-between; font-size: 0.95rem; border-bottom: 1px dashed rgba(255,255,255,0.05); padding-bottom: 10px;">
                            <span style="color: var(--text-muted);">Cabang Olahraga</span>
                            <strong style="color: #fff;"><?= htmlspecialchars($row['nama_kategori']); ?></strong>
                        </div>
                        <div class="info-row" style="display: flex; justify-content: space-between; font-size: 0.95rem; border-bottom: 1px dashed rgba(255,255,255,0.05); padding-bottom: 10px;">
                            <span style="color: var(--text-muted);">Tanggal Main</span>
                            <strong style="color: #fff;"><?= date('d M Y', strtotime($row['tanggal_main'])); ?></strong>
                        </div>
                        <div class="info-row" style="display: flex; justify-content: space-between; font-size: 0.95rem; border-bottom: 1px dashed rgba(255,255,255,0.05); padding-bottom: 10px;">
                            <span style="color: var(--text-muted);">Waktu / Jam</span>
                            <strong style="color: #fff;"><?= date('H:i', strtotime($row['jam_mulai'])) . ' - ' . date('H:i', strtotime($row['jam_selesai'])); ?></strong>
                        </div>
                        <div class="info-row" style="display: flex; justify-content: space-between; font-size: 0.95rem; border-bottom: 1px dashed rgba(255,255,255,0.05); padding-bottom: 10px;">
                            <span style="color: var(--text-muted);">Lokasi</span>
                            <strong style="color: #fff;">Bandar Lampung</strong>
                        </div>
                        <div class="info-row" style="display: flex; justify-content: space-between; font-size: 0.95rem;">
                            <span style="color: var(--text-muted);">Waktu Reservasi</span>
                            <strong style="color: #fff;"><?= date('d M Y, H:i', strtotime($row['created_at'])); ?></strong>
                        </div>
                    </div>
                </section>

                <aside class="summary-panel" style="background: rgba(255,255,255,0.01); border: 1px solid rgba(255,255,255,0.05); border-radius: 12px; padding: 25px; height: fit-content; display: flex; flex-direction: column; gap: 20px;">
                    <h2 class="table-title" style="font-size: 1.2rem; color: #fff; border-bottom: 1px solid rgba(255,255,255,0.05); padding-bottom: 10px; margin: 0;">Rincian Harga</h2>
                    
                    <div class="info-list" style="display: flex; flex-direction: column; gap: 12px;">
                        <div class="info-row" style="display: flex; justify-content: space-between; font-size: 0.9rem;">
                            <span style="color: var(--text-muted);">Biaya Sewa Lapangan</span>
                            <strong style="color: #fff;">Rp <?= number_format($row['total_harga'], 0, ',', '.'); ?></strong>
                        </div>
                        <div class="info-row" style="display: flex; justify-content: space-between; font-size: 0.9rem;">
                            <span style="color: var(--text-muted);">Biaya Administrasi</span>
                            <strong style="color: #fff;">Rp 0</strong>
                        </div>
                        <div class="checkout-total" style="display: flex; justify-content: space-between; border-top: 1px solid rgba(255,255,255,0.05); padding-top: 12px; font-size: 1.05rem; font-weight: 700; color: var(--text-gold);">
                            <span>Total Pembayaran</span>
                            <strong>Rp <?= number_format($row['total_harga'], 0, ',', '.'); ?></strong>
                        </div>
                    </div>

                    <?php if ($row['status'] === 'pending'): ?>
                        <a href="<?= BASEURL; ?>/pelanggan/pembayaran/<?= $row['id']; ?>" class="btn-primary btn-auth" style="text-align: center; text-decoration: none; padding: 12px 0;"><i class="fas fa-wallet" style="margin-right: 5px;"></i> Bayar Sekarang</a>
                    <?php elseif ($row['status'] === 'selesai'): ?>
                        <a href="<?= BASEURL; ?>/pelanggan/review/<?= $row['id']; ?>" class="btn-secondary btn-auth" style="text-align: center; text-decoration: none; padding: 12px 0; background: rgba(204,164,80,0.1); border: 1px solid rgba(204,164,80,0.3); color: var(--text-gold);"><i class="fas fa-star" style="margin-right: 5px;"></i> Beri Review</a>
                    <?php elseif ($row['status'] === 'dibayar' && !empty($row['bukti_transfer'])): ?>
                        <div style="background: rgba(52, 152, 219, 0.05); border: 1px solid rgba(52, 152, 219, 0.2); border-radius: 8px; padding: 12px; font-size: 0.8rem; color: var(--status-info); text-align: center;">
                            <i class="fas fa-spinner fa-spin"></i> Bukti transfer terunggah. Menunggu verifikasi pengelola.
                        </div>
                    <?php endif; ?>
                </aside>
            </div>
        </main>
    </div>
</body>
</html>

