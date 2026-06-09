<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= isset($judul) ? $judul . ' - Lifesports' : 'Dashboard Pelanggan'; ?></title>
    <link rel="stylesheet" href="<?= BASEURL; ?>/assets/css/styles.css">
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
                <li><a href="<?= BASEURL; ?>/pelanggan" class="<?= strpos($_SERVER['REQUEST_URI'], '/pelanggan') !== false && !strpos($_SERVER['REQUEST_URI'], '/booking') && !strpos($_SERVER['REQUEST_URI'], '/lapangan') && !strpos($_SERVER['REQUEST_URI'], '/profile') ? 'active' : ''; ?>"><i class="fas fa-home"></i> Dashboard</a></li>
                <li><a href="<?= BASEURL; ?>/pelanggan/booking" class="<?= strpos($_SERVER['REQUEST_URI'], '/pelanggan/booking') !== false ? 'active' : ''; ?>"><i class="fas fa-calendar-check"></i> Riwayat Booking</a></li>
                <li><a href="<?= BASEURL; ?>/pelanggan/profile" class="<?= strpos($_SERVER['REQUEST_URI'], '/pelanggan/profile') !== false ? 'active' : ''; ?>"><i class="fas fa-user"></i> Profile Saya</a></li>
                <li><a href="<?= BASEURL; ?>/pelanggan/lapangan" class="<?= strpos($_SERVER['REQUEST_URI'], '/pelanggan/lapangan') !== false ? 'active' : ''; ?>"><i class="fas fa-search"></i> Cari Lapangan</a></li>
                <li><a href="<?= BASEURL; ?>/logout" class="nav-danger"><i class="fas fa-sign-out-alt"></i> Keluar</a></li>
            </ul>
        </aside>

        <main class="main-content">
            <header class="dashboard-header">
                <div class="dash-title">
                    <h1><?= isset($judul) ? $judul : 'Dashboard'; ?></h1>
                    <?php if (strpos($_SERVER['REQUEST_URI'], '/pelanggan') !== false && !strpos($_SERVER['REQUEST_URI'], '/booking') && !strpos($_SERVER['REQUEST_URI'], '/lapangan') && !strpos($_SERVER['REQUEST_URI'], '/profile')): ?>
                        <p>Selamat datang, <strong><?= htmlspecialchars($_SESSION['nama']); ?></strong></p>
                    <?php endif; ?>
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

            <?php \App\Core\Flasher::flash(); ?>

            <?= $content; ?>
        </main>
    </div>
</body>
</html>
