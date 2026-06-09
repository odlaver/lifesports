<?php
$row = $data['booking'];
$pembayaran = $data['pembayaran'] ?? null;
$statusClass = 'status-pending';
$statusLabel = 'Pending';
if ($row['status'] === 'dibayar') {
    $statusClass = 'status-info';
    $statusLabel = 'Dibayar';
} elseif ($row['status'] === 'dikonfirmasi') {
    $statusClass = 'status-warning';
    $statusLabel = 'Dikonfirmasi';
} elseif ($row['status'] === 'selesai') {
    $statusClass = 'status-success';
    $statusLabel = 'Selesai';
} elseif ($row['status'] === 'dibatalkan') {
    $statusClass = 'status-danger';
    $statusLabel = 'Dibatalkan';
}
$paymentClass = 'status-warning';
$paymentLabel = 'Belum Ada';
if (!empty($pembayaran)) {
    $paymentLabel = ucfirst(str_replace('_', ' ', $pembayaran['status_pembayaran']));
    if ($pembayaran['status_pembayaran'] === 'valid') {
        $paymentClass = 'status-success';
    } elseif ($pembayaran['status_pembayaran'] === 'tidak_valid') {
        $paymentClass = 'status-danger';
    }
}
?>

<div class="detail-layout">
    <section class="table-container">
        <div class="table-header">
            <h2 class="table-title"><i class="fas fa-calendar-check"></i> <?= htmlspecialchars($row['kode_booking']); ?></h2>
            <span class="status-badge <?= $statusClass; ?>"><?= $statusLabel; ?></span>
        </div>
        <div class="info-row">
            <span><i class="fas fa-building"></i> Lapangan</span>
            <strong><?= htmlspecialchars($row['nama_lapangan']); ?></strong>
        </div>
        <div class="info-row">
            <span><i class="fas fa-user"></i> Pelanggan</span>
            <strong><?= htmlspecialchars($row['nama_pelanggan']); ?></strong>
        </div>
        <div class="info-row">
            <span><i class="fas fa-user-tie"></i> Pengelola</span>
            <strong><?= htmlspecialchars($row['nama_pengelola']); ?></strong>
        </div>
        <div class="info-row">
            <span><i class="fas fa-calendar-alt"></i> Tanggal Main</span>
            <strong><?= date('d M Y', strtotime($row['tanggal_main'])); ?></strong>
        </div>
        <div class="info-row">
            <span><i class="fas fa-clock"></i> Jam</span>
            <strong><?= date('H:i', strtotime($row['jam_mulai'])); ?> - <?= date('H:i', strtotime($row['jam_selesai'])); ?></strong>
        </div>
        <div class="info-row">
            <span><i class="fas fa-tags"></i> Kategori</span>
            <strong><?= htmlspecialchars($row['nama_kategori']); ?></strong>
        </div>
        <div class="info-row">
            <span><i class="fas fa-money-bill-wave"></i> Total Biaya</span>
            <strong>Rp <?= number_format($row['total_harga'], 0, ',', '.'); ?></strong>
        </div>
        <div class="info-row">
            <span><i class="fas fa-credit-card"></i> Status Bayar</span>
            <strong><span class="status-badge <?= $paymentClass; ?>"><?= htmlspecialchars($paymentLabel); ?></span></strong>
        </div>
        <div class="info-row">
            <span><i class="fas fa-calendar-plus"></i> Dibuat</span>
            <strong><?= date('d M Y, H:i', strtotime($row['created_at'])); ?></strong>
        </div>
    </section>

    <div>
        <section class="summary-panel">
            <div class="table-header">
                <h2 class="table-title"><i class="fas fa-receipt"></i> Pembayaran</h2>
            </div>
            <?php if (empty($pembayaran)): ?>
                <div class="text-muted-color p-10">Belum ada pembayaran untuk booking ini.</div>
            <?php else: ?>
                <div class="info-row">
                    <span>Metode</span>
                    <strong><?= htmlspecialchars($pembayaran['metode_pembayaran']); ?></strong>
                </div>
                <div class="info-row">
                    <span>Waktu Bayar</span>
                    <strong><?= $pembayaran['waktu_pembayaran'] ? date('d M Y, H:i', strtotime($pembayaran['waktu_pembayaran'])) : '-'; ?></strong>
                </div>
                <div class="info-row">
                    <span>Status</span>
                    <strong><span class="status-badge <?= $paymentClass; ?>"><?= htmlspecialchars($paymentLabel); ?></span></strong>
                </div>
                <?php if (!empty($pembayaran['bukti_transfer'])): ?>
                    <div class="mt-15">
                        <a href="<?= BASEURL; ?>/assets/uploads/pembayaran/<?= htmlspecialchars($pembayaran['bukti_transfer']); ?>" target="_blank" class="btn-secondary">
                            <i class="fas fa-file-invoice"></i> Lihat Bukti Transfer
                        </a>
                    </div>
                <?php endif; ?>
            <?php endif; ?>
        </section>

        <section class="summary-panel">
            <div class="table-header">
                <h2 class="table-title"><i class="fas fa-arrow-left"></i> Navigasi</h2>
            </div>
            <a href="<?= BASEURL; ?>/admin/booking" class="btn-primary ghost-light text-center text-decoration-none d-block">
                Kembali ke Semua Booking
            </a>
        </section>
    </div>
</div>
