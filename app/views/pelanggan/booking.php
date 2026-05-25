<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Riwayat Booking - Lifesports</title>
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
                <li><a href="<?= BASEURL; ?>/pelanggan/booking" class="active"><i class="fas fa-calendar-check"></i> Riwayat Booking</a></li>
                <li><a href="<?= BASEURL; ?>/pelanggan/profile"><i class="fas fa-user"></i> Profile Saya</a></li>
                <li><a href="<?= BASEURL; ?>/pelanggan/lapangan"><i class="fas fa-search"></i> Cari Lapangan</a></li>
                <li><a href="<?= BASEURL; ?>/auth/login" class="nav-danger"><i class="fas fa-sign-out-alt"></i> Keluar</a></li>
            </ul>
        </aside>

        <main class="main-content">
            <header class="dashboard-header">
                <div class="dash-title">
                    <h1>Riwayat Booking</h1>
                    <p>Pantau jadwal main, pembayaran, dan review dari satu tempat.</p>
                </div>
                <a href="<?= BASEURL; ?>/pelanggan/lapangan" class="btn-primary"><i class="fas fa-plus"></i> Booking Baru</a>
            </header>

            <div class="dash-stats">
                <div class="dash-card">
                    <div class="dash-card-icon"><i class="fas fa-calendar"></i></div>
                    <div class="dash-card-info"><h3>Total Booking</h3><div class="value">12</div></div>
                </div>
                <div class="dash-card">
                    <div class="dash-card-icon warning"><i class="fas fa-clock"></i></div>
                    <div class="dash-card-info"><h3>Pending</h3><div class="value value-warning">1</div></div>
                </div>
                <div class="dash-card">
                    <div class="dash-card-icon"><i class="fas fa-check-circle"></i></div>
                    <div class="dash-card-info"><h3>Selesai</h3><div class="value">10</div></div>
                </div>
                <div class="dash-card">
                    <div class="dash-card-icon"><i class="fas fa-star"></i></div>
                    <div class="dash-card-info"><h3>Review</h3><div class="value">8</div></div>
                </div>
            </div>

            <section class="table-container">
                <div class="filter-bar compact">
                    <input class="form-control" type="text" placeholder="Cari kode booking atau lapangan">
                    <select class="form-control">
                        <option>Semua Status</option>
                        <option>Pending</option>
                        <option>Confirmed</option>
                        <option>Selesai</option>
                        <option>Dibatalkan</option>
                    </select>
                    <input class="form-control" type="date">
                    <button class="btn-primary compact-button"><i class="fas fa-filter"></i> Filter</button>
                </div>

                <table class="data-table">
                    <thead>
                        <tr>
                            <th>Kode</th>
                            <th>Lapangan</th>
                            <th>Tanggal</th>
                            <th>Total</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><strong>BKG20260511001</strong></td>
                            <td>Gelora Bung Karno Arena<br><small>Futsal - Jakarta Pusat</small></td>
                            <td>11 Mei 2026<br><small>09:00 - 10:00</small></td>
                            <td>Rp 355.000</td>
                            <td><span class="status-badge status-info">Confirmed</span></td>
                            <td><a href="<?= BASEURL; ?>/pelanggan/booking_detail" class="btn-action"><i class="fas fa-eye"></i></a></td>
                        </tr>
                        <tr>
                            <td><strong>BKG20260420123</strong></td>
                            <td>Cilandak Sport Center<br><small>Tennis - Jakarta Selatan</small></td>
                            <td>20 Apr 2026<br><small>08:00 - 10:00</small></td>
                            <td>Rp 300.000</td>
                            <td><span class="status-badge status-success">Selesai</span></td>
                            <td><a href="<?= BASEURL; ?>/pelanggan/review" class="btn-action warning"><i class="fas fa-star"></i></a></td>
                        </tr>
                        <tr>
                            <td><strong>BKG20260410789</strong></td>
                            <td>Taufik Hidayat Arena<br><small>Badminton - Jakarta Timur</small></td>
                            <td>10 Apr 2026<br><small>15:00 - 17:00</small></td>
                            <td>Rp 200.000</td>
                            <td><span class="status-badge status-danger">Dibatalkan</span></td>
                            <td><a href="<?= BASEURL; ?>/pelanggan/booking_detail" class="btn-action"><i class="fas fa-eye"></i></a></td>
                        </tr>
                    </tbody>
                </table>
            </section>
        </main>
    </div>
</body>
</html>
