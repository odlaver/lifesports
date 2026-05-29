<?php
$total_lapangan = count($data['lapangan']);
$total_aktif = 0;
$total_nonaktif = 0;
$kategori_set = [];
foreach ($data['lapangan'] as $l) {
    if ($l['status'] === 'aktif') $total_aktif++;
    elseif ($l['status'] === 'nonaktif') $total_nonaktif++;
    $kategori_set[$l['nama_kategori']] = true;
}
$total_kategori = count($kategori_set);
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Semua Lapangan - Admin Lifesports</title>
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
                <li><a href="<?= BASEURL; ?>/admin/lapangan" class="active"><i class="fas fa-building"></i> Semua Lapangan</a></li>
                <li><a href="<?= BASEURL; ?>/admin/booking"><i class="fas fa-calendar-check"></i> Semua Booking</a></li>
                <li><a href="<?= BASEURL; ?>/admin/pembayaran"><i class="fas fa-credit-card"></i> Semua Pembayaran</a></li>
                <li><a href="<?= BASEURL; ?>/admin/laporan"><i class="fas fa-file-invoice"></i> Laporan</a></li>
                <li><a href="<?= BASEURL; ?>/auth/logout" class="nav-danger"><i class="fas fa-sign-out-alt"></i> Keluar</a></li>
            </ul>
        </aside>

        <main class="main-content">
            <header class="dashboard-header">
                <div class="dash-title">
                    <h1>Monitoring Lapangan</h1>
                    <p>Semua lapangan dari seluruh pengelola terdaftar</p>
                </div>
            </header>

            <div class="dash-stats">
                <div class="dash-card">
                    <div class="dash-card-icon"><i class="fas fa-building"></i></div>
                    <div class="dash-card-info">
                        <h3>Total Lapangan</h3>
                        <div class="value"><?= $total_lapangan; ?></div>
                    </div>
                </div>
                <div class="dash-card">
                    <div class="dash-card-icon"><i class="fas fa-check-circle"></i></div>
                    <div class="dash-card-info">
                        <h3>Aktif (Tersedia)</h3>
                        <div class="value"><?= $total_aktif; ?></div>
                    </div>
                </div>
                <div class="dash-card">
                    <div class="dash-card-icon warning"><i class="fas fa-tags"></i></div>
                    <div class="dash-card-info">
                        <h3>Kategori Jenis</h3>
                        <div class="value value-warning"><?= $total_kategori; ?></div>
                    </div>
                </div>
                <div class="dash-card">
                    <div class="dash-card-icon"><i class="fas fa-power-off"></i></div>
                    <div class="dash-card-info">
                        <h3>Nonaktif</h3>
                        <div class="value"><?= $total_nonaktif; ?></div>
                    </div>
                </div>
            </div>

            <section class="table-container">
                <div class="table-header">
                    <h2 class="table-title"><i class="fas fa-list"></i> Daftar Lapangan</h2>
                </div>
                <div class="filter-bar compact">
                    <input class="form-control" id="input-search-lapangan" placeholder="Cari nama lapangan atau pengelola...">
                    <select class="form-control" id="select-kategori-lapangan">
                        <option>Semua Kategori</option>
                        <option>Futsal</option>
                        <option>Badminton</option>
                        <option>Tennis</option>
                        <option>Basket</option>
                    </select>
                    <select class="form-control" id="select-status-lapangan">
                        <option>Semua Status</option>
                        <option>Aktif</option>
                        <option>Nonaktif</option>
                    </select>
                    <button class="btn-primary compact-button" id="btn-filter-lapangan"><i class="fas fa-filter"></i> Filter</button>
                </div>
                <table class="data-table">
                    <thead>
                        <tr>
                            <th>Lapangan</th>
                            <th>Pengelola</th>
                            <th>Kategori</th>
                            <th>Harga/Jam</th>
                            <th>Rating</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (empty($data['lapangan'])): ?>
                            <tr>
                                <td colspan="7" style="text-align: center; color: var(--text-muted); padding: 20px;">
                                    Belum ada lapangan terdaftar.
                                </td>
                            </tr>
                        <?php else: ?>
                            <?php foreach ($data['lapangan'] as $row): 
                                $status_class = $row['status'] === 'aktif' ? 'status-success' : 'status-danger';
                                $status_label = $row['status'] === 'aktif' ? 'Aktif' : 'Nonaktif';
                            ?>
                                <tr>
                                    <td><strong><?= htmlspecialchars($row['nama_lapangan']); ?></strong></td>
                                    <td><?= htmlspecialchars($row['nama_pengelola']); ?></td>
                                    <td><span class="sport-chip info"><?= htmlspecialchars($row['nama_kategori']); ?></span></td>
                                    <td>Rp <?= number_format($row['harga_per_jam'], 0, ',', '.'); ?></td>
                                    <td><i class="fas fa-star icon-gold"></i> <?= number_format($row['rating'], 1); ?></td>
                                    <td><span class="status-badge <?= $status_class; ?>"><?= $status_label; ?></span></td>
                                    <td>
                                        <button class="btn-action" title="Detail" onclick="alert('Fasilitas: <?= htmlspecialchars($row['fasilitas']); ?>\n\nDeskripsi: <?= htmlspecialchars($row['deskripsi']); ?>')"><i class="fas fa-eye"></i></button>
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
