<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Lapangan - Lifesports</title>
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
                <li><a href="<?= BASEURL; ?>/pelanggan/booking"><i class="fas fa-calendar-check"></i> Riwayat Booking</a></li>
                <li><a href="<?= BASEURL; ?>/pelanggan/profile"><i class="fas fa-user"></i> Profile Saya</a></li>
                <li><a href="<?= BASEURL; ?>/pelanggan/lapangan" class="active"><i class="fas fa-search"></i> Cari Lapangan</a></li>
                <li><a href="<?= BASEURL; ?>/auth/login" class="nav-danger"><i class="fas fa-sign-out-alt"></i> Keluar</a></li>
            </ul>
        </aside>

        <main class="main-content">

            <header class="dashboard-header">
                <div class="dash-title">
                    <h1>Detail Lapangan</h1>
                    <p>Info lengkap, fasilitas, jadwal slot, dan review pelanggan</p>
                </div>
                <a href="<?= BASEURL; ?>/pelanggan/lapangan" class="btn-primary ghost-light" id="btn-back-lapangan">
                    <i class="fas fa-arrow-left"></i> Kembali
                </a>
            </header>

            <div class="booking-page-dashboard">

                <section class="table-container booking-detail-section">

                    <div class="booking-gallery">
                        <img src="<?= BASEURL; ?>/public/assets/img/bola.png" alt="Gelora Bung Karno Arena" class="booking-cover">
                        <div class="booking-thumbs">
                            <img src="<?= BASEURL; ?>/public/assets/img/bola.png" alt="Lapangan futsal">
                            <img src="<?= BASEURL; ?>/public/assets/img/basket indoor.jpg" alt="Area indoor">
                            <img src="<?= BASEURL; ?>/public/assets/img/tenis2.jpeg" alt="Area fasilitas">
                        </div>
                    </div>

                    <div class="booking-info">
                        <div class="venue-topline">
                            <span>Futsal</span>
                            <strong><i class="fas fa-star"></i> 4.9</strong>
                        </div>
                        <h2>Gelora Bung Karno Arena</h2>
                        <p class="booking-location"><i class="fas fa-map-marker-alt"></i> Senayan, Jakarta Pusat</p>
                        <p class="booking-copy">Lapangan futsal indoor dengan permukaan sintetis, pencahayaan malam, ruang tunggu, parkir luas, dan akses mudah dari area utama Senayan.</p>

                        <div class="facility-list">
                            <span><i class="fas fa-shower"></i> Shower</span>
                            <span><i class="fas fa-car"></i> Parkir</span>
                            <span><i class="fas fa-wifi"></i> WiFi</span>
                            <span><i class="fas fa-mug-hot"></i> Cafe</span>
                        </div>

                        <div class="schedule-board">
                            <h3>Slot Tersedia</h3>
                            <div class="slot-grid">
                                <button id="slot-0800">08:00</button>
                                <button class="active" id="slot-0900">09:00</button>
                                <button id="slot-1000">10:00</button>
                                <button id="slot-1300">13:00</button>
                                <button id="slot-1500">15:00</button>
                                <button disabled id="slot-1900">19:00</button>
                            </div>
                        </div>
                    </div>

                    <div class="table-header section-offset">
                        <h3 class="table-title"><i class="fas fa-star icon-warning"></i> Review Pelanggan</h3>
                        <span class="status-badge status-success">4.9 / 5</span>
                    </div>
                    <div class="stack">
                        <div class="list-row">
                            <div>
                                <h4>Andi Saputra</h4>
                                <small>28 Apr 2026 &bull; Futsal</small>
                                <p>Lapangan sangat bersih dan terawat, pencahayaan malam bagus sekali. Rekomen!</p>
                            </div>
                            <span class="status-badge status-success"><i class="fas fa-star"></i> 5</span>
                        </div>
                        <div class="list-row">
                            <div>
                                <h4>Citra Lestari</h4>
                                <small>20 Apr 2026 &bull; Futsal</small>
                                <p>Parkir luas, staff ramah. Akan booking lagi bulan depan.</p>
                            </div>
                            <span class="status-badge status-success"><i class="fas fa-star"></i> 5</span>
                        </div>
                        <div class="list-row">
                            <div>
                                <h4>Budi Santoso</h4>
                                <small>15 Apr 2026 &bull; Futsal</small>
                                <p>Lokasi strategis, tapi antrian checkout sedikit lama.</p>
                            </div>
                            <span class="status-badge status-info"><i class="fas fa-star"></i> 4</span>
                        </div>
                    </div>

                </section>

                <aside class="checkout-panel" id="panel-booking">
                    <h2>Ringkasan Booking</h2>
                    <form action="<?= BASEURL; ?>/pelanggan/pembayaran" id="form-booking-lapangan">
                        <div class="form-group">
                            <label class="form-label" for="booking-date">Tanggal</label>
                            <input type="date" id="booking-date" class="form-control">
                        </div>
                        <div class="form-group">
                            <label class="form-label" for="booking-duration">Durasi</label>
                            <select id="booking-duration" class="form-control">
                                <option>1 Jam</option>
                                <option>2 Jam</option>
                                <option>3 Jam</option>
                            </select>
                        </div>
                        <div class="checkout-row">
                            <span>Harga per jam</span>
                            <strong>Rp 350.000</strong>
                        </div>
                        <div class="checkout-row">
                            <span>Biaya layanan</span>
                            <strong>Rp 5.000</strong>
                        </div>
                        <div class="checkout-total">
                            <span>Total</span>
                            <strong>Rp 355.000</strong>
                        </div>
                        <button type="submit" class="btn-primary btn-auth" id="btn-bayar-sekarang">
                            <i class="fas fa-bolt"></i> Bayar Sekarang
                        </button>
                    </form>
                </aside>

            </div>
        </main>
    </div>
</body>
</html>
