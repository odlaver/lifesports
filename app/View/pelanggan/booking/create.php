<main class="booking-page container">
    <a href="<?= BASEURL; ?>/home/lapangan" class="auth-back inline-back">
        <i class="fas fa-arrow-left"></i> Kembali ke daftar
    </a>

    <?php \App\Core\Flasher::flash(); ?>

    <section class="booking-detail">
        <div class="booking-gallery">
            <?php 
                $foto_utama = $data['lapangan']['foto_utama'];
                $imgSrc = strpos($foto_utama, 'http') === 0 ? $foto_utama : BASEURL . '/assets/uploads/lapangan/' . $foto_utama;
            ?>
            <img src="<?= $imgSrc ?>" alt="<?= htmlspecialchars($data['lapangan']['nama_lapangan']) ?>" class="booking-cover">
        </div>

        <div class="booking-info">
            <div class="venue-topline">
                <span><?= htmlspecialchars($data['lapangan']['nama_kategori']) ?></span>
                <strong><i class="fas fa-star"></i> <?= isset($data['lapangan']['rating']) ? number_format($data['lapangan']['rating'], 1) : '5.0' ?></strong>
            </div>
            <h1><?= htmlspecialchars($data['lapangan']['nama_lapangan']) ?></h1>
            <p class="booking-location"><i class="fas fa-map-marker-alt"></i> <?= htmlspecialchars($data['lapangan']['lokasi'] ?? 'Bandar Lampung'); ?></p>
            <p class="booking-copy"><?= nl2br(htmlspecialchars($data['lapangan']['deskripsi'] ?? 'Fasilitas olahraga premium.')) ?></p>

            <div class="facility-list">
                <?php
                if (!empty($data['lapangan']['fasilitas'])) {
                    $fasilitas = explode(',', $data['lapangan']['fasilitas']);
                    foreach ($fasilitas as $f) {
                        echo '<span><i class="fas fa-check-circle"></i> ' . htmlspecialchars(trim($f)) . '</span> ';
                    }
                } else {
                    echo '<span><i class="fas fa-shower"></i> Shower</span>
                          <span><i class="fas fa-car"></i> Parkir</span>';
                }
                ?>
            </div>
        </div>
    </section>

    <aside class="checkout-panel">
        <h2>Ringkasan Booking</h2>
        <form action="<?= BASEURL; ?>/pelanggan/booking/store" method="POST" id="bookingForm">
            <input type="hidden" name="id_lapangan" value="<?= $data['lapangan']['id'] ?>">
            <div class="form-group">
                <label class="form-label" for="tanggal_main">Tanggal Main</label>
                <input type="date" id="tanggal_main" name="tanggal_main" class="form-control" min="<?= date('Y-m-d') ?>" required>
            </div>
            
            <div class="form-group">
                <label class="form-label" for="jam_mulai">Jam Mulai</label>
                <input type="time" id="jam_mulai" name="jam_mulai" class="form-control" required>
            </div>
            
            <div class="form-group">
                <label class="form-label" for="durasi">Durasi (Jam)</label>
                <select id="durasi" name="durasi" class="form-control" required>
                    <option value="1">1 Jam</option>
                    <option value="2">2 Jam</option>
                    <option value="3">3 Jam</option>
                    <option value="4">4 Jam</option>
                </select>
            </div>

            <div class="checkout-row">
                <span>Harga per jam</span>
                <strong>Rp <?= number_format($data['lapangan']['harga_per_jam'], 0, ',', '.') ?></strong>
            </div>
            <div class="checkout-total">
                <span>Total</span>
                <strong>Harga x durasi</strong>
            </div>
            <button type="submit" class="btn-primary btn-auth">
                Proses Booking
            </button>
        </form>
    </aside>
</main>
