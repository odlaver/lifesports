<div class="dash-stats">
                <div class="dash-card">
                    <div class="dash-card-icon"><i class="fas fa-wallet"></i></div>
                    <div class="dash-card-info">
                        <h3>Total Pendapatan</h3>
                        <div class="value value-compact">Rp <?= number_format($data['total_revenue'], 0, ',', '.'); ?></div>
                        <small>Dari Semua Transaksi Lunas</small>
                    </div>
                </div>
                <div class="dash-card">
                    <div class="dash-card-icon"><i class="fas fa-check-circle"></i></div>
                    <div class="dash-card-info">
                        <h3>Lunas</h3>
                        <div class="value"><?= $data['payment_stats']['valid']['count'] ?? 0; ?></div>
                    </div>
                </div>
                <div class="dash-card">
                    <div class="dash-card-icon warning"><i class="fas fa-clock"></i></div>
                    <div class="dash-card-info">
                        <h3>Pending</h3>
                        <div class="value value-warning"><?= $data['payment_stats']['menunggu']['count'] ?? 0; ?></div>
                    </div>
                </div>
                <div class="dash-card">
                    <div class="dash-card-icon"><i class="fas fa-times-circle"></i></div>
                    <div class="dash-card-info">
                        <h3>Gagal</h3>
                        <div class="value"><?= $data['payment_stats']['tidak_valid']['count'] ?? 0; ?></div>
                    </div>
                </div>
            </div>

            <section class="table-container">
                <div class="table-header">
                    <h2 class="table-title"><i class="fas fa-list"></i> Riwayat Transaksi</h2>
                </div>
                <div class="filter-bar compact">
                    <input class="form-control" id="input-search-pembayaran" placeholder="Cari no. transaksi atau pelanggan...">
                    <select class="form-control" id="select-status-pembayaran">
                        <option>Semua Status</option>
                        <option>Lunas</option>
                        <option>Pending</option>
                        <option>Gagal</option>
                    </select>
                    <select class="form-control" id="select-metode-pembayaran">
                        <option>Semua Metode</option>
                        <option>Virtual Account</option>
                        <option>Dompet Digital</option>
                        <option>Kartu Debit/Kredit</option>
                    </select>
                    <input class="form-control" id="input-tgl-pembayaran" type="date">
                    <button class="btn-primary compact-button" id="btn-filter-pembayaran"><i class="fas fa-filter"></i> Filter</button>
                </div>
                <table class="data-table">
                    <thead>
                        <tr>
                            <th>ID Transaksi</th>
                            <th>Kode Booking</th>
                            <th>Pelanggan</th>
                            <th>Metode</th>
                            <th>Total</th>
                            <th>Tanggal</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (empty($data['pembayaran'])): ?>
                            <tr class="table-empty-row">
                                <td colspan="7">Belum ada riwayat pembayaran.</td>
                            </tr>
                        <?php else: ?>
                            <?php foreach ($data['pembayaran'] as $row): 
                                $status_class = 'status-warning';
                                $status_label = 'Pending';
                                if ($row['status_pembayaran'] === 'valid') {
                                    $status_class = 'status-success';
                                    $status_label = 'Lunas';
                                } elseif ($row['status_pembayaran'] === 'tidak_valid') {
                                    $status_class = 'status-danger';
                                    $status_label = 'Gagal';
                                }
                            ?>
                                <tr>
                                    <td><strong>PAY-<?= str_pad($row['id'], 5, '0', STR_PAD_LEFT); ?></strong></td>
                                    <td><?= htmlspecialchars($row['kode_booking']); ?></td>
                                    <td><?= htmlspecialchars($row['nama_pelanggan']); ?></td>
                                    <td><?= htmlspecialchars($row['metode_pembayaran']); ?></td>
                                    <td>Rp <?= number_format($row['total_harga'], 0, ',', '.'); ?></td>
                                    <td><?= date('d M Y H:i', strtotime($row['waktu_pembayaran'])); ?></td>
                                    <td><span class="status-badge <?= $status_class; ?>"><?= $status_label; ?></span></td>
                                </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                </table>
            </section>