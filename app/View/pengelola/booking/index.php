<section class="table-container">
                <form method="GET" action="<?= BASEURL; ?>/pengelola/booking">
                    <div class="filter-bar compact">
                        <input class="form-control" name="search" placeholder="Cari pelanggan atau kode..." value="<?= isset($data['filter']['keyword']) ? htmlspecialchars($data['filter']['keyword']) : ''; ?>">
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
                    <thead><tr><th>Kode</th><th>Pelanggan</th><th>Lapangan</th><th>Jadwal</th><th>Status</th><th>Aksi</th></tr></thead>
                    <tbody>
                        <?php if (empty($data['booking'])): ?>
                            <tr class="table-empty-row">
                                <td colspan="6">
                                    Belum ada booking masuk.
                                </td>
                            </tr>
                        <?php else: ?>
                            <?php foreach ($data['booking'] as $row): 
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
                                    <td><?= htmlspecialchars($row['nama_pelanggan']); ?></td>
                                    <td><?= htmlspecialchars($row['nama_lapangan']); ?> (<?= htmlspecialchars($row['nama_kategori']); ?>)</td>
                                    <td><?= date('d M Y', strtotime($row['tanggal_main'])); ?>, <?= date('H:i', strtotime($row['jam_mulai'])); ?></td>
                                    <td><span class="status-badge <?= $status_class; ?>"><?= $status_label; ?></span></td>
                                    <td><a href="<?= BASEURL; ?>/pengelola/booking_detail/<?= $row['id']; ?>" class="btn-action"><i class="fas fa-eye"></i></a></td>
                                </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                </table>
            </section>
