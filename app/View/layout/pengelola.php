<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= isset($judul) ? $judul . ' - Lifesports' : 'Dashboard Pengelola'; ?></title>
    <link rel="stylesheet" href="<?= BASEURL; ?>/assets/css/styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>
    <div class="dashboard-container">
        <aside class="sidebar">
            <div class="sidebar-header">
                <div class="sidebar-brand">Lifesports</div>
                <div class="role-label">MITRA</div>
            </div>
            <ul class="sidebar-menu">
                <li><a href="<?= BASEURL; ?>/pengelola" class="<?= strpos($_SERVER['REQUEST_URI'], '/pengelola') !== false && !strpos($_SERVER['REQUEST_URI'], '/lapangan') && !strpos($_SERVER['REQUEST_URI'], '/booking') && !strpos($_SERVER['REQUEST_URI'], '/pembayaran') && !strpos($_SERVER['REQUEST_URI'], '/laporan') && !strpos($_SERVER['REQUEST_URI'], '/profile') ? 'active' : ''; ?>"><i class="fas fa-home"></i> Dashboard</a></li>
                <li><a href="<?= BASEURL; ?>/pengelola/lapangan" class="<?= strpos($_SERVER['REQUEST_URI'], '/pengelola/lapangan') !== false ? 'active' : ''; ?>"><i class="fas fa-building"></i> Kelola Lapangan</a></li>
                <li><a href="<?= BASEURL; ?>/pengelola/booking" class="<?= strpos($_SERVER['REQUEST_URI'], '/pengelola/booking') !== false ? 'active' : ''; ?>"><i class="fas fa-calendar-check"></i> Pesanan</a></li>
                <li><a href="<?= BASEURL; ?>/pengelola/pembayaran" class="<?= strpos($_SERVER['REQUEST_URI'], '/pengelola/pembayaran') !== false ? 'active' : ''; ?>"><i class="fas fa-wallet"></i> Transaksi</a></li>
                <li><a href="<?= BASEURL; ?>/pengelola/laporan" class="<?= strpos($_SERVER['REQUEST_URI'], '/pengelola/laporan') !== false ? 'active' : ''; ?>"><i class="fas fa-chart-line"></i> Laporan Keuangan</a></li>
                <li><a href="<?= BASEURL; ?>/pengelola/profile" class="<?= strpos($_SERVER['REQUEST_URI'], '/pengelola/profile') !== false ? 'active' : ''; ?>"><i class="fas fa-user-tie"></i> Profil Pengelola</a></li>
                <li><a href="<?= BASEURL; ?>/logout" class="nav-danger"><i class="fas fa-sign-out-alt"></i> Keluar</a></li>
            </ul>
        </aside>

        <main class="main-content">
            <header class="dashboard-header">
                <div class="dash-title">
                    <h1><?= isset($judul) ? $judul : 'Dashboard'; ?></h1>
                    <?php if (strpos($_SERVER['REQUEST_URI'], '/pengelola') !== false && !strpos($_SERVER['REQUEST_URI'], '/lapangan') && !strpos($_SERVER['REQUEST_URI'], '/booking') && !strpos($_SERVER['REQUEST_URI'], '/pembayaran') && !strpos($_SERVER['REQUEST_URI'], '/laporan') && !strpos($_SERVER['REQUEST_URI'], '/profile')): ?>
                        <p>Selamat datang, <strong><?= htmlspecialchars($_SESSION['nama']); ?></strong></p>
                    <?php endif; ?>
                </div>

                <div class="dash-profile">
                    <div class="profile-info">
                        <div class="profile-name"><?= htmlspecialchars($_SESSION['nama']); ?></div>
                        <div class="profile-role">Pengelola</div>
                    </div>
                    <div class="profile-img">
                        <i class="fas fa-user-tie"></i>
                    </div>
                </div>
            </header>

            <?php \App\Core\Flasher::flash(); ?>

            <?= $content; ?>
        </main>
    </div>
</body>
</html>
