<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lifesports - Premium Sport Club</title>
    <link rel="stylesheet" href="<?= BASEURL; ?>/public/assets/css/styles.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>

<body>

    <div class="watermark">LIFESPORTS</div>

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
            <li><a href="#cara-booking">Cara Booking</a></li>
            <li><a href="#kontak">Kontak</a></li>
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

    <section class="hero container">
        <div class="hero-content">
            <div class="est-badge">
                    <i class="fas fa-gem icon-small"></i> EST. 2024 - BANDAR LAMPUNG
            </div>

            <h1 class="hero-title">Reservasi Fasilitas</h1>
            <h2 class="hero-title-script">Olahraga Premium</h2>

            <p class="hero-desc">
                Sistem manajemen penyewaan lapangan olahraga terpadu. Memberikan kemudahan reservasi, kepastian jadwal, dan pengalaman eksklusif bagi setiap pelanggan.
            </p>

            <div class="hero-actions">
                <a href="<?= BASEURL; ?>/home/lapangan" class="btn-primary">
                    <i class="fas fa-search"></i> Cari Lapangan
                </a>
                <a href="<?= BASEURL; ?>/auth/register" class="btn-secondary">
                    <i class="fas fa-user-plus"></i> Registrasi Akun
                </a>
            </div>
        </div>

        <div class="hero-widget-wrapper">
            <div class="booking-widget">
                <div class="widget-header">
                    <i class="fas fa-calendar-alt"></i>
                    <span>APRIL 2024</span>
                    <div class="widget-arrows">
                        <i class="fas fa-chevron-left"></i>
                        <i class="fas fa-chevron-right"></i>
                    </div>
                </div>
                <div class="widget-days">
                    <div class="day-col"><span>SEN</span><strong>27</strong></div>
                    <div class="day-col"><span>SEL</span><strong>28</strong></div>
                    <div class="day-col active"><span>RAB</span><strong>29</strong></div>
                    <div class="day-col"><span>KAM</span><strong>30</strong></div>
                    <div class="day-col"><span>JUM</span><strong>1</strong></div>
                </div>
                <div class="widget-body">
                    <div class="court-col">
                        <div class="court-title">LAP. 1 (INDOOR)</div>
                        <div class="time-slot available">
                            <span class="time">08:00</span>
                            <span class="status">TERSEDIA</span>
                        </div>
                        <div class="time-slot selected">
                            <span class="time">09:00</span>
                            <span class="status">DIPILIH</span>
                        </div>
                        <div class="time-slot available">
                            <span class="time">10:00</span>
                            <span class="status">TERSEDIA</span>
                        </div>
                    </div>
                    <div class="court-col">
                        <div class="court-title">LAP. 2 (OUTDOOR)</div>
                        <div class="time-slot booked">
                            <span class="time">08:00</span>
                            <span class="status">BOOKED</span>
                        </div>
                        <div class="time-slot booked">
                            <span class="time">09:00</span>
                            <span class="status">BOOKED</span>
                        </div>
                        <div class="time-slot available">
                            <span class="time">10:00</span>
                            <span class="status">TERSEDIA</span>
                        </div>
                    </div>
                </div>
                <div class="widget-footer">
                    <div class="price-info">
                        <span>TOTAL HARGA</span>
                        <strong>Rp 150.000</strong>
                    </div>
                    <button class="btn-widget">KONFIRMASI</button>
                </div>
            </div>

            <div class="floating-badge">
                <div class="badge-icon"><i class="fas fa-stopwatch"></i></div>
                <div class="badge-text">
                    <span>REAL-TIME</span>
                    <strong>Booking Instan</strong>
                </div>
            </div>
        </div>
    </section>

    <section class="stats">
        <div class="container stats-grid">
            <div class="stat-card">
                <div class="stat-icon"><i class="fas fa-building"></i></div>
                <div class="stat-number">124</div>
                <div class="stat-label">Lapangan Tersedia</div>
            </div>
            <div class="stat-card">
                <div class="stat-icon"><i class="fas fa-users"></i></div>
                <div class="stat-number">5,430</div>
                <div class="stat-label">Pelanggan Aktif</div>
            </div>
            <div class="stat-card">
                <div class="stat-icon"><i class="fas fa-calendar-check"></i></div>
                <div class="stat-number">12k+</div>
                <div class="stat-label">Total Booking</div>
            </div>
        </div>
    </section>

    <section class="populer container">
        <div class="section-header">
            <h3 class="section-subtitle">Temukan Pilihan</h3>
            <h2 class="section-title">Lapangan Populer</h2>
        </div>

        <div class="card-grid">

            <div class="card">
                <div class="card-badge"><i class="fas fa-star"></i> 4.9</div>
                <img src="<?= BASEURL; ?>/public/assets/img/bola.png" alt="Futsal Field" class="card-img">
                <div class="card-content">
                    <div class="card-category">FUTSAL</div>
                    <h3 class="card-title">Gelora Bung Karno Arena</h3>
                    <div class="card-info">
                        <div><i class="fas fa-map-marker-alt"></i> Senayan, Jakarta Pusat</div>
                        <div><i class="fas fa-user-tie"></i> Kemenpora RI</div>
                    </div>
                    <div class="card-footer">
                        <div class="card-price">Rp 350.000<span class="price-unit">/jam</span>
                        </div>
                        <a href="../pelanggan/detail-lapangan.html" class="btn-secondary compact-button">Detail</a>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-badge"><i class="fas fa-star"></i> 4.8</div>
                <img src="<?= BASEURL; ?>/public/assets/img/tenis.jpg"
                    alt="Tennis Field" class="card-img">
                <div class="card-content">
                    <div class="card-category">TENNIS</div>
                    <h3 class="card-title">Cilandak Sport Center</h3>
                    <div class="card-info">
                        <div><i class="fas fa-map-marker-alt"></i> Cilandak, Jakarta Selatan</div>
                        <div><i class="fas fa-user-tie"></i> PT. Cilandak Jaya</div>
                    </div>
                    <div class="card-footer">
                        <div class="card-price">Rp 150.000<span class="price-unit">/jam</span>
                        </div>
                        <a href="../pelanggan/detail-lapangan.html" class="btn-secondary compact-button">Detail</a>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-badge"><i class="fas fa-star"></i> 4.9</div>
                <img src="<?= BASEURL; ?>/public/assets/img/badminton.jpg"
                    alt="Badminton Field" class="card-img">
                <div class="card-content">
                    <div class="card-category">BADMINTON</div>
                    <h3 class="card-title">Taufik Hidayat Arena</h3>
                    <div class="card-info">
                        <div><i class="fas fa-map-marker-alt"></i> Ciracas, Jakarta Timur</div>
                        <div><i class="fas fa-user-tie"></i> THA Management</div>
                    </div>
                    <div class="card-footer">
                        <div class="card-price">Rp 100.000<span class="price-unit">/jam</span>
                        </div>
                        <a href="../pelanggan/detail-lapangan.html" class="btn-secondary compact-button">Detail</a>
                    </div>
                </div>
            </div>
        </div>

        <div class="center-cta">
            <a href="<?= BASEURL; ?>/home/lapangan" class="btn-primary wide-cta">
                Lihat Semua Lapangan <i class="fas fa-arrow-right"></i>
            </a>
        </div>
    </section>

    <section class="steps" id="cara-booking">
        <div class="container">
            <div class="section-header">
                <h3 class="section-subtitle">Proses Cepat</h3>
                <h2 class="section-title">Cara Booking</h2>
            </div>
            <div class="steps-grid">
                <div class="step-item">
                    <div class="step-number">1</div>
                    <h4 class="step-title">Cari Lapangan</h4>
                    <p class="step-desc">Temukan lapangan premium yang sesuai dengan kebutuhan Anda.</p>
                </div>
                <div class="step-item">
                    <div class="step-number">2</div>
                    <h4 class="step-title">Pilih Jadwal</h4>
                    <p class="step-desc">Tentukan tanggal dan sesi waktu yang sesuai dengan ketersediaan lapangan.</p>
                </div>
                <div class="step-item">
                    <div class="step-number">3</div>
                    <h4 class="step-title">Pembayaran</h4>
                    <p class="step-desc">Selesaikan transaksi melalui gerbang pembayaran terverifikasi kami.</p>
                </div>
                <div class="step-item">
                    <div class="step-number">4</div>
                    <h4 class="step-title">Konfirmasi</h4>
                    <p class="step-desc">Tunjukkan bukti reservasi di lokasi dan nikmati fasilitas olahraga pilihan Anda.</p>
                </div>
            </div>
        </div>
    </section>

    <footer class="footer" id="kontak">
        <div class="container">
            <div class="footer-content">
                <div>
                    <div class="footer-brand">Lifesports</div>
                    <p class="footer-desc">Platform penyewaan fasilitas olahraga terpadu dengan standar pelayanan tingkat tinggi. Keamanan, kenyamanan, dan kepastian reservasi adalah prioritas kami.</p>
                </div>
                <div>
                    <h4>Tautan Cepat</h4>
                    <ul>
                        <li><a href="<?= BASEURL; ?>/home">Beranda</a></li>
                        <li><a href="<?= BASEURL; ?>/home/lapangan">Daftar Lapangan</a></li>
                        <li><a href="#cara-booking">Tentang Kami</a></li>
                        <li><a href="#kontak">Kontak</a></li>
                    </ul>
                </div>
                <div>
                    <h4>Pusat Bantuan</h4>
                    <ul>
                        <li><a href="#cara-booking">Cara Booking</a></li>
                        <li><a href="#kontak">FAQ</a></li>
                        <li><a href="#kontak">Syarat & Ketentuan</a></li>
                        <li><a href="#kontak">Kebijakan Privasi</a></li>
                    </ul>
                </div>
            </div>
            <div class="footer-bottom">
                &copy; 2024 Lifesports Premium Club. Bandar Lampung.
            </div>
        </div>
    </footer>

</body>

</html>
