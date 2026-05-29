<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pembayaran - Lifesports</title>
    <link rel="stylesheet" href="<?= BASEURL; ?>/public/assets/css/styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>

<body>
    <header class="navbar">
        <a href="<?= BASEURL; ?>/home" class="nav-brand">
            <div class="brand-icon">
                <i class="fas fa-trophy"></i>
            </div>
            Lifesports
        </a>

        <ul class="nav-links">
            <li><a href="<?= BASEURL; ?>/pelanggan">Dashboard</a></li>
            <li><a href="<?= BASEURL; ?>/pelanggan/lapangan">Cari Lapangan</a></li>
            <li><a href="<?= BASEURL; ?>/pelanggan/booking">Riwayat Booking</a></li>
        </ul>

        <div class="nav-actions">
            <span style="color: var(--text-gold); font-weight: 600; margin-right: 15px;"><i class="fas fa-user"></i> <?= htmlspecialchars($_SESSION['nama']); ?></span>
            <a href="<?= BASEURL; ?>/auth/logout" class="btn-nav" style="border: 1px solid var(--status-danger); color: var(--status-danger);">
                <i class="fas fa-sign-out-alt"></i> Keluar
            </a>
        </div>
    </header>

    <main class="payment-page container" style="margin-top: 40px; margin-bottom: 50px;">
        <?php Flasher::flash(); ?>
        
        <section class="payment-card">
            <div class="payment-status">
                <div class="payment-icon" style="background: rgba(204, 164, 80, 0.1); color: var(--text-gold);">
                    <i class="fas fa-receipt"></i>
                </div>
                <div>
                    <span>Kode Booking</span>
                    <h1 style="color: var(--text-gold); font-size: 1.8rem;"><?= htmlspecialchars($data['booking']['kode_booking']); ?></h1>
                    <p>Selesaikan pembayaran untuk mengonfirmasi pemesanan slot lapangan Anda.</p>
                </div>
            </div>

            <form action="<?= BASEURL; ?>/pelanggan/proses_pembayaran" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="id_booking" value="<?= $data['booking']['id']; ?>">
                
                <div class="payment-grid" style="display: grid; grid-template-columns: 1.2fr 0.8fr; gap: 30px; margin-top: 30px;">
                    <div>
                        <h2 style="font-size: 1.2rem; margin-bottom: 20px; color: #fff;"><i class="fas fa-credit-card"></i> Pilih Metode Pembayaran</h2>
                        
                        <div class="form-group" style="margin-bottom: 20px;">
                            <label class="form-label" style="display: block; margin-bottom: 10px;">Metode Transfer</label>
                            
                            <label class="payment-method active" style="display: flex; align-items: center; gap: 15px; padding: 15px; background: rgba(255,255,255,0.02); border: 1px solid rgba(255,255,255,0.05); border-radius: 8px; cursor: pointer; margin-bottom: 10px;">
                                <input type="radio" name="metode_pembayaran" value="Transfer Bank BCA" checked style="margin-right: 5px;">
                                <i class="fas fa-building-columns" style="font-size: 1.5rem; color: var(--text-gold);"></i>
                                <div>
                                    <strong style="display: block; color: #fff;">Transfer Bank BCA</strong>
                                    <span style="font-size: 0.8rem; color: var(--text-muted);">No. Rek: 8810 2026 0511 (A.N. Lifesports Premium)</span>
                                </div>
                            </label>
                            
                            <label class="payment-method" style="display: flex; align-items: center; gap: 15px; padding: 15px; background: rgba(255,255,255,0.02); border: 1px solid rgba(255,255,255,0.05); border-radius: 8px; cursor: pointer; margin-bottom: 10px;">
                                <input type="radio" name="metode_pembayaran" value="E-Wallet DANA/OVO" style="margin-right: 5px;">
                                <i class="fas fa-wallet" style="font-size: 1.5rem; color: var(--text-gold);"></i>
                                <div>
                                    <strong style="display: block; color: #fff;">Dompet Digital (DANA/OVO)</strong>
                                    <span style="font-size: 0.8rem; color: var(--text-muted);">No. HP: 0812-3456-7890 (A.N. Lifesports Premium)</span>
                                </div>
                            </label>
                        </div>
                        
                        <div class="form-group" style="margin-top: 25px;">
                            <label class="form-label" for="bukti_transfer" style="color: #fff; display: block; margin-bottom: 8px;"><i class="fas fa-upload"></i> Unggah Bukti Transfer</label>
                            <input type="file" name="bukti_transfer" id="bukti_transfer" class="form-control" required style="background: rgba(255,255,255,0.02); color: #fff; border: 1px dashed rgba(255,255,255,0.1); padding: 15px; border-radius: 8px; cursor: pointer; width: 100%;">
                            <small style="color: var(--text-muted); display: block; margin-top: 5px;">Format file: JPG, JPEG, PNG (Maks 5MB)</small>
                        </div>
                    </div>

                    <aside class="invoice-box" style="background: rgba(255,255,255,0.02); border: 1px solid rgba(255,255,255,0.05); border-radius: 12px; padding: 25px; display: flex; flex-direction: column; justify-content: space-between; height: fit-content;">
                        <h2 style="font-size: 1.2rem; margin-bottom: 20px; color: #fff; border-bottom: 1px solid rgba(255,255,255,0.05); padding-bottom: 10px;">Ringkasan Invoice</h2>
                        
                        <div class="checkout-row" style="display: flex; justify-content: space-between; margin-bottom: 12px; font-size: 0.9rem;">
                            <span style="color: var(--text-muted);"><?= htmlspecialchars($data['booking']['nama_lapangan']); ?></span>
                            <strong style="color: #fff;">Rp <?= number_format($data['booking']['total_harga'], 0, ',', '.'); ?></strong>
                        </div>
                        <div class="checkout-row" style="display: flex; justify-content: space-between; margin-bottom: 15px; font-size: 0.9rem;">
                            <span style="color: var(--text-muted);">Biaya Layanan</span>
                            <strong style="color: #fff;">Rp 0</strong>
                        </div>
                        <div class="checkout-total" style="display: flex; justify-content: space-between; border-top: 1px solid rgba(255,255,255,0.05); padding-top: 15px; margin-bottom: 25px; font-size: 1.1rem; font-weight: 700;">
                            <span style="color: var(--text-gold);">Total Bayar</span>
                            <strong style="color: var(--text-gold);">Rp <?= number_format($data['booking']['total_harga'], 0, ',', '.'); ?></strong>
                        </div>
                        
                        <button type="submit" class="btn-primary btn-auth" style="width: 100%; border: none; padding: 14px; font-weight: 600; cursor: pointer;">
                            <i class="fas fa-check-double"></i> Konfirmasi Pembayaran
                        </button>
                    </aside>
                </div>
            </form>
        </section>
    </main>
</body>


</html>
