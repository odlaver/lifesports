<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Kategori - Admin Lifesports</title>
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
                <li><a href="<?= BASEURL; ?>/admin/kategori" class="active"><i class="fas fa-tags"></i> Kategori</a></li>
                <li><a href="<?= BASEURL; ?>/admin/lapangan"><i class="fas fa-building"></i> Semua Lapangan</a></li>
                <li><a href="<?= BASEURL; ?>/admin/booking"><i class="fas fa-calendar-check"></i> Semua Booking</a></li>
                <li><a href="<?= BASEURL; ?>/admin/pembayaran"><i class="fas fa-credit-card"></i> Semua Pembayaran</a></li>
                <li><a href="<?= BASEURL; ?>/admin/laporan"><i class="fas fa-file-invoice"></i> Laporan</a></li>
                <li><a href="<?= BASEURL; ?>/auth/logout" class="nav-danger"><i class="fas fa-sign-out-alt"></i> Keluar</a></li>
            </ul>
        </aside>

        <main class="main-content">
            <header class="dashboard-header">
                <div class="dash-title">
                    <h1>Kelola Kategori</h1>
                    <p>Atur kategori olahraga yang tersedia di platform</p>
                </div>
            </header>

            <div class="section-grid two-col">

                <section class="table-container">
                    <div class="table-header">
                        <h2 class="table-title"><i class="fas fa-plus-circle"></i> Tambah Kategori</h2>
                    </div>
                    <form class="form-panel" id="form-kategori" action="#" method="post">
                        <div class="form-group">
                            <label for="input-nama-kategori">Nama Kategori</label>
                            <input class="form-control" id="input-nama-kategori" name="nama" type="text" placeholder="Contoh: Futsal, Badminton..." required>
                        </div>
                        <div class="form-group">
                            <label for="input-icon-kategori">Icon (Font Awesome class)</label>
                            <input class="form-control" id="input-icon-kategori" name="icon" type="text" placeholder="Contoh: fa-futbol">
                        </div>
                        <div class="form-group">
                            <label for="input-deskripsi-kategori">Deskripsi Singkat</label>
                            <textarea class="form-control" id="input-deskripsi-kategori" name="deskripsi" rows="3" placeholder="Deskripsi singkat kategori olahraga..."></textarea>
                        </div>
                        <div class="form-actions">
                            <button class="btn-primary" id="btn-simpan-kategori" type="submit">
                                <i class="fas fa-save"></i> Simpan
                            </button>
                            <button class="btn-primary ghost-light" id="btn-reset-kategori" type="reset">
                                <i class="fas fa-undo"></i> Reset
                            </button>
                        </div>
                    </form>
                </section>

                <section class="table-container">
                    <div class="table-header">
                        <h2 class="table-title"><i class="fas fa-list"></i> Daftar Kategori</h2>
                    </div>
                    <table class="data-table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Nama</th>
                                <th>Total Lapangan</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (empty($data['kategori'])): ?>
                                <tr>
                                    <td colspan="4" style="text-align: center; color: var(--text-muted); padding: 20px;">
                                        Belum ada kategori terdaftar.
                                    </td>
                                </tr>
                            <?php else: ?>
                                <?php $i = 1; foreach ($data['kategori'] as $cat): ?>
                                    <tr>
                                        <td><?= $i++; ?></td>
                                        <td><strong><i class="<?= htmlspecialchars($cat['icon']); ?>"></i> <?= htmlspecialchars($cat['nama_kategori']); ?></strong></td>
                                        <td><?= $cat['total_lapangan']; ?></td>
                                        <td>
                                            <button class="btn-action" title="Edit" onclick="alert('Fitur edit kategori dinonaktifkan demi keamanan demo platform.')"><i class="fas fa-pen"></i></button>
                                            <button class="btn-action danger" title="Hapus" onclick="alert('Fitur hapus kategori dinonaktifkan demi keamanan demo platform.')"><i class="fas fa-trash"></i></button>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </section>
            </div>
        </main>
    </div>
</body>
</html>
