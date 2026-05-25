<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lapangan Saya - Lifesports</title>
    <link rel="stylesheet" href="<?= BASEURL; ?>/public/assets/css/styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>
    <div class="dashboard-container">
        <aside class="sidebar">
            <div class="sidebar-header"><div class="sidebar-brand">Lifesports</div><div class="role-label">PENGELOLA</div></div>
            <ul class="sidebar-menu">
                <li><a href="<?= BASEURL; ?>/pengelola"><i class="fas fa-home"></i> Dashboard</a></li>
                <li><a href="<?= BASEURL; ?>/pengelola/lapangan" class="active"><i class="fas fa-building"></i> Lapangan Saya</a></li>
                <li><a href="<?= BASEURL; ?>/pengelola/booking"><i class="fas fa-calendar-check"></i> Booking Masuk</a></li>
                <li><a href="<?= BASEURL; ?>/pengelola/pembayaran"><i class="fas fa-credit-card"></i> Pembayaran</a></li>
                <li><a href="<?= BASEURL; ?>/pengelola/laporan"><i class="fas fa-file-invoice"></i> Laporan</a></li>
                <li><a href="<?= BASEURL; ?>/auth/login" class="nav-danger"><i class="fas fa-sign-out-alt"></i> Keluar</a></li>
            </ul>
        </aside>
        <main class="main-content">
            <header class="dashboard-header">
                <div class="dash-title"><h1>Lapangan Saya</h1><p>Kelola status, harga, dan performa lapangan.</p></div>
                <a href="<?= BASEURL; ?>/pengelola/lapangan_form" class="btn-primary"><i class="fas fa-plus"></i> Tambah Lapangan</a>
            </header>
            <section class="table-container">
                <div class="filter-bar compact">
                    <input class="form-control" placeholder="Cari nama lapangan">
                    <select class="form-control"><option>Semua Status</option><option>Tersedia</option><option>Maintenance</option><option>Nonaktif</option></select>
                    <select class="form-control"><option>Semua Kategori</option><option>Futsal</option><option>Tennis</option><option>Badminton</option></select>
                    <button class="btn-primary compact-button"><i class="fas fa-filter"></i> Filter</button>
                </div>
                <table class="data-table">
                    <thead><tr><th>Lapangan</th><th>Kategori</th><th>Harga</th><th>Total Booking</th><th>Status</th><th>Aksi</th></tr></thead>
                    <tbody>
                        <tr><td><strong>Gelora Bung Karno Arena</strong><br><small>Senayan, Jakarta Pusat</small></td><td>Futsal</td><td>Rp 350.000/jam</td><td>42x</td><td><span class="status-badge status-success">Tersedia</span></td><td><a href="<?= BASEURL; ?>/pengelola/lapangan_form" class="btn-action"><i class="fas fa-pen"></i></a></td></tr>
                        <tr><td><strong>Cilandak Sport Center</strong><br><small>Cilandak, Jakarta Selatan</small></td><td>Tennis</td><td>Rp 150.000/jam</td><td>38x</td><td><span class="status-badge status-success">Tersedia</span></td><td><a href="<?= BASEURL; ?>/pengelola/lapangan_form" class="btn-action"><i class="fas fa-pen"></i></a></td></tr>
                        <tr><td><strong>Taufik Hidayat Arena</strong><br><small>Ciracas, Jakarta Timur</small></td><td>Badminton</td><td>Rp 100.000/jam</td><td>31x</td><td><span class="status-badge status-warning">Maintenance</span></td><td><a href="<?= BASEURL; ?>/pengelola/lapangan_form" class="btn-action"><i class="fas fa-pen"></i></a></td></tr>
                    </tbody>
                </table>
            </section>
        </main>
    </div>
</body>
</html>
