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
                <li><a href="<?= BASEURL; ?>/pengelola/profile"><i class="fas fa-user-cog"></i> Profil & Pembayaran</a></li>
                <li><a href="<?= BASEURL; ?>/auth/logout" class="nav-danger"><i class="fas fa-sign-out-alt"></i> Keluar</a></li>
            </ul>
        </aside>
        <main class="main-content">
            <header class="dashboard-header">
                <div class="dash-title"><h1>Lapangan Saya</h1><p>Kelola status, harga, dan performa lapangan.</p></div>
                <a href="<?= BASEURL; ?>/pengelola/lapangan_form" class="btn-primary"><i class="fas fa-plus"></i> Tambah Lapangan</a>
            </header>
            <section class="table-container">
                <form method="GET" action="<?= BASEURL; ?>/pengelola/lapangan" id="filterForm">
                    <div class="filter-bar compact">
                        <input class="form-control" name="search" type="text" placeholder="Cari nama lapangan..." value="<?= isset($data['filter']['search']) ? htmlspecialchars($data['filter']['search']) : ''; ?>" onkeypress="if(event.keyCode == 13) this.form.submit()">
                        <select class="form-control" name="status" onchange="this.form.submit()">
                            <option <?= (isset($data['filter']['status']) && $data['filter']['status'] == 'Semua Status') || empty($data['filter']['status']) ? 'selected' : ''; ?>>Semua Status</option>
                            <option <?= (isset($data['filter']['status']) && $data['filter']['status'] == 'Tersedia') ? 'selected' : ''; ?>>Tersedia</option>
                            <option <?= (isset($data['filter']['status']) && $data['filter']['status'] == 'Maintenance') ? 'selected' : ''; ?>>Maintenance</option>
                            <option <?= (isset($data['filter']['status']) && $data['filter']['status'] == 'Nonaktif') ? 'selected' : ''; ?>>Nonaktif</option>
                        </select>
                        <select class="form-control" name="sport" onchange="this.form.submit()">
                            <option <?= (isset($data['filter']['sport']) && $data['filter']['sport'] == 'Semua Kategori') || empty($data['filter']['sport']) ? 'selected' : ''; ?>>Semua Kategori</option>
                            <?php if (isset($data['kategori'])): ?>
                                <?php foreach ($data['kategori'] as $k): ?>
                                    <option <?= (isset($data['filter']['sport']) && $data['filter']['sport'] == $k['nama_kategori']) ? 'selected' : ''; ?>><?= htmlspecialchars($k['nama_kategori']); ?></option>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <option <?= (isset($data['filter']['sport']) && $data['filter']['sport'] == 'Futsal') ? 'selected' : ''; ?>>Futsal</option>
                                <option <?= (isset($data['filter']['sport']) && $data['filter']['sport'] == 'Tennis') ? 'selected' : ''; ?>>Tennis</option>
                                <option <?= (isset($data['filter']['sport']) && $data['filter']['sport'] == 'Badminton') ? 'selected' : ''; ?>>Badminton</option>
                            <?php endif; ?>
                        </select>
                        <button type="submit" class="btn-primary compact-button"><i class="fas fa-filter"></i> Filter</button>
                    </div>
                </form>
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
                                    <td>
                                        <a href="<?= BASEURL; ?>/pengelola/lapangan_form/<?= $row['id']; ?>" class="btn-action" title="Edit"><i class="fas fa-pen"></i></a>
                                        <a href="<?= BASEURL; ?>/pengelola/hapus_lapangan/<?= $row['id']; ?>" class="btn-action" style="color: var(--status-danger); margin-left: 10px;" title="Hapus" onclick="return confirm('Apakah Anda yakin ingin menghapus lapangan ini?');"><i class="fas fa-trash"></i></a>
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
