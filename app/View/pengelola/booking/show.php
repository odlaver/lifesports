<?php 
            $row = $data['booking'];
            $status_class = 'status-pending';
            $status_label = 'Pending';
            if ($row['status'] === 'dibayar') {
                $status_class = 'status-info';
                $status_label = 'Dibayar';
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
            
            
            <?php \App\Core\Flasher::flash(); ?>

            <div class="detail-layout">
                <section class="detail-panel">
                    <h2 class="table-title"><i class="fas fa-user"></i>Data Pelanggan & Pemesanan</h2>
                    <div class="info-list">
                        <div class="info-row"><span>Nama Pelanggan</span><strong><?= htmlspecialchars($row['nama_pelanggan']); ?></strong></div>
                        <div class="info-row"><span>Email</span><strong><?= htmlspecialchars($row['email_pelanggan']); ?></strong></div>
                        <div class="info-row"><span>Lapangan</span><strong><?= htmlspecialchars($row['nama_lapangan']); ?> (<?= htmlspecialchars($row['nama_kategori']); ?>)</strong></div>
                        <div class="info-row"><span>Jadwal Main</span><strong><?= date('d M Y', strtotime($row['tanggal_main'])); ?>, <?= date('H:i', strtotime($row['jam_mulai'])); ?> - <?= date('H:i', strtotime($row['jam_selesai'])); ?></strong></div>
                        <div class="info-row"><span>Total Harga</span><strong>Rp <?= number_format($row['total_harga'], 0, ',', '.'); ?></strong></div>
                        <div class="info-row"><span>Status Reservasi</span><strong><span class="status-badge <?= $status_class; ?>"><?= $status_label; ?></span></strong></div>
                    </div>

                    <?php if (!empty($row['bukti_transfer'])): ?>
                        <div class="mt-30">
                            <h3 class="table-title"><i class="fas fa-credit-card"></i> Bukti Pembayaran</h3>
                            <div class="info-row"><span>Metode</span><strong><?= htmlspecialchars($row['metode_pembayaran']); ?></strong></div>
                            <div class="info-row"><span>Status Transfer</span><strong><span class="status-badge <?= $row['status_pembayaran'] === 'valid' ? 'status-success' : ($row['status_pembayaran'] === 'tidak_valid' ? 'status-danger' : 'status-info'); ?>"><?= htmlspecialchars(ucfirst($row['status_pembayaran'])); ?></span></strong></div>
                            <div class="mt-15">
                                <?php $buktiExt = strtolower(pathinfo($row['bukti_transfer'], PATHINFO_EXTENSION)); ?>
                                <?php if ($buktiExt === 'pdf'): ?>
                                    <a href="<?= BASEURL; ?>/assets/uploads/pembayaran/<?= htmlspecialchars($row['bukti_transfer']); ?>" target="_blank" class="btn-secondary">
                                        <i class="fas fa-file-pdf"></i> Lihat Bukti Transfer
                                    </a>
                                <?php else: ?>
                                    <a href="<?= BASEURL; ?>/assets/uploads/pembayaran/<?= htmlspecialchars($row['bukti_transfer']); ?>" target="_blank">
                                        <img src="<?= BASEURL; ?>/assets/uploads/pembayaran/<?= htmlspecialchars($row['bukti_transfer']); ?>" alt="Bukti Transfer" class="img-bukti">
                                    </a>
                                    <small class="d-block text-muted-color mt-5">Klik gambar untuk memperbesar</small>
                                <?php endif; ?>
                            </div>
                        </div>
                    <?php endif; ?>
                </section>
                
                <aside class="summary-panel">
                    <h2 class="table-title">Aksi Pengelola</h2>
                    
                    <?php if ($row['status'] === 'dibayar'): ?>
                        <form action="<?= BASEURL; ?>/pengelola/booking/confirm/<?= $row['id']; ?>" method="POST" class="mb-10" onsubmit="return confirm('Apakah Anda yakin ingin mengkonfirmasi pembayaran ini?');">
                            <button type="submit" class="btn-primary btn-auth text-center d-block w-100 border-none cursor-pointer"><i class="fas fa-check"></i> Setujui & Konfirmasi</button>
                        </form>
                        <form action="<?= BASEURL; ?>/pengelola/booking/reject/<?= $row['id']; ?>" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menolak dan membatalkan booking ini?');">
                            <button type="submit" class="btn-secondary btn-auth text-center d-block w-100 bg-danger-solid border-none cursor-pointer"><i class="fas fa-ban"></i> Batalkan Booking</button>
                        </form>
                    <?php elseif ($row['status'] === 'pending'): ?>
                        <div class="text-center text-muted-color p-10 mb-10">
                            Menunggu bukti pembayaran pelanggan.
                        </div>
                        <form action="<?= BASEURL; ?>/pengelola/booking/reject/<?= $row['id']; ?>" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menolak dan membatalkan booking ini?');">
                            <button type="submit" class="btn-secondary btn-auth text-center d-block w-100 bg-danger-solid border-none cursor-pointer"><i class="fas fa-ban"></i> Batalkan Booking</button>
                        </form>
                    <?php elseif ($row['status'] === 'dikonfirmasi'): ?>
                        <form action="<?= BASEURL; ?>/pengelola/booking/complete/<?= $row['id']; ?>" method="POST" class="mb-10" onsubmit="return confirm('Apakah sesi booking ini telah selesai dimainkan?');">
                            <button type="submit" class="btn-primary btn-auth text-center d-block w-100 bg-success-solid border-none cursor-pointer"><i class="fas fa-check-double"></i> Tandai Selesai</button>
                        </form>
                        <form action="<?= BASEURL; ?>/pengelola/booking/reject/<?= $row['id']; ?>" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin membatalkan booking ini secara sepihak?');">
                            <button type="submit" class="btn-secondary btn-auth text-center d-block w-100 bg-danger-solid border-none cursor-pointer"><i class="fas fa-ban"></i> Batalkan Booking</button>
                        </form>
                    <?php else: ?>
                        <div class="text-center text-muted-color p-10">
                            Transaksi ini sudah selesai/dibatalkan. Tidak ada aksi lanjutan yang diperlukan.
                        </div>
                    <?php endif; ?>
                </aside>
            </div>
