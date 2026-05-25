<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verifikasi Pembayaran - Lifesports</title>
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
                <li><a href="<?= BASEURL; ?>/pengelola/pembayaran" class="active"><i class="fas fa-credit-card"></i> Pembayaran</a></li>
                <li><a href="<?= BASEURL; ?>/pengelola/laporan"><i class="fas fa-file-invoice"></i> Laporan</a></li>
                <li><a href="<?= BASEURL; ?>/auth/login" class="nav-danger"><i class="fas fa-sign-out-alt"></i> Keluar</a></li>
            </ul>
        </aside>
        <main class="main-content">
            <header class="dashboard-header"><div class="dash-title"><h1>Verifikasi Pembayaran</h1><p>Cek bukti transfer dan status transaksi pelanggan.</p></div></header>
            <section class="table-container">
                <table class="data-table">
                    <thead><tr><th>Kode</th><th>Pelanggan</th><th>Nominal</th><th>Metode</th><th>Status</th><th>Aksi</th></tr></thead>
                    <tbody>
                        <tr><td><strong>PAY20260511001</strong></td><td>Deni Ramdani</td><td>Rp 355.000</td><td>Virtual Account</td><td><span class="status-badge status-warning">Pending</span></td><td><button class="btn-action"><i class="fas fa-check"></i></button></td></tr>
                        <tr><td><strong>PAY20260510007</strong></td><td>Citra Lestari</td><td>Rp 300.000</td><td>Transfer Bank</td><td><span class="status-badge status-success">Lunas</span></td><td><button class="btn-action"><i class="fas fa-eye"></i></button></td></tr>
                    </tbody>
                </table>
            </section>
        </main>
    </div>
</body>
</html>
