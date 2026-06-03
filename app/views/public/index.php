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
                    <i class="fas fa-gem icon-small"></i> EST. 2026 - BANDAR LAMPUNG
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
                    <?php
                    $months = ["JANUARI", "FEBRUARI", "MARET", "APRIL", "MEI", "JUNI", "JULI", "AGUSTUS", "SEPTEMBER", "OKTOBER", "NOVEMBER", "DESEMBER"];
                    $currentMonth = $months[date('n') - 1];
                    $currentYear = date('Y');
                    ?>
                    <span><?= $currentMonth . ' ' . $currentYear ?></span>
                    <div class="widget-arrows">
                        <i class="fas fa-chevron-left"></i>
                        <i class="fas fa-chevron-right"></i>
                    </div>
                </div>
                <div class="widget-days">
                    <?php
                    $days = ["MIN", "SEN", "SEL", "RAB", "KAM", "JUM", "SAB"];
                    for ($i = 0; $i < 5; $i++) {
                        $timestamp = strtotime("+$i days");
                        $dayName = $days[date('w', $timestamp)];
                        $dateNum = date('j', $timestamp);
                        $activeClass = $i == 0 ? ' active' : '';
                        echo "<div class=\"day-col{$activeClass}\"><span>{$dayName}</span><strong>{$dateNum}</strong></div>";
                    }
                    ?>
                </div>
                <div class="widget-body">
                    <?php
                    $widgetCourts = array_slice($data['rekomen'] ?? [], 0, 2);
                    // Fallback in case no courts are returned
                    if (empty($widgetCourts)) {
                        $widgetCourts = [
                            ['nama_lapangan' => 'LAP. 1 (INDOOR)'],
                            ['nama_lapangan' => 'LAP. 2 (OUTDOOR)']
                        ];
                    }
                    $statuses = ['available' => 'TERSEDIA', 'booked' => 'BOOKED', 'selected' => 'DIPILIH'];
                    foreach ($widgetCourts as $index => $court) {
                        $slots = ['08:00', '09:00', '10:00'];
                        echo '<div class="court-col">';
                        $courtName = is_array($court) ? $court['nama_lapangan'] : $court->nama_lapangan;
                        $shortName = strlen($courtName) > 15 ? substr($courtName, 0, 15) . '...' : $courtName;
                        echo '<div class="court-title">' . strtoupper($shortName) . '</div>';
                        
                        foreach ($slots as $slotIdx => $time) {
                            if ($index == 0 && $slotIdx == 1) {
                                $class = 'selected';
                            } elseif ($index == 1 && $slotIdx < 2) {
                                $class = 'booked';
                            } else {
                                $class = 'available';
                            }
                            $label = $statuses[$class];
                            echo '<div class="time-slot ' . $class . '">';
                            echo '<span class="time">' . $time . '</span>';
                            echo '<span class="status">' . $label . '</span>';
                            echo '</div>';
                        }
                        echo '</div>';
                    }
                    ?>
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
                <div class="stat-number"><?= number_format($data['total_lapangan'] ?? 0, 0, ',', '.') ?></div>
                <div class="stat-label">Lapangan Tersedia</div>
            </div>
            <div class="stat-card">
                <div class="stat-icon"><i class="fas fa-users"></i></div>
                <div class="stat-number"><?= number_format($data['total_pelanggan'] ?? 0, 0, ',', '.') ?></div>
                <div class="stat-label">Pengguna Terdaftar</div>
            </div>
            <div class="stat-card">
                <div class="stat-icon"><i class="fas fa-calendar-check"></i></div>
                <div class="stat-number"><?= number_format($data['total_booking'] ?? 0, 0, ',', '.') ?></div>
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
            <?php if (!empty($data['rekomen'])): ?>
                <?php foreach ($data['rekomen'] as $lap): ?>
                    <div class="card">
                        <div class="card-badge"><i class="fas fa-star"></i> <?= number_format($lap['rating'], 1) ?></div>
                        <img src="<?= BASEURL; ?>/public/assets/uploads/lapangan/<?= htmlspecialchars($lap['foto_utama']) ?>" 
                             alt="<?= htmlspecialchars($lap['nama_lapangan']) ?>" 
                             class="card-img"
                             onerror="this.src='<?= BASEURL; ?>/public/assets/img/bola.png'">
                        <div class="card-content">
                            <div class="card-category"><?= strtoupper(htmlspecialchars($lap['nama_kategori'])) ?></div>
                            <h3 class="card-title"><?= htmlspecialchars($lap['nama_lapangan']) ?></h3>
                            <div class="card-info">
                                <div><i class="fas fa-map-marker-alt"></i> Bandar Lampung</div>
                                <div><i class="fas fa-user-tie"></i> Mitra Lifesports</div>
                            </div>
                            <div class="card-footer">
                                <div class="card-price">Rp <?= number_format($lap['harga_per_jam'], 0, ',', '.') ?><span class="price-unit">/jam</span>
                                </div>
                                <a href="<?= BASEURL; ?>/home/lapangan" class="btn-secondary compact-button">Detail</a>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p>Belum ada data lapangan populer.</p>
            <?php endif; ?>
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
                &copy; 2026 Lifesports Premium Club. Bandar Lampung.
            </div>
        </div>
    </footer>

</body>

</html>
