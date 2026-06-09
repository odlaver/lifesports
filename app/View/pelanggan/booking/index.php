<?php 
                $total = count($data['booking']);
                $pending = count(array_filter($data['booking'], function($b) { return $b['status'] === 'pending' || $b['status'] === 'dibayar'; }));
                $selesai = count(array_filter($data['booking'], function($b) { return $b['status'] === 'selesai'; }));
            ?>
            <div class="dash-stats">
                <div class="dash-card">
                    <div class="dash-card-icon"><i class="fas fa-calendar"></i></div>
                    <div class="dash-card-info"><h3>Total Booking</h3><div class="value"><?= $total; ?></div></div>
                </div>
                <div class="dash-card">
                    <div class="dash-card-icon warning"><i class="fas fa-clock"></i></div>
                    <div class="dash-card-info"><h3>Pending</h3><div class="value value-warning"><?= $pending; ?></div></div>
                </div>
                <div class="dash-card">
                    <div class="dash-card-icon"><i class="fas fa-check-circle"></i></div>
                    <div class="dash-card-info"><h3>Selesai</h3><div class="value"><?= $selesai; ?></div></div>
                </div>
                <div class="dash-card">
                    <div class="dash-card-icon"><i class="fas fa-wallet"></i></div>
                    <div class="dash-card-info">
                        <h3>Total Pengeluaran</h3>
                        <div class="value value-compact" style="font-size: 1.1rem; font-weight: 700; color: var(--text-gold);">
                            Rp <?= number_format(array_sum(array_map(function($b) { return $b['status'] !== 'dibatalkan' ? $b['total_harga'] : 0; }, $data['booking'])), 0, ',', '.'); ?>
                        </div>
                    </div>
                </div>
            </div>

            <section class="table-container">
                <form method="GET" action="<?= BASEURL; ?>/pelanggan/booking">
                    <div class="filter-bar compact mb-20">
                        <input class="form-control" name="search" placeholder="Cari kode booking atau lapangan..." value="<?= isset($data['filter']['keyword']) ? htmlspecialchars($data['filter']['keyword']) : ''; ?>">
                        <select class="form-control" name="status">
                            <option <?= (isset($data['filter']['status']) && $data['filter']['status'] == 'Semua Status') || empty($data['filter']['status']) ? 'selected' : ''; ?>>Semua Status</option>
                            <option <?= (isset($data['filter']['status']) && $data['filter']['status'] == 'Pending') ? 'selected' : ''; ?>>Pending</option>
                            <option <?= (isset($data['filter']['status']) && $data['filter']['status'] == 'Confirmed') ? 'selected' : ''; ?>>Confirmed</option>
                            <option <?= (isset($data['filter']['status']) && $data['filter']['status'] == 'Selesai') ? 'selected' : ''; ?>>Selesai</option>
                            <option <?= (isset($data['filter']['status']) && $data['filter']['status'] == 'Dibatalkan') ? 'selected' : ''; ?>>Dibatalkan</option>
                        </select>
                        <input class="form-control" type="date" name="tanggal" value="<?= isset($data['filter']['tanggal']) ? htmlspecialchars($data['filter']['tanggal']) : ''; ?>">
                        <button type="submit" class="btn-primary compact-button"><i class="fas fa-filter"></i> Filter</button>
                    </div>
                </form>
                <table class="data-table">
                    <thead>
                        <tr>
                            <th>Kode</th>
                            <th>Lapangan</th>
                            <th>Jadwal Main</th>
                            <th>Total</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (empty($data['booking'])): ?>
                            <tr class="table-empty-row">
                                <td colspan="6">
                                    Belum ada transaksi pemesanan lapangan.
                                </td>
                            </tr>
                        <?php else: ?>
                            <?php foreach($data['booking'] as $row): 
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
                                    <td><?= date('d M Y', strtotime($row['tanggal_main'])); ?><br><small><?= date('H:i', strtotime($row['jam_mulai'])) . ' - ' . date('H:i', strtotime($row['jam_selesai'])); ?></small></td>
                                    <td>Rp <?= number_format($row['total_harga'], 0, ',', '.'); ?></td>
                                    <td><span class="status-badge <?= $status_class; ?>"><?= $status_label; ?></span></td>
                                    <td>
                                        <a href="<?= BASEURL; ?>/pelanggan/booking_detail/<?= $row['id']; ?>" class="btn-action w-auto px-12 text-decoration-none"><i class="fas fa-eye"></i> Detail</a>
                                        <?php if ($row['status'] === 'selesai'): ?>
                                            <a href="<?= BASEURL; ?>/pelanggan/review/<?= $row['id']; ?>" class="btn-action warning w-auto px-12 ml-5 text-decoration-none"><i class="fas fa-star"></i> Review</a>
                                        <?php elseif ($row['status'] === 'pending'): ?>
                                            <a href="<?= BASEURL; ?>/pelanggan/pembayaran/<?= $row['id']; ?>" class="btn-action success w-auto px-12 ml-5 bg-success-light text-decoration-none"><i class="fas fa-wallet"></i> Bayar</a>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                </table>
            </section>
