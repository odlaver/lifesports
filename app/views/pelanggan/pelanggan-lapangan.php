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

                <div class="filter-bar compact" id="filter-lapangan-top">
                    <input class="form-control" id="search-lapangan" type="text" placeholder="Cari nama lapangan...">
                    <select class="form-control" id="filter-cabang">
                        <option>Semua Cabang</option>
                        <option>Futsal</option>
                        <option>Tennis</option>
                        <option>Badminton</option>
                        <option>Basket</option>
                    </select>
                    <select class="form-control" id="filter-lokasi">
                        <option>Semua Lokasi</option>
                        <option>Kedaton</option>
                        <option>Sukarame</option>
                        <option>Way Halim</option>
                        <option>Kemiling</option>
                        <option>Tanjung Karang</option>
                    </select>
                    <input class="form-control" id="filter-tanggal" type="date">
                    <select class="form-control" id="filter-sort">
                        <option>Urutkan: Populer</option>
                        <option>Harga Terendah</option>
                        <option>Rating Tertinggi</option>
                    </select>
                    <button class="btn-primary compact-button" id="btn-terapkan-filter">
                        <i class="fas fa-filter"></i> Terapkan
                    </button>
                </div>

                <div class="table-header" id="hasil-lapangan">
                    <div>
                        <span class="text-muted">8 LAPANGAN TERSEDIA</span>
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
