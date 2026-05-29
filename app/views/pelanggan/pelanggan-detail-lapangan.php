<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Lapangan - Lifesports</title>
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
                    <h1>Detail Lapangan</h1>
                    <p>Info lengkap, fasilitas, jadwal slot, dan review pelanggan</p>
                </div>
                <a href="<?= BASEURL; ?>/pelanggan/lapangan" class="btn-primary ghost-light" id="btn-back-lapangan">
                    <i class="fas fa-arrow-left"></i> Kembali
                </a>
            </header>

            <div class="booking-page-dashboard">

                <section class="table-container booking-detail-section">

                    <?php 
                        $foto = !empty($data['lapangan']['foto_utama']) ? $data['lapangan']['foto_utama'] : 'default_lapangan.jpg';
                        $img_fallback = 'bola.png';
                        $chip_class = 'info';
                        if (strtolower($data['lapangan']['nama_kategori']) === 'tennis' || strtolower($data['lapangan']['nama_kategori']) === 'tenis') {
                            $chip_class = 'success';
                            $img_fallback = 'tenis.jpg';
                        } elseif (strtolower($data['lapangan']['nama_kategori']) === 'badminton') {
                            $chip_class = 'warning';
                            $img_fallback = 'badminton.jpg';
                        } elseif (strtolower($data['lapangan']['nama_kategori']) === 'basket') {
                            $chip_class = 'danger';
                            $img_fallback = 'basket.jpg';
                        }
                        
                        $facilities = !empty($data['lapangan']['fasilitas']) ? explode(',', $data['lapangan']['fasilitas']) : ['Locker', 'Kantin', 'Parkir'];
                    ?>
                    <div class="booking-gallery">
                        <img src="<?= BASEURL; ?>/public/assets/uploads/lapangan/<?= $foto; ?>" 
                             onerror="this.onerror=null; this.src='<?= BASEURL; ?>/public/assets/img/<?= $img_fallback; ?>';" alt="<?= htmlspecialchars($data['lapangan']['nama_lapangan']); ?>" class="booking-cover">
                        <div class="booking-thumbs">
                            <img src="<?= BASEURL; ?>/public/assets/uploads/lapangan/<?= $foto; ?>" 
                                 onerror="this.onerror=null; this.src='<?= BASEURL; ?>/public/assets/img/<?= $img_fallback; ?>';" alt="Cover">
                            <img src="<?= BASEURL; ?>/public/assets/img/basket indoor.jpg" alt="Area indoor">
                            <img src="<?= BASEURL; ?>/public/assets/img/tenis2.jpeg" alt="Area fasilitas">
                        </div>
                    </div>

                    <div class="booking-info">
                        <div class="venue-topline">
                            <span class="sport-chip <?= $chip_class; ?>" style="font-size: 0.7rem; padding: 2px 8px; margin: 0;"><?= htmlspecialchars($data['lapangan']['nama_kategori']); ?></span>
                            <strong><i class="fas fa-star" style="color: var(--text-gold);"></i> <?= number_format($data['rating'], 1); ?></strong>
                        </div>
                        <h2><?= htmlspecialchars($data['lapangan']['nama_lapangan']); ?></h2>
                        <p class="booking-location"><i class="fas fa-map-marker-alt"></i> Bandar Lampung</p>
                        <p class="booking-copy"><?= htmlspecialchars($data['lapangan']['deskripsi']); ?></p>

                        <div class="facility-list">
                            <?php foreach($facilities as $facility): ?>
                                <span><i class="fas fa-check-circle"></i> <?= htmlspecialchars(trim($facility)); ?></span>
                            <?php endforeach; ?>
                        </div>

                        <div class="schedule-board" style="margin-top: 25px;">
                            <h3>Informasi Jadwal</h3>
                            <p style="color: var(--text-muted); font-size: 0.85rem;"><i class="fas fa-clock"></i> Silakan pilih tanggal dan masukkan waktu bermain Anda pada formulir pemesanan di sebelah kanan.</p>
                        </div>
                    </div>

                    <div class="table-header section-offset">
                        <h3 class="table-title"><i class="fas fa-star icon-warning"></i> Review Pelanggan</h3>
                        <span class="status-badge status-success"><?= number_format($data['rating'], 1); ?> / 5</span>
                    </div>
                    <div class="stack">
                        <?php if (empty($data['review'])): ?>
                            <div style="text-align: center; padding: 30px; color: var(--text-muted); font-size: 0.9rem;">
                                <i class="far fa-comment-dots" style="font-size: 2rem; margin-bottom: 8px; display: block; color: var(--text-muted);"></i>
                                Belum ada review untuk lapangan ini.
                            </div>
                        <?php else: ?>
                            <?php foreach($data['review'] as $review): ?>
                                <div class="list-row">
                                    <div>
                                        <h4><?= htmlspecialchars($review['nama']); ?></h4>
                                        <small><?= date('d M Y', strtotime($review['created_at'])); ?> &bull; <?= htmlspecialchars($review['nama_kategori']); ?></small>
                                        <p><?= htmlspecialchars($review['komentar']); ?></p>
                                    </div>
                                    <span class="status-badge status-success"><i class="fas fa-star"></i> <?= $review['rating']; ?></span>
                                </div>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </div>


                </section>

                <aside class="checkout-panel" id="panel-booking">
                    <h2>Buat Pesanan</h2>
                    <form action="<?= BASEURL; ?>/pelanggan/proses_booking" method="POST" id="form-booking-lapangan">
                        <input type="hidden" name="id_lapangan" value="<?= $data['lapangan']['id']; ?>">
                        
                        <div class="form-group">
                            <label class="form-label" for="booking-date">Tanggal Main</label>
                            <input type="date" name="tanggal_main" id="booking-date" class="form-control" required>
                        </div>
                        
                        <div class="form-group">
                            <label class="form-label" for="booking-time">Jam Mulai</label>
                            <input type="time" name="jam_mulai" id="booking-time" class="form-control" required style="background: rgba(255,255,255,0.05); color: #fff; border: 1px solid rgba(255,255,255,0.1); padding: 10px; border-radius: 6px;">
                        </div>
                        
                        <div class="form-group">
                            <label class="form-label" for="booking-duration">Durasi Main</label>
                            <select name="durasi" id="booking-duration" class="form-control" required>
                                <option value="1">1 Jam</option>
                                <option value="2">2 Jam</option>
                                <option value="3">3 Jam</option>
                            </select>
                        </div>
                        
                        <div class="checkout-row">
                            <span>Harga per jam</span>
                            <strong>Rp <?= number_format($data['lapangan']['harga_per_jam'], 0, ',', '.'); ?></strong>
                        </div>
                        
                        <div style="margin-top: 15px; border-top: 1px dashed rgba(255,255,255,0.1); padding-top: 15px; color: var(--text-muted); font-size: 0.8rem;">
                            * Total harga sewa akan dihitung otomatis sesuai durasi sewa Anda.
                        </div>
                        
                        <button type="submit" class="btn-primary btn-auth" id="btn-bayar-sekarang" style="margin-top: 20px;">
                            <i class="fas fa-check-circle"></i> Pesan Sekarang
                        </button>
                    </form>
                </aside>


            </div>
        </main>
    </div>
</body>
</html>
