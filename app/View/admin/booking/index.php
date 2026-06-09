<?php
$total_booking = count($data['booking']);
$total_pending = 0;
$total_confirmed = 0;
$total_selesai = 0;
foreach ($data['booking'] as $b) {
    if ($b['status'] === 'pending' || $b['status'] === 'dibayar') $total_pending++;
    elseif ($b['status'] === 'dikonfirmasi') $total_confirmed++;
    elseif ($b['status'] === 'selesai') $total_selesai++;
}
?>


    
        

        
            

            <div class="dash-stats">
                <div class="dash-card">
                    <div class="dash-card-icon"><i class="fas fa-calendar-check"></i></div>
                    <div class="dash-card-info">
                        <h3>Total Booking</h3>
                        <div class="value"><?= $total_booking; ?></div>
                    </div>
                </div>
                <div class="dash-card">
                    <div class="dash-card-icon warning"><i class="fas fa-clock"></i></div>
                    <div class="dash-card-info">
                        <h3>Pending / Paid</h3>
                        <div class="value value-warning"><?= $total_pending; ?></div>
                    </div>
                </div>
                <div class="dash-card">
                    <div class="dash-card-icon"><i class="fas fa-check-circle"></i></div>
                    <div class="dash-card-info">
                        <h3>Dikonfirmasi</h3>
                        <div class="value"><?= $total_confirmed; ?></div>
                    </div>
                </div>
                <div class="dash-card">
                    <div class="dash-card-icon"><i class="fas fa-flag-checkered"></i></div>
                    <div class="dash-card-info">
                        <h3>Selesai</h3>
                        <div class="value"><?= $total_selesai; ?></div>
                    </div>
                </div>
            </div>

            <section class="table-container">
                <div class="table-header">
                    <h2 class="table-title"><i class="fas fa-list"></i> Daftar Booking</h2>
                </div>
                <form method="GET" action="<?= BASEURL; ?>/admin/booking">
                    <div class="filter-bar compact">
                        <input class="form-control" name="search" id="input-search-booking" placeholder="Cari kode booking atau pelanggan..." value="<?= isset($data['filter']['keyword']) ? htmlspecialchars($data['filter']['keyword']) : ''; ?>">
                        <select class="form-control" name="status" id="select-status-booking">
                            <option <?= (isset($data['filter']['status']) && $data['filter']['status'] == 'Semua Status') || empty($data['filter']['status']) ? 'selected' : ''; ?>>Semua Status</option>
                            <option <?= (isset($data['filter']['status']) && $data['filter']['status'] == 'Pending') ? 'selected' : ''; ?>>Pending</option>
                            <option <?= (isset($data['filter']['status']) && $data['filter']['status'] == 'Confirmed') ? 'selected' : ''; ?>>Confirmed</option>
                            <option <?= (isset($data['filter']['status']) && $data['filter']['status'] == 'Selesai') ? 'selected' : ''; ?>>Selesai</option>
                            <option <?= (isset($data['filter']['status']) && $data['filter']['status'] == 'Dibatalkan') ? 'selected' : ''; ?>>Dibatalkan</option>
                        </select>
                        <input class="form-control" id="input-tgl-booking" type="date" name="tanggal" value="<?= isset($data['filter']['tanggal']) ? htmlspecialchars($data['filter']['tanggal']) : ''; ?>">
                        <button type="submit" class="btn-primary compact-button" id="btn-filter-booking"><i class="fas fa-filter"></i> Filter</button>
                    </div>
                </form>
                <table class="data-table">
                    <thead>
                        <tr>
                            <th>Kode</th>
                            <th>Pelanggan</th>
                            <th>Lapangan</th>
                            <th>Pengelola</th>
                            <th>Tanggal</th>
                            <th>Jam</th>
                            <th>Total</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (empty($data['booking'])): ?>
                            <tr class="table-empty-row">
                                <td colspan="9">
                                    Belum ada data booking.
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
                                    <td><?= htmlspecialchars($row['nama_pengelola']); ?></td>
                                    <td><?= date('d M Y', strtotime($row['tanggal_main'])); ?></td>
                                    <td><?= date('H:i', strtotime($row['jam_mulai'])); ?> - <?= date('H:i', strtotime($row['jam_selesai'])); ?></td>
                                    <td>Rp <?= number_format($row['total_harga'], 0, ',', '.'); ?></td>
                                    <td><span class="status-badge <?= $status_class; ?>"><?= $status_label; ?></span></td>
                                    <td>
                                        <a href="<?= BASEURL; ?>/admin/booking/<?= $row['id']; ?>" class="btn-action" title="Detail"><i class="fas fa-eye"></i></a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                </table>
            </section>
