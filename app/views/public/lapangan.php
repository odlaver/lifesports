<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Lapangan - Lifesports</title>
    <link rel="stylesheet" href="<?= BASEURL; ?>/public/assets/css/styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>

<body>
    <header class="navbar">
        <a href="<?= BASEURL; ?>/home" class="nav-brand">
            <div class="brand-icon">
                <i class="fas fa-trophy"></i>
            </div>
            Lifesports
        </a>

        <ul class="nav-links">
            <li><a href="<?= BASEURL; ?>/home">Beranda</a></li>
            <li><a href="<?= BASEURL; ?>/home/lapangan">Lapangan</a></li>
            <li><a href="index.html#cara-booking">Cara Booking</a></li>
            <li><a href="index.html#kontak">Kontak</a></li>
        </ul>

        <div class="nav-actions">
            <a href="<?= BASEURL; ?>/auth/login" class="btn-nav">
                <i class="fas fa-sign-in-alt"></i> Masuk
            </a>
            <a href="<?= BASEURL; ?>/auth/register" class="btn-nav">
                <i class="fas fa-user"></i> Daftar
            </a>
        </div>
    </header>

    <main>
        <section class="page-hero container">
            <div>
                <div class="est-badge">
                    <i class="fas fa-location-dot icon-small"></i> PILIH LAPANGAN
                </div>
                <h1 class="page-title">Cari Fasilitas Olahraga</h1>
                <p class="page-desc">Pilih lapangan berdasarkan cabang olahraga, lokasi, harga, dan jadwal yang tersedia.</p>
            </div>
        </section>

        <section class="catalog container">
            <aside class="filter-panel">
                <form method="GET" action="<?= BASEURL; ?>/home/lapangan" id="filterForm">
                    <h2>Filter</h2>
                    <div class="filter-group">
                        <label class="form-label" for="search">Nama Lapangan</label>
                        <input type="text" id="search" name="search" class="form-control" placeholder="Cari lapangan" value="<?= htmlspecialchars($data['filter']['search']); ?>">
                    </div>
                    <div class="filter-group">
                        <label class="form-label" for="sport">Cabang Olahraga</label>
                        <select id="sport" name="sport" class="form-control" onchange="this.form.submit()">
                            <option <?= $data['filter']['sport'] == 'Semua Cabang' || empty($data['filter']['sport']) ? 'selected' : ''; ?>>Semua Cabang</option>
                            <?php foreach ($data['kategori'] as $k): ?>
                                <option <?= $data['filter']['sport'] == $k['nama_kategori'] ? 'selected' : ''; ?>><?= htmlspecialchars($k['nama_kategori']); ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="filter-group">
                        <label class="form-label" for="date">Tanggal Main</label>
                        <input type="date" id="date" name="date" class="form-control" value="<?= htmlspecialchars($data['filter']['date']); ?>" onchange="this.form.submit()">
                    </div>
                    <div class="filter-group">
                        <label class="form-label" for="location">Lokasi</label>
                        <select id="location" name="location" class="form-control" onchange="this.form.submit()">
                            <option <?= $data['filter']['location'] == 'Semua Lokasi' || empty($data['filter']['location']) ? 'selected' : ''; ?>>Semua Lokasi</option>
                            <option <?= $data['filter']['location'] == 'Kedaton' ? 'selected' : ''; ?>>Kedaton</option>
                            <option <?= $data['filter']['location'] == 'Sukarame' ? 'selected' : ''; ?>>Sukarame</option>
                            <option <?= $data['filter']['location'] == 'Way Halim' ? 'selected' : ''; ?>>Way Halim</option>
                            <option <?= $data['filter']['location'] == 'Kemiling' ? 'selected' : ''; ?>>Kemiling</option>
                            <option <?= $data['filter']['location'] == 'Tanjung Karang' ? 'selected' : ''; ?>>Tanjung Karang</option>
                        </select>
                    </div>
                    <button type="submit" class="btn-primary filter-button">
                        <i class="fas fa-filter"></i> Terapkan
                    </button>
                </form>
            </aside>

            <div class="catalog-content">
                <div class="catalog-toolbar">
                    <div>
                        <span><?= count($data['lapangan']); ?> lapangan tersedia</span>
                        <strong>Rekomendasi hari ini</strong>
                    </div>
                    <select class="form-control sort-select" name="sort" form="filterForm" onchange="document.getElementById('filterForm').submit();">
                        <option <?= $data['filter']['sort'] == 'Populer' || empty($data['filter']['sort']) ? 'selected' : ''; ?>>Urutkan: Populer</option>
                        <option <?= $data['filter']['sort'] == 'Harga Terendah' ? 'selected' : ''; ?>>Harga Terendah</option>
                        <option <?= $data['filter']['sort'] == 'Rating Tertinggi' ? 'selected' : ''; ?>>Rating Tertinggi</option>
                    </select>
                </div>

                <div class="catalog-grid">
                    <?php if (empty($data['lapangan'])): ?>
                        <div style="grid-column: 1 / -1; text-align: center; padding: 3rem;">
                            <i class="fas fa-search fa-3x" style="color: #ccc; margin-bottom: 1rem;"></i>
                            <p>Tidak ada lapangan yang sesuai dengan pencarian Anda.</p>
                        </div>
                    <?php else: ?>
                        <?php foreach ($data['lapangan'] as $lap): ?>
                            <article class="venue-card">
                                <img src="<?= BASEURL; ?>/public/assets/uploads/lapangan/<?= htmlspecialchars($lap['foto_utama']); ?>" alt="<?= htmlspecialchars($lap['nama_lapangan']); ?>" class="venue-img">
                                <div class="venue-body">
                                    <div class="venue-topline">
                                        <span><?= htmlspecialchars($lap['nama_kategori']); ?></span>
                                        <strong><i class="fas fa-star"></i> <?= number_format($lap['rating'], 1); ?></strong>
                                    </div>
                                    <h2><?= htmlspecialchars($lap['nama_lapangan']); ?></h2>
                                    <p><i class="fas fa-map-marker-alt"></i> <?= htmlspecialchars(substr($lap['deskripsi'], 0, 50)); ?>...</p>
                                    <div class="venue-meta">
                                        <span><?= (strpos(strtolower($lap['deskripsi']), 'indoor') !== false) ? 'Indoor' : 'Outdoor'; ?></span>
                                        <span>08:00 - 22:00</span>
                                        <span>Tersedia</span>
                                    </div>
                                    <div class="venue-footer">
                                        <div class="venue-price">Rp <?= number_format($lap['harga_per_jam'], 0, ',', '.'); ?><span>/jam</span></div>
                                        <a href="<?= BASEURL; ?>/auth/login" class="btn-secondary">Detail</a>
                                    </div>
                                </div>
                            </article>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>
            </div>
        </section>
    </main>
</body>

</html>
