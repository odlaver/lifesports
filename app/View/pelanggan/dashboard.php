<div class="dash-stats">
                <div class="dash-card">
                    <div class="dash-card-icon"><i class="fas fa-calendar-check"></i></div>
                    <div class="dash-card-info">
                        <h3>Total Booking</h3>
                        <div class="value"><?= $data['total_booking']; ?></div>
                    </div>
                </div>
                <div class="dash-card">
                    <div class="dash-card-icon warning"><i class="fas fa-clock"></i></div>
                    <div class="dash-card-info">
                        <h3>Menunggu Konfirmasi</h3>
                        <div class="value value-warning"><?= $data['menunggu_konfirmasi']; ?></div>
                    </div>
                </div>
                <div class="dash-card">
                    <div class="dash-card-icon"><i class="fas fa-check-circle"></i></div>
                    <div class="dash-card-info">
                        <h3>Selesai</h3>
                        <div class="value"><?= $data['selesai']; ?></div>
                    </div>
                </div>
                <div class="dash-card">
                    <div class="dash-card-icon"><i class="fas fa-wallet"></i></div>
                    <div class="dash-card-info">
                        <h3>Total Belanja</h3>
                        <div class="value value-compact">Rp <?= number_format($data['total_belanja'], 0, ',', '.'); ?></div>
                    </div>
                </div>
            </div>


            <div class="table-container panel-reset active-booking-shell" id="booking-aktif">
                <div class="table-header active-booking-header">
                    <h2 class="table-title"><i class="fas fa-clock"></i>Booking Aktif</h2>
                    <a href="<?= BASEURL; ?>/pelanggan/booking" class="btn-primary compact-button">Lihat Semua</a>
                </div>

                <div class="active-booking-grid">
                    <?php if (empty($data['booking_aktif'])): ?>
                        <div style="grid-column: 1/-1; text-align: center; padding: 40px; color: var(--text-muted); background: rgba(255,255,255,0.01); border-radius: 12px; border: 1px dashed rgba(255,255,255,0.05);">
                            <i class="fas fa-calendar-times" style="font-size: 2.5rem; margin-bottom: 12px; display: block; color: var(--text-gold);"></i>
                            Belum ada jadwal booking aktif saat ini.
                        </div>
                    <?php else: ?>
                        <?php foreach($data['booking_aktif'] as $booking): 
                            $status_class = 'status-pending';
                            $status_label = 'Pending';
                            if ($booking['status'] === 'dibayar') {
                                $status_class = 'status-info';
                                $status_label = 'Dibayar';
                            } elseif ($booking['status'] === 'dikonfirmasi') {
                                $status_class = 'status-warning';
                                $status_label = 'Dikonfirmasi';
                            }
                            
                            $foto = !empty($booking['foto_utama']) ? $booking['foto_utama'] : 'default_lapangan.jpg';
                            
                            $chip_class = 'info';
                            if (strtolower($booking['nama_kategori']) === 'tennis' || strtolower($booking['nama_kategori']) === 'tenis') {
                                $chip_class = 'success';
                            } elseif (strtolower($booking['nama_kategori']) === 'badminton') {
                                $chip_class = 'warning';
                            }
                        ?>
                            <div class="mini-booking-card">
                                <img src="<?= strpos($foto, 'http') === 0 ? $foto : BASEURL . '/assets/uploads/lapangan/' . $foto; ?>" 
                                     alt="<?= htmlspecialchars($booking['nama_lapangan']); ?>">
                                <div class="mini-card-body">
                                    <h4><?= htmlspecialchars($booking['nama_lapangan']); ?></h4>
                                    <span class="sport-chip <?= $chip_class; ?>"><?= htmlspecialchars($booking['nama_kategori']); ?></span>
                                    <p><i class="fas fa-calendar-alt"></i> <?= date('d M Y', strtotime($booking['tanggal_main'])); ?></p>
                                    <p><i class="fas fa-clock"></i> <?= date('H:i', strtotime($booking['jam_mulai'])) . ' - ' . date('H:i', strtotime($booking['jam_selesai'])); ?></p>

                                    <div class="mini-card-actions">
                                        <span class="status-badge <?= $status_class; ?>"><?= $status_label; ?></span>
                                        <a href="<?= BASEURL; ?>/pelanggan/booking_detail/<?= $booking['id']; ?>" class="btn-primary compact-button ghost-gold"><i class="fas fa-eye"></i> Detail</a>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php endif; ?>
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
                            <?php if (empty($data['riwayat_booking'])): ?>
                                <tr>
                                    <td colspan="6" style="text-align: center; color: var(--text-muted); padding: 20px;">
                                        Belum ada riwayat pemesanan.
                                    </td>
                                </tr>
                            <?php else: ?>
                                <?php foreach($data['riwayat_booking'] as $row): 
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
                                    <tr>
                                        <td><strong><?= htmlspecialchars($row['kode_booking']); ?></strong></td>
                                        <td><?= htmlspecialchars($row['nama_lapangan']); ?><br><small><?= htmlspecialchars($row['nama_kategori']); ?></small></td>
                                        <td><?= date('d M Y', strtotime($row['tanggal_main'])); ?></td>
                                        <td>Rp <?= number_format($row['total_harga'], 0, ',', '.'); ?></td>
                                        <td><span class="status-badge <?= $status_class; ?>"><?= $status_label; ?></span></td>
                                        <td>
                                            <a href="<?= BASEURL; ?>/pelanggan/booking_detail/<?= $row['id']; ?>" class="btn-action"><i class="fas fa-eye"></i></a>
                                            <?php if ($row['status'] === 'selesai'): ?>
                                                <a href="<?= BASEURL; ?>/pelanggan/review/<?= $row['id']; ?>" class="btn-action warning"><i class="fas fa-star"></i></a>
                                            <?php endif; ?>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>


                <div class="table-container">
                    <div class="table-header">
                        <h2 class="table-title"><i class="fas fa-heart icon-danger"></i>Rekomendasi Lapangan</h2>
                    </div>

                    <div class="stack">
                        <?php if (empty($data['rekomendasi_lapangan'])): ?>
                            <div style="text-align: center; padding: 30px; color: var(--text-muted); font-size: 0.9rem;">
                                <i class="fas fa-search-location" style="font-size: 2rem; margin-bottom: 8px; display: block; color: var(--text-gold);"></i>
                                Belum ada rekomendasi lapangan saat ini.
                            </div>
                        <?php else: ?>
                            <?php foreach($data['rekomendasi_lapangan'] as $fav): 
                                $chip_class = 'info';
                                if (strtolower($fav['nama_kategori']) === 'tennis' || strtolower($fav['nama_kategori']) === 'tenis') {
                                    $chip_class = 'success';
                                } elseif (strtolower($fav['nama_kategori']) === 'badminton') {
                                    $chip_class = 'warning';
                                }
                            ?>
                                <div class="favorite-item">
                                    <h4><?= htmlspecialchars($fav['nama_lapangan']); ?></h4>
                                    <span class="sport-chip <?= $chip_class; ?>"><?= htmlspecialchars($fav['nama_kategori']); ?></span>
                                    <p style="margin: 6px 0;">
                                        <i class="fas fa-star" style="color: var(--text-gold);"></i> <?= number_format($fav['rating'], 1); ?> &bull; Rp <?= number_format($fav['harga_per_jam'], 0, ',', '.'); ?>/jam
                                    </p>
                                    <a href="<?= BASEURL; ?>/pelanggan/pelanggan_detail_lapangan/<?= $fav['id']; ?>" class="btn-primary compact-button"><i class="fas fa-eye"></i> Lihat</a>
                                </div>
                            <?php endforeach; ?>
                        <?php endif; ?>
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
