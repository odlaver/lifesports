<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Pengelola - Lifesports</title>
    <link rel="stylesheet" href="<?= BASEURL; ?>/public/assets/css/styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>
    <div class="dashboard-container">
        <aside class="sidebar">
            <div class="sidebar-header"><div class="sidebar-brand">Lifesports</div><div class="role-label">PENGELOLA</div></div>
            <ul class="sidebar-menu">
                <li><a href="<?= BASEURL; ?>/pengelola"><i class="fas fa-home"></i> Dashboard</a></li>
                <li><a href="<?= BASEURL; ?>/pengelola/lapangan"><i class="fas fa-building"></i> Lapangan Saya</a></li>
                <li><a href="<?= BASEURL; ?>/pengelola/booking"><i class="fas fa-calendar-check"></i> Booking Masuk</a></li>
                <li><a href="<?= BASEURL; ?>/pengelola/pembayaran"><i class="fas fa-credit-card"></i> Pembayaran</a></li>
                <li><a href="<?= BASEURL; ?>/pengelola/laporan" class="active"><i class="fas fa-file-invoice"></i> Laporan</a></li>
                <li><a href="<?= BASEURL; ?>/auth/login" class="nav-danger"><i class="fas fa-sign-out-alt"></i> Keluar</a></li>
            </ul>
        </aside>
        <main class="main-content">
            <header class="dashboard-header"><div class="dash-title"><h1>Laporan</h1><p>Ringkasan pendapatan, booking, dan lapangan populer.</p></div><button class="btn-primary"><i class="fas fa-download"></i> Export</button></header>
            <div class="metric-grid">
                <div class="metric-box"><span>Pendapatan</span><strong>Rp 4.500.000</strong></div>
                <div class="metric-box"><span>Total Booking</span><strong>45</strong></div>
                <div class="metric-box"><span>Lapangan Terpopuler</span><strong>GBK Arena</strong></div>
            </div>
            <section class="table-container">
                <table class="data-table">
                    <thead><tr><th>Bulan</th><th>Booking</th><th>Pendapatan</th><th>Rating</th></tr></thead>
                    <tbody>
                        <tr><td>Mei 2026</td><td>45</td><td>Rp 4.500.000</td><td>4.9</td></tr>
                        <tr><td>April 2026</td><td>38</td><td>Rp 3.900.000</td><td>4.8</td></tr>
                    </tbody>
                </table>
            </section>
        </main>
    </div>
</body>
</html>
