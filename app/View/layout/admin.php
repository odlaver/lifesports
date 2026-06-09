<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= isset($judul) ? $judul . ' - Lifesports' : 'Dashboard Admin'; ?></title>
    <link rel="stylesheet" href="<?= BASEURL; ?>/assets/css/styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>
    <div class="dashboard-container">
        <aside class="sidebar">
            <div class="sidebar-header">
                <div class="sidebar-brand">Lifesports</div>
                <div class="role-label" style="background: var(--primary-color);">ADMINISTRATOR</div>
            </div>
            <ul class="sidebar-menu">
                <li><a href="<?= BASEURL; ?>/admin" class="<?= strpos($_SERVER['REQUEST_URI'], '/admin') !== false && !strpos($_SERVER['REQUEST_URI'], '/user') && !strpos($_SERVER['REQUEST_URI'], '/kategori') && !strpos($_SERVER['REQUEST_URI'], '/lapangan') && !strpos($_SERVER['REQUEST_URI'], '/booking') && !strpos($_SERVER['REQUEST_URI'], '/pembayaran') && !strpos($_SERVER['REQUEST_URI'], '/laporan') ? 'active' : ''; ?>"><i class="fas fa-home"></i> Dashboard</a></li>
                <li><a href="<?= BASEURL; ?>/admin/user" class="<?= strpos($_SERVER['REQUEST_URI'], '/admin/user') !== false ? 'active' : ''; ?>"><i class="fas fa-users"></i> Kelola Pengguna</a></li>
                <li><a href="<?= BASEURL; ?>/admin/kategori" class="<?= strpos($_SERVER['REQUEST_URI'], '/admin/kategori') !== false ? 'active' : ''; ?>"><i class="fas fa-tags"></i> Kategori Lapangan</a></li>
                <li><a href="<?= BASEURL; ?>/admin/lapangan" class="<?= strpos($_SERVER['REQUEST_URI'], '/admin/lapangan') !== false ? 'active' : ''; ?>"><i class="fas fa-building"></i> Kelola Lapangan</a></li>
                <li><a href="<?= BASEURL; ?>/admin/booking" class="<?= strpos($_SERVER['REQUEST_URI'], '/admin/booking') !== false ? 'active' : ''; ?>"><i class="fas fa-calendar-alt"></i> Semua Booking</a></li>
                <li><a href="<?= BASEURL; ?>/admin/pembayaran" class="<?= strpos($_SERVER['REQUEST_URI'], '/admin/pembayaran') !== false ? 'active' : ''; ?>"><i class="fas fa-money-bill-wave"></i> Transaksi</a></li>
                <li><a href="<?= BASEURL; ?>/admin/laporan" class="<?= strpos($_SERVER['REQUEST_URI'], '/admin/laporan') !== false ? 'active' : ''; ?>"><i class="fas fa-chart-bar"></i> Laporan Sistem</a></li>
                <li><a href="<?= BASEURL; ?>/logout" class="nav-danger"><i class="fas fa-sign-out-alt"></i> Keluar</a></li>
            </ul>
        </aside>

        <main class="main-content">
            <header class="dashboard-header">
                <div class="dash-title">
                    <h1><?= isset($judul) ? $judul : 'Dashboard'; ?></h1>
                </div>

                <div class="dash-profile">
                    <div class="profile-info">
                        <div class="profile-name"><?= htmlspecialchars($_SESSION['nama']); ?></div>
                        <div class="profile-role">Administrator</div>
                    </div>
                    <div class="profile-img">
                        <i class="fas fa-user-shield"></i>
                    </div>
                </div>
            </header>

            <?php \App\Core\Flasher::flash(); ?>

            <?= $content; ?>
        </main>
    </div>
</body>
</html>
