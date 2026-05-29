<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Beri Review - Lifesports</title>
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
                <li><a href="<?= BASEURL; ?>/auth/logout" class="nav-danger"><i class="fas fa-sign-out-alt"></i> Keluar</a></li>
            </ul>
        </aside>

        <main class="main-content">
            <?php Flasher::flash(); ?>

            <header class="dashboard-header">
                <div class="dash-title">
                    <h1>Beri Review</h1>
                    <p>Bagikan pengalaman setelah memakai lapangan.</p>
                </div>
            </header>

            <section class="form-panel" style="background: rgba(255,255,255,0.01); border: 1px solid rgba(255,255,255,0.05); border-radius: 12px; padding: 25px;">
                <form action="<?= BASEURL; ?>/pelanggan/proses_review" method="POST">
                    <input type="hidden" name="id_booking" value="<?= $data['booking']['id']; ?>">
                    
                    <div class="form-grid" style="display: grid; grid-template-columns: repeat(2, 1fr); gap: 20px;">
                        <div class="form-group">
                            <label class="form-label" for="field">Lapangan</label>
                            <input id="field" class="form-control" value="<?= htmlspecialchars($data['booking']['nama_lapangan']); ?>" readonly style="background: rgba(255,255,255,0.03); color: #888;">
                        </div>
                        <div class="form-group">
                            <label class="form-label" for="rating">Rating</label>
                            <select id="rating" name="rating" class="form-control" required style="background: rgba(255,255,255,0.05); color: #fff; border: 1px solid rgba(255,255,255,0.1); padding: 10px; border-radius: 6px;">
                                <option value="5">5 - Sempurna</option>
                                <option value="4">4 - Sangat Baik</option>
                                <option value="3">3 - Cukup Baik</option>
                                <option value="2">2 - Kurang</option>
                                <option value="1">1 - Buruk</option>
                            </select>
                        </div>
                        <div class="form-group full" style="grid-column: 1 / -1; margin-top: 10px;">
                            <label class="form-label" for="comment">Komentar / Ulasan</label>
                            <textarea id="comment" name="ulasan" class="form-control" placeholder="Tulis pengalaman Anda menyewa lapangan ini..." required style="background: rgba(255,255,255,0.05); color: #fff; border: 1px solid rgba(255,255,255,0.1); padding: 15px; border-radius: 6px; min-height: 120px; width: 100%;"></textarea>
                        </div>
                    </div>
                    
                    <button type="submit" class="btn-primary" style="margin-top: 20px; border: none; padding: 12px 25px; cursor: pointer;"><i class="fas fa-paper-plane"></i> Kirim Review</button>
                </form>
            </section>
        </main>
    </div>
</body>
</html>
