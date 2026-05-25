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
                <li><a href="<?= BASEURL; ?>/auth/login" class="nav-danger"><i class="fas fa-sign-out-alt"></i> Keluar</a></li>
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
                        <div class="profile-name">Deni Ramdani</div>
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
                        <option>Jakarta Pusat</option>
                        <option>Jakarta Selatan</option>
                        <option>Jakarta Timur</option>
                        <option>Bandar Lampung</option>
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

                    <article class="venue-card" id="venue-gbk">
                        <img src="<?= BASEURL; ?>/public/assets/img/bola.png" alt="Lapangan futsal GBK" class="venue-img">
                        <div class="venue-body">
                            <div class="venue-topline">
                                <span>Futsal</span>
                                <strong><i class="fas fa-star"></i> 4.9</strong>
                            </div>
                            <h2>Gelora Bung Karno Arena</h2>
                            <p><i class="fas fa-map-marker-alt"></i> Senayan, Jakarta Pusat</p>
                            <div class="venue-meta">
                                <span>Indoor</span>
                                <span>08:00 - 22:00</span>
                                <span>12 slot</span>
                            </div>
                            <div class="venue-footer">
                                <div class="venue-price">Rp 350.000<span>/jam</span></div>
                                <a href="<?= BASEURL; ?>/pelanggan/pelanggan_detail_lapangan" class="btn-secondary" id="btn-detail-gbk">Detail</a>
                            </div>
                        </div>
                    </article>

                    <article class="venue-card" id="venue-cilandak">
                        <img src="<?= BASEURL; ?>/public/assets/img/tenis.jpg" alt="Lapangan tennis Cilandak" class="venue-img">
                        <div class="venue-body">
                            <div class="venue-topline">
                                <span>Tennis</span>
                                <strong><i class="fas fa-star"></i> 4.8</strong>
                            </div>
                            <h2>Cilandak Sport Center</h2>
                            <p><i class="fas fa-map-marker-alt"></i> Cilandak, Jakarta Selatan</p>
                            <div class="venue-meta">
                                <span>Outdoor</span>
                                <span>06:00 - 21:00</span>
                                <span>9 slot</span>
                            </div>
                            <div class="venue-footer">
                                <div class="venue-price">Rp 150.000<span>/jam</span></div>
                                <a href="<?= BASEURL; ?>/pelanggan/pelanggan_detail_lapangan" class="btn-secondary" id="btn-detail-cilandak">Detail</a>
                            </div>
                        </div>
                    </article>

                    <article class="venue-card" id="venue-taufik">
                        <img src="<?= BASEURL; ?>/public/assets/img/badminton.jpg" alt="Lapangan badminton Taufik" class="venue-img">
                        <div class="venue-body">
                            <div class="venue-topline">
                                <span>Badminton</span>
                                <strong><i class="fas fa-star"></i> 4.9</strong>
                            </div>
                            <h2>Taufik Hidayat Arena</h2>
                            <p><i class="fas fa-map-marker-alt"></i> Ciracas, Jakarta Timur</p>
                            <div class="venue-meta">
                                <span>Indoor</span>
                                <span>07:00 - 23:00</span>
                                <span>15 slot</span>
                            </div>
                            <div class="venue-footer">
                                <div class="venue-price">Rp 100.000<span>/jam</span></div>
                                <a href="<?= BASEURL; ?>/pelanggan/pelanggan_detail_lapangan" class="btn-secondary" id="btn-detail-taufik">Detail</a>
                            </div>
                        </div>
                    </article>

                    <article class="venue-card" id="venue-southcourt">
                        <img src="<?= BASEURL; ?>/public/assets/img/basket.jpg" alt="Lapangan basket South Court" class="venue-img">
                        <div class="venue-body">
                            <div class="venue-topline">
                                <span>Basket</span>
                                <strong><i class="fas fa-star"></i> 4.7</strong>
                            </div>
                            <h2>South Court Basketball</h2>
                            <p><i class="fas fa-map-marker-alt"></i> Kemang, Jakarta Selatan</p>
                            <div class="venue-meta">
                                <span>Outdoor</span>
                                <span>08:00 - 20:00</span>
                                <span>7 slot</span>
                            </div>
                            <div class="venue-footer">
                                <div class="venue-price">Rp 180.000<span>/jam</span></div>
                                <a href="<?= BASEURL; ?>/pelanggan/pelanggan_detail_lapangan" class="btn-secondary" id="btn-detail-southcourt">Detail</a>
                            </div>
                        </div>
                    </article>

                    <article class="venue-card" id="venue-gor-sumantri">
                        <img src="<?= BASEURL; ?>/public/assets/img/basket indoor.jpg" alt="GOR Soemantri" class="venue-img">
                        <div class="venue-body">
                            <div class="venue-topline">
                                <span>Basket</span>
                                <strong><i class="fas fa-star"></i> 4.7</strong>
                            </div>
                            <h2>GOR Soemantri Brodjonegoro</h2>
                            <p><i class="fas fa-map-marker-alt"></i> Kuningan, Jakarta Selatan</p>
                            <div class="venue-meta">
                                <span>Indoor</span>
                                <span>08:00 - 22:00</span>
                                <span>6 slot</span>
                            </div>
                            <div class="venue-footer">
                                <div class="venue-price">Rp 250.000<span>/jam</span></div>
                                <a href="<?= BASEURL; ?>/pelanggan/pelanggan_detail_lapangan" class="btn-secondary" id="btn-detail-gor">Detail</a>
                            </div>
                        </div>
                    </article>

                </div>

            </section>
        </main>
    </div>
</body>
</html>
