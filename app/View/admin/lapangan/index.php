<?php
$total_lapangan = count($data['lapangan']);
$total_aktif = 0;
$total_nonaktif = 0;
$kategori_set = [];
foreach ($data['lapangan'] as $l) {
    if ($l['status'] === 'aktif') $total_aktif++;
    elseif ($l['status'] === 'nonaktif') $total_nonaktif++;
    $kategori_set[$l['nama_kategori']] = true;
}
$total_kategori = count($kategori_set);
?>


    
        

        
            

            <div class="dash-stats">
                <div class="dash-card">
                    <div class="dash-card-icon"><i class="fas fa-building"></i></div>
                    <div class="dash-card-info">
                        <h3>Total Lapangan</h3>
                        <div class="value"><?= $total_lapangan; ?></div>
                    </div>
                </div>
                <div class="dash-card">
                    <div class="dash-card-icon"><i class="fas fa-check-circle"></i></div>
                    <div class="dash-card-info">
                        <h3>Aktif (Tersedia)</h3>
                        <div class="value"><?= $total_aktif; ?></div>
                    </div>
                </div>
                <div class="dash-card">
                    <div class="dash-card-icon warning"><i class="fas fa-tags"></i></div>
                    <div class="dash-card-info">
                        <h3>Kategori Jenis</h3>
                        <div class="value value-warning"><?= $total_kategori; ?></div>
                    </div>
                </div>
                <div class="dash-card">
                    <div class="dash-card-icon"><i class="fas fa-power-off"></i></div>
                    <div class="dash-card-info">
                        <h3>Nonaktif</h3>
                        <div class="value"><?= $total_nonaktif; ?></div>
                    </div>
                </div>
            </div>

            <section class="table-container">
                <div class="table-header">
                    <h2 class="table-title"><i class="fas fa-list"></i> Daftar Lapangan</h2>
                </div>
                <form method="GET" action="<?= BASEURL; ?>/admin/lapangan">
                    <div class="filter-bar compact">
                        <input class="form-control" name="search" id="input-search-lapangan" placeholder="Cari nama lapangan atau pengelola..." value="<?= isset($data['filter']['keyword']) ? htmlspecialchars($data['filter']['keyword']) : ''; ?>">
                        <select class="form-control" name="sport" id="select-kategori-lapangan">
                            <option <?= (isset($data['filter']['kategori']) && $data['filter']['kategori'] == 'Semua Kategori') || empty($data['filter']['kategori']) ? 'selected' : ''; ?>>Semua Kategori</option>
                            <?php foreach ($data['kategori'] as $k): ?>
                                <option <?= (isset($data['filter']['kategori']) && $data['filter']['kategori'] == $k['nama_kategori']) ? 'selected' : ''; ?>><?= htmlspecialchars($k['nama_kategori']); ?></option>
                            <?php endforeach; ?>
                        </select>
                        <select class="form-control" name="status" id="select-status-lapangan">
                            <option <?= (isset($data['filter']['status']) && $data['filter']['status'] == 'Semua Status') || empty($data['filter']['status']) ? 'selected' : ''; ?>>Semua Status</option>
                            <option <?= (isset($data['filter']['status']) && $data['filter']['status'] == 'Aktif') ? 'selected' : ''; ?>>Aktif</option>
                            <option <?= (isset($data['filter']['status']) && $data['filter']['status'] == 'Nonaktif') ? 'selected' : ''; ?>>Nonaktif</option>
                        </select>
                        <button type="submit" class="btn-primary compact-button" id="btn-filter-lapangan"><i class="fas fa-filter"></i> Filter</button>
                    </div>
                </form>
                <table class="data-table">
                    <thead>
                        <tr>
                            <th>Lapangan</th>
                            <th>Pengelola</th>
                            <th>Kategori</th>
                            <th>Harga/Jam</th>
                            <th>Rating</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (empty($data['lapangan'])): ?>
                            <tr class="table-empty-row">
                                <td colspan="7">
                                    Belum ada lapangan terdaftar.
                                </td>
                            </tr>
                        <?php else: ?>
                            <?php foreach ($data['lapangan'] as $row): 
                                $status_class = $row['status'] === 'aktif' ? 'status-success' : 'status-danger';
                                $status_label = $row['status'] === 'aktif' ? 'Aktif' : 'Nonaktif';
                            ?>
                                <tr>
                                    <td><strong><?= htmlspecialchars($row['nama_lapangan']); ?></strong></td>
                                    <td><?= htmlspecialchars($row['nama_pengelola']); ?></td>
                                    <td><span class="sport-chip info"><?= htmlspecialchars($row['nama_kategori']); ?></span></td>
                                    <td>Rp <?= number_format($row['harga_per_jam'], 0, ',', '.'); ?></td>
                                    <td><i class="fas fa-star icon-gold"></i> <?= number_format($row['rating'], 1); ?></td>
                                    <td><span class="status-badge <?= $status_class; ?>"><?= $status_label; ?></span></td>
                                    <td>
                                        <a href="<?= BASEURL; ?>/admin/lapangan/<?= $row['id']; ?>" class="btn-action" title="Detail"><i class="fas fa-eye"></i></a>
                                        <form action="<?= BASEURL; ?>/admin/lapangan/status/<?= $row['id']; ?>" method="POST" class="d-inline-block" onsubmit="return confirm('Apakah Anda yakin ingin mengubah status ketersediaan lapangan ini?');">
                                            <button type="submit" class="btn-action bg-transparent border-none cursor-pointer" title="Ubah Status">
                                                <i class="fas <?= $row['status'] === 'aktif' ? 'fa-power-off' : 'fa-check'; ?>"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                </table>
            </section>
