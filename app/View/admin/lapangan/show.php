<?php
$row = $data['lapangan'];
$statusClass = $row['status'] === 'aktif' ? 'status-success' : 'status-danger';
$statusLabel = $row['status'] === 'aktif' ? 'Aktif' : 'Nonaktif';
?>

<div class="detail-layout">
    <section class="table-container">
        <div class="table-header">
            <h2 class="table-title"><i class="fas fa-building"></i> <?= htmlspecialchars($row['nama_lapangan']); ?></h2>
            <span class="status-badge <?= $statusClass; ?>"><?= $statusLabel; ?></span>
        </div>
        <div class="info-row">
            <span><i class="fas fa-tags"></i> Kategori</span>
            <strong><?= htmlspecialchars($row['nama_kategori']); ?></strong>
        </div>
        <div class="info-row">
            <span><i class="fas fa-money-bill-wave"></i> Harga/Jam</span>
            <strong>Rp <?= number_format($row['harga_per_jam'], 0, ',', '.'); ?></strong>
        </div>
        <div class="info-row">
            <span><i class="fas fa-user-tie"></i> Pengelola</span>
            <strong><?= htmlspecialchars($row['nama_pengelola']); ?></strong>
        </div>
        <div class="info-row">
            <span><i class="fas fa-envelope"></i> Email Pengelola</span>
            <strong><?= htmlspecialchars($row['email_pengelola']); ?></strong>
        </div>
        <div class="info-row">
            <span><i class="fas fa-phone"></i> Kontak</span>
            <strong><?= htmlspecialchars($row['telp_pengelola'] ?? '-'); ?></strong>
        </div>
        <div class="info-row">
            <span><i class="fas fa-calendar-plus"></i> Ditambahkan</span>
            <strong><?= date('d M Y', strtotime($row['created_at'])); ?></strong>
        </div>
        <div class="info-row">
            <span><i class="fas fa-list"></i> Fasilitas</span>
            <strong><?= htmlspecialchars($row['fasilitas'] ?? '-'); ?></strong>
        </div>
        <div class="info-row">
            <span><i class="fas fa-align-left"></i> Deskripsi</span>
            <strong><?= htmlspecialchars($row['deskripsi'] ?? '-'); ?></strong>
        </div>
    </section>

    <div>
        <section class="summary-panel">
            <div class="table-header">
                <h2 class="table-title"><i class="fas fa-chart-bar"></i> Performa</h2>
            </div>
            <div class="metric-grid">
                <div class="metric-item">
                    <div class="metric-value"><?= number_format($row['total_booking']); ?>x</div>
                    <div class="metric-label">Total Booking</div>
                </div>
                <div class="metric-item">
                    <div class="metric-value">Rp <?= number_format($row['pendapatan'], 0, ',', '.'); ?></div>
                    <div class="metric-label">Pendapatan</div>
                </div>
                <div class="metric-item">
                    <div class="metric-value rating-row"><i class="fas fa-star"></i> <?= number_format($row['rating'], 1); ?></div>
                    <div class="metric-label">Rating</div>
                </div>
                <div class="metric-item">
                    <div class="metric-value"><?= number_format($row['total_review']); ?></div>
                    <div class="metric-label">Review</div>
                </div>
            </div>
        </section>

        <section class="summary-panel">
            <div class="table-header">
                <h2 class="table-title"><i class="fas fa-cog"></i> Aksi Admin</h2>
            </div>
            <div class="stack">
                <form action="<?= BASEURL; ?>/admin/lapangan/status/<?= $row['id']; ?>" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin mengubah status ketersediaan lapangan ini?');">
                    <button type="submit" class="btn-primary ghost-warning w-100 border-none cursor-pointer">
                        <i class="fas fa-power-off"></i> Ubah Status Lapangan
                    </button>
                </form>
                <a href="<?= BASEURL; ?>/admin/lapangan" class="btn-primary ghost-light text-center text-decoration-none d-block">
                    Kembali ke Kelola Lapangan
                </a>
            </div>
        </section>
    </div>
</div>
