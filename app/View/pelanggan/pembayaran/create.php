<main class="payment-page container mt-40 mb-50">
        <?php \App\Core\Flasher::flash(); ?>
        
        <section class="payment-card">
            <div class="payment-status">
                <div class="payment-icon bg-gold-light">
                    <i class="fas fa-receipt"></i>
                </div>
                <div>
                    <span>Kode Booking</span>
                    <h1 class="text-gold-color font-size-xxl"><?= htmlspecialchars($data['booking']['kode_booking']); ?></h1>
                    <p>Selesaikan pembayaran untuk mengonfirmasi pemesanan slot lapangan Anda.</p>
                </div>
            </div>

            <form action="<?= BASEURL; ?>/pelanggan/pembayaran/store/<?= $data['booking']['id']; ?>" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="id_booking" value="<?= $data['booking']['id']; ?>">
                
                <div class="payment-grid d-grid grid-payment mt-30">
                    <div>
                        <h2 class="font-size-lg mb-20 text-white"><i class="fas fa-credit-card"></i> Pilih Metode Pembayaran</h2>
                        
                        <div class="form-group mb-20">
                            <label class="form-label d-block mb-10">Metode Transfer</label>
                            
                            <label class="payment-method active payment-method-label">
                                <input type="radio" name="metode_pembayaran" value="Dompet Digital" checked class="mr-5">
                                <i class="fas fa-wallet font-size-xl text-gold-color"></i>
                                <div>
                                    <strong class="d-block text-white">Dompet Digital</strong>
                                    <span class="font-size-sm text-muted-color">
                                        <?php 
                                        $info = !empty($data['booking']['info_pembayaran']) ? $data['booking']['info_pembayaran'] : 'Belum diset oleh pengelola';
                                        echo htmlspecialchars($info); 
                                        ?>
                                    </span>
                                </div>
                            </label>
                        </div>
                        
                        <div class="form-group mt-25">
                            <label class="form-label text-white d-block mb-8" for="bukti_transfer"><i class="fas fa-upload"></i> Unggah Bukti Transfer</label>
                            <input type="file" name="bukti_transfer" id="bukti_transfer" class="form-input-dark" required>
                            <small class="text-muted-color d-block mt-5">Format file: JPG, JPEG, PNG (Maks 5MB)</small>
                        </div>
                    </div>

                    <aside class="invoice-box bg-dark-02 border-radius-12 p-25 d-flex flex-column flex-between h-fit">
                        <h2 class="font-size-lg mb-20 text-white border-bottom pb-10">Ringkasan Invoice</h2>
                        
                        <div class="checkout-row d-flex flex-between mb-12 font-size-md">
                            <span class="text-muted-color"><?= htmlspecialchars($data['booking']['nama_lapangan']); ?></span>
                            <strong class="text-white">Rp <?= number_format($data['booking']['total_harga'], 0, ',', '.'); ?></strong>
                        </div>
                        <div class="checkout-row d-flex flex-between mb-15 font-size-md">
                            <span class="text-muted-color">Biaya Layanan</span>
                            <strong class="text-white">Rp 0</strong>
                        </div>
                        <div class="checkout-total d-flex flex-between border-top pt-15 mb-25 font-size-lg font-bold">
                            <span class="text-gold-color">Total Bayar</span>
                            <strong class="text-gold-color">Rp <?= number_format($data['booking']['total_harga'], 0, ',', '.'); ?></strong>
                        </div>
                        
                        <button type="submit" class="btn-primary btn-auth w-100 border-none p-15 font-bold cursor-pointer">
                            <i class="fas fa-check-double"></i> Konfirmasi Pembayaran
                        </button>
                    </aside>
                </div>
            </form>
        </section>
    </main>
