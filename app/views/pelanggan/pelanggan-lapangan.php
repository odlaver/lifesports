<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cari Lapangan - Lifesports</title>
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
                <li><a href="<?= BASEURL; ?>/pelanggan/booking"><i class="fas fa-calendar-check"></i> Riwayat Booking</a></li>
                <li><a href="<?= BASEURL; ?>/pelanggan/profile"><i class="fas fa-user"></i> Profile Saya</a></li>
                <li><a href="<?= BASEURL; ?>/pelanggan/lapangan" class="active"><i class="fas fa-search"></i> Cari Lapangan</a></li>
                <li><a href="<?= BASEURL; ?>/auth/logout" class="nav-danger"><i class="fas fa-sign-out-alt"></i> Keluar</a></li>
            </ul>
        </aside>

        <main class="main-content">

            <header class="dashboard-header">
                <div class="dash-title">
                    <h1>Cari Lapangan</h1>
                    <p>Pilih lapangan berdasarkan cabang olahraga, lokasi, harga, dan jadwal.</p>
                </div>
                <div class="dash-profile">
                    <div class="profile-info">
                        <div class="profile-name"><?= htmlspecialchars($_SESSION['nama']); ?></div>
                        <div class="profile-role">Pelanggan</div>
                    </div>
                    <div class="profile-img">
                        <i class="fas fa-user"></i>
                    </div>
                </div>
            </header>


            <section class="table-container catalog-dashboard">

                <form method="GET" action="<?= BASEURL; ?>/pelanggan/lapangan" id="filterForm">
                    <div class="filter-bar compact" id="filter-lapangan-top">
                        <input class="form-control" name="search" id="search-lapangan" type="text" placeholder="Cari nama lapangan..." value="<?= htmlspecialchars($data['filter']['search']); ?>" onkeypress="if(event.keyCode == 13) this.form.submit()">
                        <select class="form-control" name="sport" id="filter-cabang" onchange="this.form.submit()">
                            <option <?= $data['filter']['sport'] == 'Semua Cabang' || empty($data['filter']['sport']) ? 'selected' : ''; ?>>Semua Cabang</option>
                            <?php foreach ($data['kategori'] as $k): ?>
                                <option <?= $data['filter']['sport'] == $k['nama_kategori'] ? 'selected' : ''; ?>><?= htmlspecialchars($k['nama_kategori']); ?></option>
                            <?php endforeach; ?>
                        </select>
                        <select class="form-control" name="location" id="filter-lokasi" onchange="this.form.submit()">
                            <option <?= $data['filter']['location'] == 'Semua Lokasi' || empty($data['filter']['location']) ? 'selected' : ''; ?>>Semua Lokasi</option>
                            <option <?= $data['filter']['location'] == 'Kedaton' ? 'selected' : ''; ?>>Kedaton</option>
                            <option <?= $data['filter']['location'] == 'Sukarame' ? 'selected' : ''; ?>>Sukarame</option>
                            <option <?= $data['filter']['location'] == 'Way Halim' ? 'selected' : ''; ?>>Way Halim</option>
                            <option <?= $data['filter']['location'] == 'Kemiling' ? 'selected' : ''; ?>>Kemiling</option>
                            <option <?= $data['filter']['location'] == 'Tanjung Karang' ? 'selected' : ''; ?>>Tanjung Karang</option>
                        </select>
                        <input class="form-control" name="date" id="filter-tanggal" type="date" value="<?= htmlspecialchars($data['filter']['date']); ?>" onchange="this.form.submit()">
                        <select class="form-control" name="sort" id="filter-sort" onchange="this.form.submit()">
                            <option <?= $data['filter']['sort'] == 'Populer' || empty($data['filter']['sort']) ? 'selected' : ''; ?>>Urutkan: Populer</option>
                            <option <?= $data['filter']['sort'] == 'Harga Terendah' ? 'selected' : ''; ?>>Harga Terendah</option>
                            <option <?= $data['filter']['sort'] == 'Rating Tertinggi' ? 'selected' : ''; ?>>Rating Tertinggi</option>
                        </select>
                        <button type="submit" class="btn-primary compact-button" id="btn-terapkan-filter">
                            <i class="fas fa-filter"></i> Terapkan
                        </button>
                    </div>
                </form>

                <div class="table-header" id="hasil-lapangan">
                    <div>
                        <span class="text-muted"><?= count($data['lapangan']); ?> LAPANGAN TERSEDIA</span>
                        <strong class="block-label">Rekomendasi hari ini</strong>
                    </div>
                </div>

                <div class="catalog-grid">
                    <?php if (empty($data['lapangan'])): ?>
                        <div style="grid-column: 1/-1; text-align: center; padding: 50px; color: var(--text-muted);">
                            <i class="fas fa-search-minus" style="font-size: 3rem; margin-bottom: 12px; display: block; color: var(--text-gold);"></i>
                            Tidak ada lapangan yang tersedia saat ini.
                        </div>
                    <?php else: ?>
                        <?php foreach($data['lapangan'] as $lapangan): 
                            $foto = !empty($lapangan['foto_utama']) ? $lapangan['foto_utama'] : 'default_lapangan.jpg';
                            
                            $chip_class = 'info';
                            $img_fallback = 'bola.png';
                            if (strtolower($lapangan['nama_kategori']) === 'tennis' || strtolower($lapangan['nama_kategori']) === 'tenis') {
                                $chip_class = 'success';
                                $img_fallback = 'tenis.jpg';
                            } elseif (strtolower($lapangan['nama_kategori']) === 'badminton') {
                                $chip_class = 'warning';
                                $img_fallback = 'badminton.jpg';
                            } elseif (strtolower($lapangan['nama_kategori']) === 'basket') {
                                $chip_class = 'danger';
                                $img_fallback = 'basket.jpg';
                            }
                            
                            $facilities = !empty($lapangan['fasilitas']) ? explode(',', $lapangan['fasilitas']) : ['Standard'];
                        ?>
                            <article class="venue-card">
                                <img src="<?= BASEURL; ?>/public/assets/uploads/lapangan/<?= $foto; ?>" 
                                     onerror="this.onerror=null; this.src='<?= BASEURL; ?>/public/assets/img/<?= $img_fallback; ?>';" alt="<?= htmlspecialchars($lapangan['nama_lapangan']); ?>" class="venue-img">
                                <div class="venue-body">
                                    <div class="venue-topline">
                                        <span class="sport-chip <?= $chip_class; ?>" style="font-size: 0.7rem; padding: 2px 8px; margin: 0;"><?= htmlspecialchars($lapangan['nama_kategori']); ?></span>
                                        <strong><i class="fas fa-star" style="color: var(--text-gold);"></i> <?= number_format($lapangan['rating'], 1); ?></strong>
                                    </div>
                                    <h2><?= htmlspecialchars($lapangan['nama_lapangan']); ?></h2>
                                    <p><i class="fas fa-map-marker-alt"></i> Bandar Lampung</p>
                                    <div class="venue-meta">
                                        <?php foreach($facilities as $facility): ?>
                                            <span><?= htmlspecialchars(trim($facility)); ?></span>
                                        <?php endforeach; ?>
                                    </div>
                                    <div class="venue-footer">
                                        <div class="venue-price">Rp <?= number_format($lapangan['harga_per_jam'], 0, ',', '.'); ?><span>/jam</span></div>
                                        <a href="<?= BASEURL; ?>/pelanggan/pelanggan_detail_lapangan/<?= $lapangan['id']; ?>" class="btn-secondary">Detail</a>
                                    </div>
                                </div>
                            </article>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>


            </section>
        </main>
    </div>
</body>
</html>
