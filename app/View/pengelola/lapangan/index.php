<section class="table-container">
                <form method="GET" action="<?= BASEURL; ?>/pengelola/lapangan" id="filterForm">
                    <div class="filter-bar compact">
                        <input class="form-control" name="search" type="text" placeholder="Cari nama lapangan..." value="<?= isset($data['filter']['search']) ? htmlspecialchars($data['filter']['search']) : ''; ?>">
                        <select class="form-control" name="status">
                            <option <?= (isset($data['filter']['status']) && $data['filter']['status'] == 'Semua Status') || empty($data['filter']['status']) ? 'selected' : ''; ?>>Semua Status</option>
                            <option <?= (isset($data['filter']['status']) && $data['filter']['status'] == 'Tersedia') ? 'selected' : ''; ?>>Tersedia</option>
                            <option <?= (isset($data['filter']['status']) && $data['filter']['status'] == 'Nonaktif') ? 'selected' : ''; ?>>Nonaktif</option>
                        </select>
                        <select class="form-control" name="sport">
                            <option <?= (isset($data['filter']['sport']) && $data['filter']['sport'] == 'Semua Kategori') || empty($data['filter']['sport']) ? 'selected' : ''; ?>>Semua Kategori</option>
                            <?php if (isset($data['kategori'])): ?>
                                <?php foreach ($data['kategori'] as $k): ?>
                                    <option <?= (isset($data['filter']['sport']) && $data['filter']['sport'] == $k['nama_kategori']) ? 'selected' : ''; ?>><?= htmlspecialchars($k['nama_kategori']); ?></option>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <option <?= (isset($data['filter']['sport']) && $data['filter']['sport'] == 'Futsal') ? 'selected' : ''; ?>>Futsal</option>
                                <option <?= (isset($data['filter']['sport']) && $data['filter']['sport'] == 'Tennis') ? 'selected' : ''; ?>>Tennis</option>
                                <option <?= (isset($data['filter']['sport']) && $data['filter']['sport'] == 'Badminton') ? 'selected' : ''; ?>>Badminton</option>
                            <?php endif; ?>
                        </select>
                        <button type="submit" class="btn-primary compact-button"><i class="fas fa-filter"></i> Filter</button>
                    </div>
                </form>
                <table class="data-table">
                    <thead><tr><th>Lapangan</th><th>Kategori</th><th>Harga</th><th>Total Booking</th><th>Status</th><th>Aksi</th></tr></thead>
                    <tbody>
                        <?php if (empty($data['lapangan'])): ?>
                            <tr class="table-empty-row">
                                <td colspan="6">
                                    Belum ada data lapangan yang Anda miliki.
                                </td>
                            </tr>
                        <?php else: ?>
                            <?php foreach ($data['lapangan'] as $row): 
                                $status_class = $row['status'] === 'aktif' ? 'status-success' : 'status-danger';
                                $status_label = $row['status'] === 'aktif' ? 'Tersedia' : 'Nonaktif';
                            ?>
                                <tr>
                                    <td><strong><?= htmlspecialchars($row['nama_lapangan']); ?></strong><br><small><?= htmlspecialchars($row['lokasi'] ?? 'Bandar Lampung'); ?></small></td>
                                    <td><?= htmlspecialchars($row['nama_kategori']); ?></td>
                                    <td>Rp <?= number_format($row['harga_per_jam'], 0, ',', '.'); ?>/jam</td>
                                    <td><?= $row['total_booking']; ?>x</td>
                                    <td>
                                        <a href="<?= BASEURL; ?>/pengelola/lapangan/edit/<?= $row['id']; ?>" class="btn-action" title="Edit"><i class="fas fa-pen"></i></a>
                                        <form action="<?= BASEURL; ?>/pengelola/lapangan/delete/<?= $row['id']; ?>" method="POST" class="d-inline-block" onsubmit="return confirm('Apakah Anda yakin ingin menghapus lapangan ini beserta semua foto dan datanya?');">
                                            <button type="submit" class="btn-action text-danger ml-10 bg-transparent border-none cursor-pointer" title="Hapus">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                </table>
            </section>
