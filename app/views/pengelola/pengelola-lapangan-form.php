<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Lapangan - Lifesports</title>
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
                <li><a href="<?= BASEURL; ?>/pengelola/laporan"><i class="fas fa-file-invoice"></i> Laporan</a></li>
                <li><a href="<?= BASEURL; ?>/auth/logout" class="nav-danger"><i class="fas fa-sign-out-alt"></i> Keluar</a></li>
            </ul>
        </aside>
        <main class="main-content">
            <header class="dashboard-header">
                <div class="dash-title"><h1>Tambah/Edit Lapangan</h1><p>Lengkapi data fasilitas agar mudah ditemukan pelanggan.</p></div>
                <a href="<?= BASEURL; ?>/pengelola/lapangan" class="btn-secondary"><i class="fas fa-arrow-left"></i> Kembali</a>
            </header>
            <section class="form-panel">
                <form action="<?= BASEURL; ?>/pengelola/proses_lapangan" method="POST" enctype="multipart/form-data">
                    <?php if (!empty($data['lapangan'])): ?>
                        <input type="hidden" name="id" value="<?= $data['lapangan']['id']; ?>">
                    <?php endif; ?>
                    
                    <div class="form-grid">
                        <div class="form-group">
                            <label class="form-label">Nama Lapangan</label>
                            <input class="form-control" name="nama_lapangan" value="<?= isset($data['lapangan']['nama_lapangan']) ? htmlspecialchars($data['lapangan']['nama_lapangan']) : ''; ?>" required>
                        </div>
                        
                        <div class="form-group">
                            <label class="form-label">Kategori</label>
                            <select class="form-control" name="id_kategori" required>
                                <?php foreach ($data['kategori'] as $kat): ?>
                                    <option value="<?= $kat['id']; ?>" <?= (!empty($data['lapangan']) && $data['lapangan']['id_kategori'] == $kat['id']) ? 'selected' : ''; ?>>
                                        <?= htmlspecialchars($kat['nama_kategori']); ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        
                        <div class="form-group">
                            <label class="form-label">Harga / Jam</label>
                            <input class="form-control" type="number" name="harga_per_jam" value="<?= isset($data['lapangan']['harga_per_jam']) ? htmlspecialchars($data['lapangan']['harga_per_jam']) : ''; ?>" required>
                        </div>
                        
                        <div class="form-group">
                            <label class="form-label">Status</label>
                            <select class="form-control" name="status" required>
                                <option value="aktif" <?= (!empty($data['lapangan']) && $data['lapangan']['status'] === 'aktif') ? 'selected' : ''; ?>>Tersedia</option>
                                <option value="nonaktif" <?= (!empty($data['lapangan']) && $data['lapangan']['status'] === 'nonaktif') ? 'selected' : ''; ?>>Nonaktif</option>
                            </select>
                        </div>
                        
                        <div class="form-group full">
                            <label class="form-label">Fasilitas (pisahkan dengan koma)</label>
                            <input class="form-control" name="fasilitas" value="<?= isset($data['lapangan']['fasilitas']) ? htmlspecialchars($data['lapangan']['fasilitas']) : ''; ?>" placeholder="Sintetis, Shower, WiFi">
                        </div>
                        
                        <div class="form-group full">
                            <label class="form-label">Deskripsi</label>
                            <textarea class="form-control" name="deskripsi" rows="4"><?= isset($data['lapangan']['deskripsi']) ? htmlspecialchars($data['lapangan']['deskripsi']) : ''; ?></textarea>
                        </div>
                        
                        <div class="form-group full">
                            <label class="form-label">Foto Utama</label>
                            <input class="form-control" type="file" name="foto_utama">
                        </div>
                    </div>
                    
                    <button class="btn-primary" type="submit"><i class="fas fa-save"></i> Simpan Lapangan</button>
                </form>
            </section>
        </main>
    </div>
</body>
</html>
