<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Semua Pembayaran - Admin Lifesports</title>
    <link rel="stylesheet" href="<?= BASEURL; ?>/public/assets/css/styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>
    <div class="dashboard-container">
        <aside class="sidebar">
            <div class="sidebar-header">
                <div class="sidebar-brand">Lifesports</div>
                <div class="role-label">SUPER ADMIN</div>
            </div>
            <ul class="sidebar-menu">
                <li><a href="<?= BASEURL; ?>/admin"><i class="fas fa-home"></i> Dashboard</a></li>
                <li><a href="<?= BASEURL; ?>/admin/users"><i class="fas fa-users"></i> Kelola User</a></li>
                <li><a href="<?= BASEURL; ?>/admin/kategori"><i class="fas fa-tags"></i> Kategori</a></li>
                <li><a href="<?= BASEURL; ?>/admin/lapangan"><i class="fas fa-building"></i> Semua Lapangan</a></li>
                <li><a href="<?= BASEURL; ?>/admin/booking"><i class="fas fa-calendar-check"></i> Semua Booking</a></li>
                <li><a href="<?= BASEURL; ?>/admin/pembayaran" class="active"><i class="fas fa-credit-card"></i> Semua Pembayaran</a></li>
                <li><a href="<?= BASEURL; ?>/admin/laporan"><i class="fas fa-file-invoice"></i> Laporan</a></li>
                <li><a href="<?= BASEURL; ?>/auth/logout" class="nav-danger"><i class="fas fa-sign-out-alt"></i> Keluar</a></li>
            </ul>
        </aside>

        <main class="main-content">
            <header class="dashboard-header">
                <div class="dash-title">
                    <h1>Monitoring Pembayaran</h1>
                    <p>Status semua transaksi pembayaran di seluruh sistem</p>
                </div>
            </header>

            <div class="dash-stats">
                <div class="dash-card">
                    <div class="dash-card-icon"><i class="fas fa-wallet"></i></div>
                    <div class="dash-card-info">
                        <h3>Total Pendapatan</h3>
                        <div class="value value-compact">Rp 64M</div>
                        <small>Bulan ini</small>
                    </div>
                </div>
                <div class="dash-card">
                    <div class="dash-card-icon"><i class="fas fa-check-circle"></i></div>
                    <div class="dash-card-info">
                        <h3>Lunas</h3>
                        <div class="value">410</div>
                    </div>
                </div>
                <div class="dash-card">
                    <div class="dash-card-icon warning"><i class="fas fa-clock"></i></div>
                    <div class="dash-card-info">
                        <h3>Pending</h3>
                        <div class="value value-warning">30</div>
                    </div>
                </div>
                <div class="dash-card">
                    <div class="dash-card-icon"><i class="fas fa-times-circle"></i></div>
                    <div class="dash-card-info">
                        <h3>Gagal</h3>
                        <div class="value">10</div>
                    </div>
                </div>
            </div>

            <section class="table-container">
                <div class="table-header">
                    <h2 class="table-title"><i class="fas fa-list"></i> Riwayat Transaksi</h2>
                </div>
                <div class="filter-bar compact">
                    <input class="form-control" id="input-search-pembayaran" placeholder="Cari no. transaksi atau pelanggan...">
                    <select class="form-control" id="select-status-pembayaran">
                        <option>Semua Status</option>
                        <option>Lunas</option>
                        <option>Pending</option>
                        <option>Gagal</option>
                    </select>
                    <select class="form-control" id="select-metode-pembayaran">
                        <option>Semua Metode</option>
                        <option>Virtual Account</option>
                        <option>Dompet Digital</option>
                        <option>Kartu Debit/Kredit</option>
                    </select>
                    <input class="form-control" id="input-tgl-pembayaran" type="date">
                    <button class="btn-primary compact-button" id="btn-filter-pembayaran"><i class="fas fa-filter"></i> Filter</button>
                </div>
                <table class="data-table">
                    <thead>
                        <tr>
                            <th>No. Transaksi</th>
                            <th>Kode Booking</th>
                            <th>Pelanggan</th>
                            <th>Metode</th>
                            <th>Total</th>
                            <th>Tanggal</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><strong>TRX-202604250022</strong></td>
                            <td>BKG2026042812345</td>
                            <td>Andi Saputra</td>
                            <td>VA BCA</td>
                            <td>Rp 700.000</td>
                            <td>25 Apr 2026</td>
                            <td><span class="status-badge status-success">Lunas</span></td>
                        </tr>
                        <tr>
                            <td><strong>TRX-202604290014</strong></td>
                            <td>BKG2026042898765</td>
                            <td>Budi Santoso</td>
                            <td>GoPay</td>
                            <td>Rp 300.000</td>
                            <td>29 Apr 2026</td>
                            <td><span class="status-badge status-warning">Pending</span></td>
                        </tr>
                        <tr>
                            <td><strong>TRX-202604290031</strong></td>
                            <td>BKG2026042854321</td>
                            <td>Citra Lestari</td>
                            <td>VA Mandiri</td>
                            <td>Rp 200.000</td>
                            <td>29 Apr 2026</td>
                            <td><span class="status-badge status-success">Lunas</span></td>
                        </tr>
                        <tr>
                            <td><strong>TRX-202604300018</strong></td>
                            <td>BKG2026042867890</td>
                            <td>Deni Ramdani</td>
                            <td>Kartu Kredit</td>
                            <td>Rp 700.000</td>
                            <td>30 Apr 2026</td>
                            <td><span class="status-badge status-danger">Gagal</span></td>
                        </tr>
                    </tbody>
                </table>
            </section>
        </main>
    </div>
</body>
</html>
