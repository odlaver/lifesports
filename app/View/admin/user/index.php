<?php
$total_users = count($data['users']);
$total_pelanggan = 0;
$total_pengelola = 0;
$total_admin = 0;
foreach ($data['users'] as $u) {
    if ($u['role'] === 'pelanggan') $total_pelanggan++;
    elseif ($u['role'] === 'pengelola') $total_pengelola++;
    elseif ($u['role'] === 'admin') $total_admin++;
}
?>


    
        

        
            

            <div class="dash-stats">
                <div class="dash-card">
                    <div class="dash-card-icon"><i class="fas fa-users"></i></div>
                    <div class="dash-card-info">
                        <h3>Total User</h3>
                        <div class="value"><?= $total_users; ?></div>
                        <small>Semua role terdaftar</small>
                    </div>
                </div>
                <div class="dash-card">
                    <div class="dash-card-icon"><i class="fas fa-user-friends"></i></div>
                    <div class="dash-card-info">
                        <h3>Pelanggan</h3>
                        <div class="value"><?= $total_pelanggan; ?></div>
                        <small>Pengguna aktif</small>
                    </div>
                </div>
                <div class="dash-card">
                    <div class="dash-card-icon warning"><i class="fas fa-user-tie"></i></div>
                    <div class="dash-card-info">
                        <h3>Pengelola</h3>
                        <div class="value value-warning"><?= $total_pengelola; ?></div>
                        <small>Mitra penyedia lapangan</small>
                    </div>
                </div>
                <div class="dash-card">
                    <div class="dash-card-icon"><i class="fas fa-user-shield"></i></div>
                    <div class="dash-card-info">
                        <h3>Admin</h3>
                        <div class="value"><?= $total_admin; ?></div>
                        <small>Administrator sistem</small>
                    </div>
                </div>
            </div>

            <section class="table-container">
                <div class="table-header">
                    <h2 class="table-title"><i class="fas fa-list"></i> Daftar User</h2>
                </div>
                <form method="GET" action="<?= BASEURL; ?>/admin/user">
                    <div class="filter-bar compact">
                        <input class="form-control" name="search" id="input-search-user" placeholder="Cari nama atau email..." value="<?= isset($data['filter']['keyword']) ? htmlspecialchars($data['filter']['keyword']) : ''; ?>">
                        <select class="form-control" name="role" id="select-role-user">
                            <option <?= (isset($data['filter']['role']) && $data['filter']['role'] == 'Semua Role') || empty($data['filter']['role']) ? 'selected' : ''; ?>>Semua Role</option>
                            <option <?= (isset($data['filter']['role']) && $data['filter']['role'] == 'Pelanggan') ? 'selected' : ''; ?>>Pelanggan</option>
                            <option <?= (isset($data['filter']['role']) && $data['filter']['role'] == 'Pengelola') ? 'selected' : ''; ?>>Pengelola</option>
                            <option <?= (isset($data['filter']['role']) && $data['filter']['role'] == 'Admin') ? 'selected' : ''; ?>>Admin</option>
                        </select>
                        <button type="submit" class="btn-primary compact-button" id="btn-filter-user"><i class="fas fa-filter"></i> Filter</button>
                    </div>
                </form>
                <table class="data-table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th>Bergabung</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (empty($data['users'])): ?>
                            <tr class="table-empty-row">
                                <td colspan="6">
                                    Belum ada user terdaftar.
                                </td>
                            </tr>
                        <?php else: ?>
                            <?php $i = 1; foreach ($data['users'] as $user): 
                                $role_class = 'info';
                                if ($user['role'] === 'pengelola') {
                                    $role_class = 'success';
                                } elseif ($user['role'] === 'admin') {
                                    $role_class = 'warning';
                                }
                            ?>
                                <tr>
                                    <td><?= $i++; ?></td>
                                    <td><strong><?= htmlspecialchars($user['nama']); ?></strong></td>
                                    <td><?= htmlspecialchars($user['email']); ?></td>
                                    <td><span class="sport-chip <?= $role_class; ?>"><?= ucfirst(htmlspecialchars($user['role'])); ?></span></td>
                                    <td><?= date('d M Y', strtotime($user['created_at'])); ?></td>
                                    <td>
                                        <a href="<?= BASEURL; ?>/admin/user/edit/<?= $user['id']; ?>" class="btn-icon edit" title="Edit User">
                                            <i class="fas fa-pen"></i>
                                        </a>

                                        <form action="<?= BASEURL; ?>/admin/user/delete/<?= $user['id']; ?>" method="POST" class="d-inline-block" onsubmit="return confirm('Apakah Anda yakin ingin menghapus pengguna ini?');">
                                            <button type="submit" class="btn-icon delete" title="Hapus User">
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
