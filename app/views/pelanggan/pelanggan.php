<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Pelanggan - Lifesports</title>
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
                <li><a href="<?= BASEURL; ?>/pelanggan" class="active"><i class="fas fa-home"></i> Dashboard</a></li>
                <li><a href="<?= BASEURL; ?>/pelanggan/booking"><i class="fas fa-calendar-check"></i> Riwayat Booking</a></li>
                <li><a href="<?= BASEURL; ?>/pelanggan/profile"><i class="fas fa-user"></i> Profile Saya</a></li>
                <li><a href="<?= BASEURL; ?>/pelanggan/lapangan"><i class="fas fa-search"></i> Cari Lapangan</a></li>
                <li><a href="<?= BASEURL; ?>/auth/login" class="nav-danger"><i class="fas fa-sign-out-alt"></i> Keluar</a></li>
            </ul>
        </aside>

        <main class="main-content">

            <header class="dashboard-header">
                <div class="dash-title">
                    <h1>Dashboard</h1>
                    <p>Selamat datang, <strong>Deni Ramdani</strong></p>
                </div>

                <div class="dash-profile">
                    <div class="profile-info">
                        <div class="profile-name">Deni Ramdani</div>
                        <div class="profile-role">Pelanggan</div>
                    </div>
                    <div class="profile-img">
                        <i class="fas fa-user"></i>
                    </div>
                </div>
            </header>

            <div class="dash-stats">
                <div class="dash-card">
                    <div class="dash-card-icon"><i class="fas fa-calendar-check"></i></div>
                    <div class="dash-card-info">
                        <h3>Total Booking</h3>
                        <div class="value">12</div>
                    </div>
                </div>
                <div class="dash-card">
                    <div class="dash-card-icon warning"><i class="fas fa-clock"></i></div>
                    <div class="dash-card-info">
                        <h3>Menunggu Konfirmasi</h3>
                        <div class="value value-warning">1</div>
                    </div>
                </div>
                <div class="dash-card">
                    <div class="dash-card-icon"><i class="fas fa-check-circle"></i></div>
                    <div class="dash-card-info">
                        <h3>Selesai</h3>
                        <div class="value">10</div>
                    </div>
                </div>
                <div class="dash-card">
                    <div class="dash-card-icon"><i class="fas fa-wallet"></i></div>
                    <div class="dash-card-info">
                        <h3>Total Belanja</h3>
                        <div class="value value-compact">Rp 1.850.000</div>
                    </div>
                </div>
            </div>

            <div class="table-container panel-reset active-booking-shell" id="booking-aktif">
                <div class="table-header active-booking-header">
                    <h2 class="table-title"><i class="fas fa-clock"></i>Booking Aktif</h2>
                    <button class="btn-primary compact-button">Lihat Semua</button>
                </div>

                <div class="active-booking-grid">

                    <div class="mini-booking-card">
                        <img src="<?= BASEURL; ?>/public/assets/img/bola.png" alt="Futsal">
                        <div class="mini-card-body">
                            <h4>Gelora Bung Karno Arena</h4>
                            <span class="sport-chip info">Futsal</span>
                            <p><i class="fas fa-calendar-alt"></i> 30 Apr 2026</p>
                            <p><i class="fas fa-clock"></i> 20:00 - 22:00</p>

                            <div class="mini-card-actions">
                                <span class="status-badge status-warning">Pending</span>
                                <button class="btn-primary compact-button ghost-gold"><i class="fas fa-eye"></i> Detail</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="section-grid main-aside" id="riwayat-booking">

                <div class="table-container">
                    <div class="table-header">
                        <h2 class="table-title"><i class="fas fa-history"></i>Riwayat Booking Terbaru</h2>
                        <a href="<?= BASEURL; ?>/pelanggan/booking" class="btn-primary compact-button">Lihat Semua</a>
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
                                <td><strong>BKG20260420123</strong></td>
                                <td>Gelora Bung Karno<br><small>Jakarta Pusat</small></td>
                                <td>20 Apr 2026</td>
                                <td>Rp 350.000</td>
                                <td><span class="status-badge status-success">Selesai</span></td>
                                <td>
                                    <button class="btn-action"><i class="fas fa-eye"></i></button>
                                    <button class="btn-action warning"><i class="fas fa-star"></i></button>
                                </td>
                            </tr>
                            <tr>
                                <td><strong>BKG20260415456</strong></td>
                                <td>Cilandak Sport<br><small>Jakarta Selatan</small></td>
                                <td>15 Apr 2026</td>
                                <td>Rp 150.000</td>
                                <td><span class="status-badge status-success">Selesai</span></td>
                                <td>
                                    <button class="btn-action"><i class="fas fa-eye"></i></button>
                                </td>
                            </tr>
                            <tr>
                                <td><strong>BKG20260410789</strong></td>
                                <td>Taufik Hidayat Arena<br><small>Jakarta Timur</small></td>
                                <td>10 Apr 2026</td>
                                <td>Rp 100.000</td>
                                <td><span class="status-badge status-danger">Dibatalkan</span></td>
                                <td>
                                    <button class="btn-action"><i class="fas fa-eye"></i></button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <div class="table-container">
                    <div class="table-header">
                        <h2 class="table-title"><i class="fas fa-heart icon-danger"></i>Favorit Saya</h2>
                    </div>

                    <div class="stack">

                        <div class="favorite-item">
                            <h4>Gelora Bung Karno</h4>
                            <span class="sport-chip info">Futsal</span>
                            <p>
                                <i class="fas fa-map-marker-alt"></i> Jakarta Pusat<br>
                                <i class="fas fa-calendar-check"></i> 8x booking
                            </p>
                            <button class="btn-primary compact-button"><i class="fas fa-eye"></i> Lihat</button>
                        </div>

                        <div class="favorite-item">
                            <h4>Cilandak Sport</h4>
                            <span class="sport-chip success">Tennis</span>
                            <p>
                                <i class="fas fa-map-marker-alt"></i> Jakarta Selatan<br>
                                <i class="fas fa-calendar-check"></i> 4x booking
                            </p>
                            <button class="btn-primary compact-button"><i class="fas fa-eye"></i> Lihat</button>
                        </div>
                    </div>
                </div>

            </div>

            <div class="table-container panel-reset quick-actions" id="profil-pelanggan">
                <h3><i class="fas fa-bolt"></i> Aksi Cepat</h3>
                <div class="quick-actions-grid">
                    <a href="<?= BASEURL; ?>/pelanggan/lapangan" class="btn-primary"><i class="fas fa-search"></i> Cari Lapangan</a>
                    <a href="<?= BASEURL; ?>/pelanggan/booking" class="btn-primary ghost-gold"><i class="fas fa-calendar-check"></i> Riwayat Booking</a>
                    <a href="<?= BASEURL; ?>/pelanggan/profile" class="btn-primary ghost-light"><i class="fas fa-user"></i> Edit Profile</a>
                    <a href="#booking-aktif" class="btn-primary ghost-warning"><i class="fas fa-clock"></i> Booking Pending</a>
                </div>
            </div>

        </main>
    </div>

</body>
</html>
