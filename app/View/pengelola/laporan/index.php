<div class="metric-grid">
                <div class="metric-box"><span>Total Pendapatan</span><strong>Rp <?= number_format($data['pendapatan_total'], 0, ',', '.'); ?></strong></div>
                <div class="metric-box"><span>Total Booking</span><strong><?= $data['total_booking']; ?></strong></div>
                <div class="metric-box"><span>Lapangan Terpopuler</span><strong><?= htmlspecialchars($data['lapangan_populer']); ?></strong></div>
            </div>
            <section class="table-container">
                <table class="data-table">
                    <thead><tr><th>Bulan</th><th>Total Booking</th><th>Pendapatan</th><th>Rating Rata-rata</th></tr></thead>
                    <tbody>
                        <?php if (empty($data['monthly'])): ?>
                            <tr class="table-empty-row">
                                <td colspan="4">
                                    Belum ada data bulanan.
                                </td>
                            </tr>
                        <?php else: ?>
                            <?php foreach ($data['monthly'] as $row): ?>
                                <tr>
                                    <td><?= htmlspecialchars($row['bulan']); ?></td>
                                    <td><?= $row['booking_count']; ?>x sewa</td>
                                    <td>Rp <?= number_format($row['pendapatan'], 0, ',', '.'); ?></td>
                                    <td><i class="fas fa-star text-gold-color"></i> <?= number_format($row['rating'], 1); ?></td>
                                </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                </table>
            </section>