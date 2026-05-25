<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Pengelola - Lifesports</title>
    <link rel="stylesheet" href="<?= BASEURL; ?>/public/assets/css/styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>

    <div class="dashboard-container">

        <aside class="sidebar">
            <div class="sidebar-header">
                <div class="sidebar-brand">Lifesports</div>
                <div class="role-label">PENGELOLA</div>
            </div>

            <ul class="sidebar-menu">
                <li><a href="<?= BASEURL; ?>/pengelola" class="active"><i class="fas fa-home"></i> Dashboard</a></li>
                <li><a href="<?= BASEURL; ?>/pengelola/lapangan"><i class="fas fa-building"></i> Lapangan Saya</a></li>
                <li><a href="<?= BASEURL; ?>/pengelola/booking"><i class="fas fa-calendar-check"></i> Booking Masuk</a></li>
                <li><a href="<?= BASEURL; ?>/pengelola/pembayaran"><i class="fas fa-credit-card"></i> Pembayaran</a></li>
                <li><a href="<?= BASEURL; ?>/pengelola/laporan"><i class="fas fa-file-invoice"></i> Laporan</a></li>
                <li><a href="<?= BASEURL; ?>/auth/login" class="nav-danger"><i class="fas fa-sign-out-alt"></i> Keluar</a></li>
            </ul>
        </aside>

        <main class="main-content">

            <header class="dashboard-header">
                <div class="dash-title">
                    <h1>Sistem Pengelola</h1>
                    <p>Sistem Manajemen Akses - <strong>Bpk. Sudirman</strong></p>
                </div>

                <div class="dash-profile">
                    <div class="profile-info">
                        <div class="profile-name">Bpk. Sudirman</div>
                        <div class="profile-role">Mitra Pengelola</div>
                    </div>
                    <div class="profile-img">
                        <i class="fas fa-user-tie"></i>
                    </div>
                </div>
            </header>

            <div class="alert warning">
                <div>
                    <i class="fas fa-exclamation-triangle"></i>
                    <strong>Peringatan Sistem:</strong> Terdapat 5 reservasi yang memerlukan verifikasi.
                </div>
                <a href="#booking-pending">Tinjau Reservasi</a>
            </div>

            <div class="dash-stats">
                <div class="dash-card">
                    <div class="dash-card-icon"><i class="fas fa-building"></i></div>
                    <div class="dash-card-info">
                        <h3>Total Lapangan</h3>
                        <div class="value">3</div>
                        <small>Tersedia: 3</small>
                    </div>
                </div>
                <div class="dash-card">
                    <div class="dash-card-icon warning"><i class="fas fa-clock"></i></div>
                    <div class="dash-card-info">
                        <h3>Booking Pending</h3>
                        <div class="value value-warning">5</div>
                        <small>Perlu konfirmasi</small>
                    </div>
                </div>
                <div class="dash-card">
                    <div class="dash-card-icon"><i class="fas fa-calendar-check"></i></div>
                    <div class="dash-card-info">
                        <h3>Total Booking</h3>
                        <div class="value">45</div>
                        <small>Selesai: 32</small>
                    </div>
                </div>
                <div class="dash-card">
                    <div class="dash-card-icon"><i class="fas fa-wallet"></i></div>
                    <div class="dash-card-info">
                        <h3>Pendapatan Bulan Ini</h3>
                        <div class="value value-compact">Rp 4.500.000</div>
                    </div>
                </div>
            </div>

            <div class="section-grid two-col" id="booking-pending">

                <div class="table-container">
                    <div class="table-header">
                        <h2 class="table-title"><i class="fas fa-clock icon-warning"></i>Booking Pending</h2>
                        <button class="btn-primary compact-button">Lihat Semua</button>
                    </div>

                    <div class="stack">

                        <div class="list-row">
                            <div>
                                <h4>BKG2026042812345</h4>
                                <p>Gelora Bung Karno (Futsal)</p>
                                <small>Andi Saputra - 28 Apr 2026 - 19:00-21:00</small>
                            </div>
                            <button class="btn-primary compact-button ghost-warning"><i class="fas fa-check-circle"></i> Konfirmasi</button>
                        </div>

                        <div class="list-row">
                            <div>
                                <h4>BKG2026042812346</h4>
                                <p>Cilandak Sport (Tennis)</p>
                                <small>Budi Santoso - 29 Apr 2026 - 08:00-10:00</small>
                            </div>
                            <button class="btn-primary compact-button ghost-warning"><i class="fas fa-check-circle"></i> Konfirmasi</button>
                        </div>
                    </div>
                </div>

                <div class="table-container">
                    <div class="table-header">
                        <h2 class="table-title"><i class="fas fa-calendar-day icon-info"></i>Booking Hari Ini</h2>
                    </div>

                    <div class="stack">

                        <div class="list-row">
                            <div>
                                <p>Gelora Bung Karno (Futsal)</p>
                                <small>Andi Saputra - 19:00 - 21:00 (2 jam)</small>
                            </div>
                            <span class="status-badge status-success">Selesai</span>
                        </div>

                        <div class="list-row">
                            <div>
                                <p>Taufik Hidayat Arena</p>
                                <small>Citra Lestari - 15:00 - 17:00 (2 jam)</small>
                            </div>
                            <span class="status-badge status-info">Confirmed</span>
                        </div>
                    </div>
                </div>

            </div>

            <div class="table-container" id="lapangan-populer">
                <div class="table-header">
                    <h2 class="table-title"><i class="fas fa-trophy"></i>Lapangan Paling Populer</h2>
                </div>

                <table class="data-table">
                    <thead>
                        <tr>
                            <th>Nama Lapangan</th>
                            <th>Kota</th>
                            <th>Harga/Jam</th>
                            <th>Rating</th>
                            <th>Total Booking</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><strong>Gelora Bung Karno Arena</strong></td>
                            <td>Jakarta Pusat</td>
                            <td>Rp 350.000</td>
                            <td><i class="fas fa-star"></i> 4.9</td>
                            <td>42x</td>
                            <td><span class="status-badge status-success">Tersedia</span></td>
                        </tr>
                        <tr>
                            <td><strong>Cilandak Sport Center</strong></td>
                            <td>Jakarta Selatan</td>
                            <td>Rp 150.000</td>
                            <td><i class="fas fa-star"></i> 4.8</td>
                            <td>38x</td>
                            <td><span class="status-badge status-success">Tersedia</span></td>
                        </tr>
                        <tr>
                            <td><strong>Taufik Hidayat Arena</strong></td>
                            <td>Jakarta Timur</td>
                            <td>Rp 100.000</td>
                            <td><i class="fas fa-star"></i> 4.9</td>
                            <td>31x</td>
                            <td><span class="status-badge status-warning">Maintenance</span></td>
                        </tr>
                    </tbody>
                </table>
            </div>

        </main>
    </div>

</body>
</html>
