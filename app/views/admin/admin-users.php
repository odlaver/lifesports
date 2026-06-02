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
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola User - Admin Lifesports</title>
    <link rel="stylesheet" href="<?= BASEURL; ?>/public/assets/css/styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>
    <div class="dashboard-container">
        <aside class="sidebar">
            <div class="sidebar-header">
                <div class="sidebar-brand">Lifesports</div>
                <div class="role-label">SUPER ADMIN</div>
            </div>
            <ul class="sidebar-menu">
                <li><a href="<?= BASEURL; ?>/admin"><i class="fas fa-home"></i> Dashboard</a></li>
                <li><a href="<?= BASEURL; ?>/admin/users" class="active"><i class="fas fa-users"></i> Kelola User</a></li>
                <li><a href="<?= BASEURL; ?>/admin/kategori"><i class="fas fa-tags"></i> Kategori</a></li>
                <li><a href="<?= BASEURL; ?>/admin/lapangan"><i class="fas fa-building"></i> Semua Lapangan</a></li>
                <li><a href="<?= BASEURL; ?>/admin/booking"><i class="fas fa-calendar-check"></i> Semua Booking</a></li>
                <li><a href="<?= BASEURL; ?>/admin/pembayaran"><i class="fas fa-credit-card"></i> Semua Pembayaran</a></li>
                <li><a href="<?= BASEURL; ?>/admin/laporan"><i class="fas fa-file-invoice"></i> Laporan</a></li>
                <li><a href="<?= BASEURL; ?>/auth/logout" class="nav-danger"><i class="fas fa-sign-out-alt"></i> Keluar</a></li>
            </ul>
        </aside>

        <main class="main-content">
            <header class="dashboard-header">
                <div class="dash-title">
                    <h1>Kelola User</h1>
                    <p>Manajemen seluruh akun pengguna sistem</p>
                </div>
                <a href="<?= BASEURL; ?>/admin/user_form" class="btn-primary" id="btn-tambah-user">
                    <i class="fas fa-user-plus"></i> Tambah User
                </a>
            </header>

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
                <div class="filter-bar compact">
                    <input class="form-control" id="input-search-user" placeholder="Cari nama atau email...">
                    <select class="form-control" id="select-role-user">
                        <option>Semua Role</option>
                        <option>Pelanggan</option>
                        <option>Pengelola</option>
                        <option>Admin</option>
                    </select>
                    <select class="form-control" id="select-status-user">
                        <option>Semua Status</option>
                        <option>Aktif</option>
                        <option>Nonaktif</option>
                    </select>
                    <button class="btn-primary compact-button" id="btn-filter-user"><i class="fas fa-filter"></i> Filter</button>
                </div>
                <table class="data-table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th>Bergabung</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (empty($data['users'])): ?>
                            <tr>
                                <td colspan="7" style="text-align: center; color: var(--text-muted); padding: 20px;">
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
                                    <td><span class="status-badge status-success">Aktif</span></td>
                                    <td>
                                        <button 
                                            type="button"
                                            class="btn-icon edit" 
                                            title="Edit User"
                                            onclick="window.location.href='<?= BASEURL; ?>/admin/user_form/<?= $user['id']; ?>'"
                                        >
                                            <i class="fas fa-pen"></i>
                                        </button>

                                        <button 
                                            type="button"
                                            class="btn-icon delete" 
                                            title="Hapus User"
                                            onclick="if(confirm('Yakin ingin menghapus user ini?')) { window.location.href='<?= BASEURL; ?>/admin/hapus_user/<?= $user['id']; ?>'; }"
                                        >
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                </table>
            </section>
        </main>
    </div>
</body>
</html>
