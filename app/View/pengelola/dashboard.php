<?php if ($data['booking_pending_count'] > 0): ?>
            <div class="alert warning">
                <div>
                    <i class="fas fa-exclamation-triangle"></i>
                    <strong>Peringatan Sistem:</strong> Terdapat <?= $data['booking_pending_count']; ?> reservasi yang memerlukan verifikasi.
                </div>
                <a href="#booking-pending">Tinjau Reservasi</a>
            </div>
            <?php endif; ?>

            <div class="dash-stats">
                <div class="dash-card">
                    <div class="dash-card-icon"><i class="fas fa-building"></i></div>
                    <div class="dash-card-info">
                        <h3>Total Lapangan</h3>
                        <div class="value"><?= $data['total_lapangan']; ?></div>
                        <small>Tersedia: <?= $data['total_lapangan_aktif']; ?></small>
                    </div>
                </div>
                <div class="dash-card">
                    <div class="dash-card-icon warning"><i class="fas fa-clock"></i></div>
                    <div class="dash-card-info">
                        <h3>Booking Pending</h3>
                        <div class="value value-warning"><?= $data['booking_pending_count']; ?></div>
                        <small>Perlu konfirmasi</small>
                    </div>
                </div>
                <div class="dash-card">
                    <div class="dash-card-icon"><i class="fas fa-calendar-check"></i></div>
                    <div class="dash-card-info">
                        <h3>Total Booking</h3>
                        <div class="value"><?= $data['total_booking']; ?></div>
                        <small>Selesai: <?= $data['total_booking_selesai']; ?></small>
                    </div>
                </div>
                <div class="dash-card">
                    <div class="dash-card-icon"><i class="fas fa-wallet"></i></div>
                    <div class="dash-card-info">
                        <h3>Pendapatan Bulan Ini</h3>
                        <div class="value value-compact">Rp <?= number_format($data['pendapatan_total'], 0, ',', '.'); ?></div>
                    </div>
                </div>
            </div>

            <div class="section-grid two-col" id="booking-pending">

                <div class="table-container">
                    <div class="table-header">
                        <h2 class="table-title"><i class="fas fa-clock icon-warning"></i>Booking Pending</h2>
                        <a href="<?= BASEURL; ?>/pengelola/booking" class="btn-primary compact-button">Lihat Semua</a>
                    </div>

                    <div class="stack">
                        <?php if (empty($data['booking_pending'])): ?>
                            <div class="text-center p-25 text-muted-color font-size-md">
                                Tidak ada booking pending saat ini.
                            </div>
                        <?php else: ?>
                            <?php foreach ($data['booking_pending'] as $row): ?>
                                <div class="list-row">
                                    <div>
                                        <h4><?= htmlspecialchars($row['kode_booking']); ?></h4>
                                        <p><?= htmlspecialchars($row['nama_lapangan']); ?> (<?= htmlspecialchars($row['nama_kategori']); ?>)</p>
                                        <small><?= htmlspecialchars($row['nama_pelanggan']); ?> - <?= date('d M Y', strtotime($row['tanggal_main'])); ?> - <?= date('H:i', strtotime($row['jam_mulai'])); ?>-<?= date('H:i', strtotime($row['jam_selesai'])); ?></small>
                                    </div>
                                    <a href="<?= BASEURL; ?>/pengelola/booking_detail/<?= $row['id']; ?>" class="btn-primary compact-button ghost-warning"><i class="fas fa-check-circle"></i> Tinjau</a>
                                </div>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </div>
                </div>

                <div class="table-container">
                    <div class="table-header">
                        <h2 class="table-title"><i class="fas fa-calendar-day icon-info"></i>Booking Hari Ini</h2>
                    </div>

                    <div class="stack">
                        <?php if (empty($data['booking_hari_ini'])): ?>
                            <div class="text-center p-25 text-muted-color font-size-md">
                                Tidak ada booking hari ini.
                            </div>
                        <?php else: ?>
                            <?php foreach ($data['booking_hari_ini'] as $row): ?>
                                <div class="list-row">
                                    <div>
                                        <p><?= htmlspecialchars($row['nama_lapangan']); ?></p>
                                        <small><?= htmlspecialchars($row['nama_pelanggan']); ?> - <?= date('H:i', strtotime($row['jam_mulai'])); ?> - <?= date('H:i', strtotime($row['jam_selesai'])); ?></small>
                                    </div>
                                    <span class="status-badge status-success"><?= htmlspecialchars(ucfirst($row['status'])); ?></span>
                                </div>
                            <?php endforeach; ?>
                        <?php endif; ?>
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
                        <?php if (empty($data['lapangan_populer'])): ?>
                            <tr class="table-empty-row">
                                <td colspan="6">
                                    Belum ada data lapangan.
                                </td>
                            </tr>
                        <?php else: ?>
                            <?php foreach ($data['lapangan_populer'] as $row): ?>
                                <tr>
                                    <td><strong><?= htmlspecialchars($row['nama_lapangan']); ?></strong></td>
                                    <td><?= htmlspecialchars($row['lokasi'] ?? 'Bandar Lampung'); ?></td>
                                    <td>Rp <?= number_format($row['harga_per_jam'], 0, ',', '.'); ?></td>
                                    <td><i class="fas fa-star text-gold-color"></i> 5.0</td>
                                    <td><?= $row['total_booking']; ?>x</td>
                                    <td><span class="status-badge status-success"><?= htmlspecialchars(ucfirst($row['status'])); ?></span></td>
                                </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>