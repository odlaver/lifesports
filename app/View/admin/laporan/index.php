<div class="dash-stats">
                <div class="dash-card">
                    <div class="dash-card-icon"><i class="fas fa-wallet"></i></div>
                    <div class="dash-card-info">
                        <h3>Total Pendapatan</h3>
                        <div class="value value-compact">Rp <?= number_format($data['total_revenue'], 0, ',', '.'); ?></div>
                        <small>Seluruh Waktu</small>
                    </div>
                </div>
                <div class="dash-card">
                    <div class="dash-card-icon"><i class="fas fa-calendar-check"></i></div>
                    <div class="dash-card-info">
                        <h3>Total Booking</h3>
                        <div class="value"><?= $data['total_booking']; ?></div>
                        <small>Selesai: <?= $data['selesai_booking']; ?></small>
                    </div>
                </div>
                <div class="dash-card">
                    <div class="dash-card-icon"><i class="fas fa-users"></i></div>
                    <div class="dash-card-info">
                        <h3>Total User</h3>
                        <div class="value"><?= $data['total_user']; ?></div>
                        <small>Termasuk Pengelola</small>
                    </div>
                </div>
                <div class="dash-card">
                    <div class="dash-card-icon"><i class="fas fa-building"></i></div>
                    <div class="dash-card-info">
                        <h3>Total Lapangan</h3>
                        <div class="value"><?= $data['total_lapangan']; ?></div>
                        <small>Telah Terdaftar</small>
                    </div>
                </div>
            </div>

            <div class="section-grid two-col">

                <section class="table-container">
                    <div class="table-header">
                        <h2 class="table-title"><i class="fas fa-trophy"></i> Lapangan Terpopuler</h2>
                    </div>
                    <table class="data-table">
                        <thead>
                            <tr>
                                <th>Lapangan</th>
                                <th>Pengelola</th>
                                <th>Total Booking</th>
                                <th>Pendapatan</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (empty($data['top_lapangan'])): ?>
                                <tr class="table-empty-row"><td colspan="4">Data tidak tersedia</td></tr>
                            <?php else: ?>
                                <?php foreach ($data['top_lapangan'] as $lap): ?>
                                <tr>
                                    <td><strong><?= htmlspecialchars($lap['nama_lapangan']); ?></strong><br><small><?= htmlspecialchars($lap['nama_kategori']); ?></small></td>
                                    <td><?= htmlspecialchars($lap['nama_pengelola']); ?></td>
                                    <td><?= $lap['total_booking']; ?>x</td>
                                    <td>Rp <?= number_format($lap['pendapatan'], 0, ',', '.'); ?></td>
                                </tr>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </section>

                <section class="table-container">
                    <div class="table-header">
                        <h2 class="table-title"><i class="fas fa-medal"></i> Pengelola Terbaik</h2>
                    </div>
                    <table class="data-table">
                        <thead>
                            <tr>
                                <th>Pengelola</th>
                                <th>Lapangan</th>
                                <th>Booking</th>
                                <th>Pendapatan</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (empty($data['top_pengelola'])): ?>
                                <tr class="table-empty-row"><td colspan="4">Data tidak tersedia</td></tr>
                            <?php else: ?>
                                <?php foreach ($data['top_pengelola'] as $peng): ?>
                                <tr>
                                    <td><strong><?= htmlspecialchars($peng['nama_pengelola']); ?></strong></td>
                                    <td><?= $peng['jumlah_lapangan']; ?></td>
                                    <td><?= $peng['total_booking']; ?>x</td>
                                    <td>Rp <?= number_format($peng['pendapatan'], 0, ',', '.'); ?></td>
                                </tr>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </section>
            </div>

            <div class="section-grid two-col">
                <section class="table-container">
                    <div class="table-header">
                        <h2 class="table-title"><i class="fas fa-chart-pie"></i> Status Booking</h2>
                    </div>
                    <table class="data-table">
                        <tbody>
                            <tr>
                                <td><span class="status-badge status-warning">Pending</span></td>
                                <td><?= $data['booking_stats']['pending']['count'] ?? 0; ?> booking</td>
                                <td class="text-right">Rp <?= number_format($data['booking_stats']['pending']['total'] ?? 0, 0, ',', '.'); ?></td>
                            </tr>
                            <tr>
                                <td><span class="status-badge status-info">Confirmed</span></td>
                                <td><?= $data['booking_stats']['dikonfirmasi']['count'] ?? 0; ?> booking</td>
                                <td class="text-right">Rp <?= number_format($data['booking_stats']['dikonfirmasi']['total'] ?? 0, 0, ',', '.'); ?></td>
                            </tr>
                            <tr>
                                <td><span class="status-badge status-success">Selesai</span></td>
                                <td><?= $data['booking_stats']['selesai']['count'] ?? 0; ?> booking</td>
                                <td class="text-right">Rp <?= number_format($data['booking_stats']['selesai']['total'] ?? 0, 0, ',', '.'); ?></td>
                            </tr>
                            <tr>
                                <td><span class="status-badge status-danger">Dibatalkan</span></td>
                                <td><?= $data['booking_stats']['dibatalkan']['count'] ?? 0; ?> booking</td>
                                <td class="text-right">Rp <?= number_format($data['booking_stats']['dibatalkan']['total'] ?? 0, 0, ',', '.'); ?></td>
                            </tr>
                        </tbody>
                    </table>
                </section>

                <section class="table-container">
                    <div class="table-header">
                        <h2 class="table-title"><i class="fas fa-chart-bar"></i> Status Pembayaran</h2>
                    </div>
                    <table class="data-table">
                        <tbody>
                            <tr>
                                <td><span class="status-badge status-success">Lunas</span></td>
                                <td><?= $data['payment_stats']['valid']['count'] ?? 0; ?> transaksi</td>
                                <td class="text-right">Rp <?= number_format($data['payment_stats']['valid']['total'] ?? 0, 0, ',', '.'); ?></td>
                            </tr>
                            <tr>
                                <td><span class="status-badge status-warning">Pending</span></td>
                                <td><?= $data['payment_stats']['menunggu']['count'] ?? 0; ?> transaksi</td>
                                <td class="text-right">Rp <?= number_format($data['payment_stats']['menunggu']['total'] ?? 0, 0, ',', '.'); ?></td>
                            </tr>
                            <tr>
                                <td><span class="status-badge status-danger">Gagal</span></td>
                                <td><?= $data['payment_stats']['tidak_valid']['count'] ?? 0; ?> transaksi</td>
                                <td class="text-right">Rp <?= number_format($data['payment_stats']['tidak_valid']['total'] ?? 0, 0, ',', '.'); ?></td>
                            </tr>
                        </tbody>
                    </table>
                </section>
            </div>