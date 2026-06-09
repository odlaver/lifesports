<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= isset($judul) ? $judul . ' - Lifesports' : 'Lifesports'; ?></title>
    <link rel="stylesheet" href="<?= BASEURL; ?>/assets/css/styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>
    <div class="watermark">LIFESPORTS</div>
    
    <header class="navbar">
        <a href="<?= BASEURL; ?>" class="nav-brand">
            <div class="brand-icon">
                <i class="fas fa-trophy"></i>
            </div>
            Lifesports
        </a>
        <ul class="nav-links">
            <li><a href="<?= BASEURL; ?>">Beranda</a></li>
            <li><a href="<?= BASEURL; ?>/lapangan">Lapangan</a></li>
            <li><a href="<?= BASEURL; ?>#cara-booking">Cara Booking</a></li>
            <li><a href="<?= BASEURL; ?>#kontak">Kontak</a></li>
        </ul>
        <div class="nav-actions">
            <?php if (isset($_SESSION['user_id'])): ?>
                <?php 
                    $dashUrl = BASEURL . '/login';
                    if ($_SESSION['role'] === 'pelanggan') $dashUrl = BASEURL . '/pelanggan';
                    elseif ($_SESSION['role'] === 'pengelola') $dashUrl = BASEURL . '/pengelola';
                    elseif ($_SESSION['role'] === 'admin') $dashUrl = BASEURL . '/admin';
                ?>
                <a href="<?= $dashUrl; ?>" class="btn-nav">
                    <i class="fas fa-user-circle"></i> Dashboard
                </a>
            <?php else: ?>
                <a href="<?= BASEURL; ?>/login" class="btn-nav">
                    <i class="fas fa-sign-in-alt"></i> Masuk
                </a>
                <a href="<?= BASEURL; ?>/register" class="btn-nav">
                    <i class="fas fa-user"></i> Daftar
                </a>
            <?php endif; ?>
        </div>
    </header>

    <?= $content; ?>

    <footer class="footer" id="kontak">
        <div class="container">
            <div class="footer-content">
                <div>
                    <div class="footer-brand">Lifesports</div>
                    <p class="footer-desc">Platform penyewaan fasilitas olahraga terpadu dengan standar pelayanan tingkat tinggi.</p>
                </div>
                <div>
                    <h4>Tautan Cepat</h4>
                    <ul>
                        <li><a href="<?= BASEURL; ?>">Beranda</a></li>
                        <li><a href="<?= BASEURL; ?>/lapangan">Daftar Lapangan</a></li>
                        <li><a href="#cara-booking">Cara Booking</a></li>
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
                &copy; <?= date('Y'); ?> Lifesports Premium Club. Bandar Lampung.
            </div>
        </div>
    </footer>
</body>
</html>
