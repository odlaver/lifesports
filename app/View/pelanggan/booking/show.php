<?php \App\Core\Flasher::flash(); ?>

            <?php 
                $row = $data['booking'];
                $status_class = 'status-pending';
                $status_label = 'Pending';
                if ($row['status'] === 'dibayar') {
                    $status_class = 'status-info';
                    $status_label = 'Dibayar (Menunggu Verifikasi)';
                } elseif ($row['status'] === 'dikonfirmasi') {
                    $status_class = 'status-warning';
                    $status_label = 'Dikonfirmasi';
                } elseif ($row['status'] === 'selesai') {
                    $status_class = 'status-success';
                    $status_label = 'Selesai';
                } elseif ($row['status'] === 'dibatalkan') {
                    $status_class = 'status-danger';
                    $status_label = 'Dibatalkan';
                }
            ?>
            

            <div class="detail-layout d-grid grid-payment">
                <section class="detail-panel bg-dark-01 border-radius-12 p-25">
                    <div class="table-header d-flex flex-between align-center border-bottom pb-10 mb-20">
                        <h2 class="table-title font-size-lg m-0 text-white"><i class="fas fa-building text-gold-color mr-12"></i> <?= htmlspecialchars($row['nama_lapangan']); ?></h2>
                        <span class="status-badge <?= $status_class; ?>"><?= $status_label; ?></span>
                    </div>
                    
                    <div class="info-list d-flex flex-column gap-15">
                        <div class="info-row d-flex flex-between font-size-md border-dashed pb-10">
                            <span class="text-muted-color">Cabang Olahraga</span>
                            <strong class="text-white"><?= htmlspecialchars($row['nama_kategori']); ?></strong>
                        </div>
                        <div class="info-row d-flex flex-between font-size-md border-dashed pb-10">
                            <span class="text-muted-color">Tanggal Main</span>
                            <strong class="text-white"><?= date('d M Y', strtotime($row['tanggal_main'])); ?></strong>
                        </div>
                        <div class="info-row d-flex flex-between font-size-md border-dashed pb-10">
                            <span class="text-muted-color">Waktu / Jam</span>
                            <strong class="text-white"><?= date('H:i', strtotime($row['jam_mulai'])) . ' - ' . date('H:i', strtotime($row['jam_selesai'])); ?></strong>
                        </div>
                        <div class="info-row d-flex flex-between font-size-md border-dashed pb-10">
                            <span class="text-muted-color">Lokasi</span>
                            <strong class="text-white"><?= htmlspecialchars($data['booking']['lokasi_lapangan'] ?? 'Bandar Lampung'); ?></strong>
                        </div>
                        <div class="info-row d-flex flex-between font-size-md">
                            <span class="text-muted-color">Waktu Reservasi</span>
                            <strong class="text-white"><?= date('d M Y, H:i', strtotime($row['created_at'])); ?></strong>
                        </div>
                    </div>
                </section>

                <aside class="summary-panel bg-dark-01 border-radius-12 p-25 h-fit d-flex flex-column gap-20">
                    <h2 class="table-title font-size-lg text-white border-bottom pb-10 m-0">Rincian Harga</h2>
                    
                    <div class="info-list d-flex flex-column gap-12">
                        <div class="info-row d-flex flex-between font-size-md">
                            <span class="text-muted-color">Biaya Sewa Lapangan</span>
                            <strong class="text-white">Rp <?= number_format($row['total_harga'], 0, ',', '.'); ?></strong>
                        </div>
                        <div class="info-row d-flex flex-between font-size-md">
                            <span class="text-muted-color">Biaya Administrasi</span>
                            <strong class="text-white">Rp 0</strong>
                        </div>
                        <div class="checkout-total d-flex flex-between border-top pt-10 font-size-md font-bold text-gold-color">
                            <span>Total Pembayaran</span>
                            <strong>Rp <?= number_format($row['total_harga'], 0, ',', '.'); ?></strong>
                        </div>
                    </div>

                    <?php if ($row['status'] === 'pending'): ?>
                        <a href="<?= BASEURL; ?>/pelanggan/pembayaran/<?= $row['id']; ?>" class="btn-primary btn-auth text-center text-decoration-none py-12"><i class="fas fa-wallet mr-5"></i> Bayar Sekarang</a>
                    <?php elseif ($row['status'] === 'selesai'): ?>
                        <a href="<?= BASEURL; ?>/pelanggan/review/<?= $row['id']; ?>" class="btn-secondary btn-auth text-center text-decoration-none py-12 bg-gold-light"><i class="fas fa-star mr-5"></i> Beri Review</a>
                    <?php elseif ($row['status'] === 'dibayar' && !empty($row['bukti_transfer'])): ?>
                        <div class="bg-info-light border-radius-8 p-10 font-size-sm text-center text-info">
                            <i class="fas fa-spinner fa-spin"></i> Bukti transfer terunggah. Menunggu verifikasi pengelola.
                        </div>
                    <?php endif; ?>
                </aside>
            </div>