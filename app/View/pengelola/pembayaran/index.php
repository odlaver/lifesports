<section class="table-container">
                <table class="data-table">
                    <thead><tr><th>Kode</th><th>Pelanggan</th><th>Nominal</th><th>Metode</th><th>Status</th><th>Aksi</th></tr></thead>
                    <tbody>
                        <?php if (empty($data['pembayaran'])): ?>
                            <tr class="table-empty-row">
                                <td colspan="6">
                                    Belum ada data pembayaran masuk.
                                </td>
                            </tr>
                        <?php else: ?>
                            <?php foreach ($data['pembayaran'] as $row): 
                                $status_class = 'status-pending';
                                $status_label = 'Menunggu';
                                if ($row['status_pembayaran'] === 'valid') {
                                    $status_class = 'status-success';
                                    $status_label = 'Valid / Lunas';
                                } elseif ($row['status_pembayaran'] === 'tidak_valid') {
                                    $status_class = 'status-danger';
                                    $status_label = 'Tidak Valid';
                                }
                            ?>
                                <tr>
                                    <td><strong><?= htmlspecialchars($row['kode_booking']); ?></strong></td>
                                    <td><?= htmlspecialchars($row['nama_pelanggan']); ?></td>
                                    <td>Rp <?= number_format($row['total_harga'], 0, ',', '.'); ?></td>
                                    <td><?= htmlspecialchars($row['metode_pembayaran']); ?></td>
                                    <td><span class="status-badge <?= $status_class; ?>"><?= $status_label; ?></span></td>
                                    <td>
                                        <a href="<?= BASEURL; ?>/pengelola/booking_detail/<?= $row['booking_id']; ?>" class="btn-action" title="Tinjau Pembayaran">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                </table>
            </section>