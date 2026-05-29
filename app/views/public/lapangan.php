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
                <h2>Filter</h2>
                <div class="filter-group">
                    <label class="form-label" for="search">Nama Lapangan</label>
                    <input type="text" id="search" class="form-control" placeholder="Cari lapangan">
                </div>
                <div class="filter-group">
                    <label class="form-label" for="sport">Cabang Olahraga</label>
                    <select id="sport" class="form-control">
                        <option>Semua Cabang</option>
                        <option>Futsal</option>
                        <option>Tennis</option>
                        <option>Badminton</option>
                        <option>Basket</option>
                    </select>
                </div>
                <div class="filter-group">
                    <label class="form-label" for="date">Tanggal Main</label>
                    <input type="date" id="date" class="form-control">
                </div>
                <div class="filter-group">
                    <label class="form-label" for="location">Lokasi</label>
                    <select id="location" class="form-control">
                        <option>Semua Lokasi</option>
                        <option>Kedaton</option>
                        <option>Sukarame</option>
                        <option>Way Halim</option>
                        <option>Kemiling</option>
                        <option>Tanjung Karang</option>
                    </select>
                </div>
                <button class="btn-primary filter-button">
                    <i class="fas fa-filter"></i> Terapkan
                </button>
            </aside>

            <div class="catalog-content">
                <div class="catalog-toolbar">
                    <div>
                        <span>5 lapangan tersedia</span>
                        <strong>Rekomendasi hari ini</strong>
                    </div>
                    <select class="form-control sort-select">
                        <option>Urutkan: Populer</option>
                        <option>Harga Terendah</option>
                        <option>Rating Tertinggi</option>
                    </select>
                </div>

                <div class="catalog-grid">
                    <article class="venue-card">
                        <img src="<?= BASEURL; ?>/public/assets/img/bola.png" alt="Lapangan futsal" class="venue-img">
                        <div class="venue-body">
                            <div class="venue-topline">
                                <span>Futsal</span>
                                <strong><i class="fas fa-star"></i> 4.9</strong>
                            </div>
                            <h2>Inter Futsal Kedaton</h2>
                            <p><i class="fas fa-map-marker-alt"></i> Kedaton, Bandar Lampung</p>
                            <div class="venue-meta">
                                <span>Indoor</span>
                                <span>08:00 - 22:00</span>
                                <span>12 slot</span>
                            </div>
                            <div class="venue-footer">
                                <div class="venue-price">Rp 150.000<span>/jam</span></div>
                                <a href="<?= BASEURL; ?>/auth/login" class="btn-secondary">Detail</a>
                            </div>
                        </div>
                    </article>

                    <article class="venue-card">
                        <img src="<?= BASEURL; ?>/public/assets/img/tenis.jpg" alt="Lapangan tennis" class="venue-img">
                        <div class="venue-body">
                            <div class="venue-topline">
                                <span>Tennis</span>
                                <strong><i class="fas fa-star"></i> 4.8</strong>
                            </div>
                            <h2>Kemiling Tennis Club</h2>
                            <p><i class="fas fa-map-marker-alt"></i> Kemiling, Bandar Lampung</p>
                            <div class="venue-meta">
                                <span>Outdoor</span>
                                <span>06:00 - 21:00</span>
                                <span>9 slot</span>
                            </div>
                            <div class="venue-footer">
                                <div class="venue-price">Rp 100.000<span>/jam</span></div>
                                <a href="<?= BASEURL; ?>/auth/login" class="btn-secondary">Detail</a>
                            </div>
                        </div>
                    </article>

                    <article class="venue-card">
                        <img src="<?= BASEURL; ?>/public/assets/img/badminton.jpg" alt="Lapangan badminton" class="venue-img">
                        <div class="venue-body">
                            <div class="venue-topline">
                                <span>Badminton</span>
                                <strong><i class="fas fa-star"></i> 4.9</strong>
                            </div>
                            <h2>Sukarame Badminton Hall</h2>
                            <p><i class="fas fa-map-marker-alt"></i> Sukarame, Bandar Lampung</p>
                            <div class="venue-meta">
                                <span>Indoor</span>
                                <span>07:00 - 23:00</span>
                                <span>15 slot</span>
                            </div>
                            <div class="venue-footer">
                                <div class="venue-price">Rp 80.000<span>/jam</span></div>
                                <a href="<?= BASEURL; ?>/auth/login" class="btn-secondary">Detail</a>
                            </div>
                        </div>
                    </article>

                    <article class="venue-card">
                        <img src="<?= BASEURL; ?>/public/assets/img/basket.jpg" alt="Lapangan basket" class="venue-img">
                        <div class="venue-body">
                            <div class="venue-topline">
                                <span>Basket</span>
                                <strong><i class="fas fa-star"></i> 4.7</strong>
                            </div>
                            <h2>Way Halim Basketball Court</h2>
                            <p><i class="fas fa-map-marker-alt"></i> Way Halim, Bandar Lampung</p>
                            <div class="venue-meta">
                                <span>Outdoor</span>
                                <span>08:00 - 20:00</span>
                                <span>7 slot</span>
                            </div>
                            <div class="venue-footer">
                                <div class="venue-price">Rp 120.000<span>/jam</span></div>
                                <a href="<?= BASEURL; ?>/auth/login" class="btn-secondary">Detail</a>
                            </div>
                        </div>
                    </article>
                </div>
            </div>
        </section>
    </main>
</body>

</html>
