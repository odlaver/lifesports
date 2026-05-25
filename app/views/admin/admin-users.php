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
                <li><a href="<?= BASEURL; ?>/auth/login" class="nav-danger"><i class="fas fa-sign-out-alt"></i> Keluar</a></li>
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
                        <div class="value">124</div>
                        <small>Semua role</small>
                    </div>
                </div>
                <div class="dash-card">
                    <div class="dash-card-icon"><i class="fas fa-user-check"></i></div>
                    <div class="dash-card-info">
                        <h3>Aktif</h3>
                        <div class="value">118</div>
                        <small>User aktif</small>
                    </div>
                </div>
                <div class="dash-card">
                    <div class="dash-card-icon warning"><i class="fas fa-user-tie"></i></div>
                    <div class="dash-card-info">
                        <h3>Pengelola</h3>
                        <div class="value value-warning">12</div>
                        <small>Mitra pengelola</small>
                    </div>
                </div>
                <div class="dash-card">
                    <div class="dash-card-icon"><i class="fas fa-user-slash"></i></div>
                    <div class="dash-card-info">
                        <h3>Nonaktif</h3>
                        <div class="value">6</div>
                        <small>Akun dinonaktifkan</small>
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
                        <tr>
                            <td>1</td>
                            <td><strong>Andi Saputra</strong></td>
                            <td>andi@email.com</td>
                            <td><span class="sport-chip info">Pelanggan</span></td>
                            <td>10 Jan 2026</td>
                            <td><span class="status-badge status-success">Aktif</span></td>
                            <td>
                                <a href="<?= BASEURL; ?>/admin/user_form" class="btn-action" title="Edit"><i class="fas fa-pen"></i></a>
                                <button class="btn-action warning" title="Nonaktifkan"><i class="fas fa-ban"></i></button>
                                <button class="btn-action danger" title="Hapus"><i class="fas fa-trash"></i></button>
                            </td>
                        </tr>
                        <tr>
                            <td>2</td>
                            <td><strong>Budi Santoso</strong></td>
                            <td>budi@email.com</td>
                            <td><span class="sport-chip info">Pelanggan</span></td>
                            <td>12 Jan 2026</td>
                            <td><span class="status-badge status-success">Aktif</span></td>
                            <td>
                                <a href="<?= BASEURL; ?>/admin/user_form" class="btn-action" title="Edit"><i class="fas fa-pen"></i></a>
                                <button class="btn-action warning" title="Nonaktifkan"><i class="fas fa-ban"></i></button>
                                <button class="btn-action danger" title="Hapus"><i class="fas fa-trash"></i></button>
                            </td>
                        </tr>
                        <tr>
                            <td>3</td>
                            <td><strong>Bpk. Sudirman</strong></td>
                            <td>sudirman@email.com</td>
                            <td><span class="sport-chip success">Pengelola</span></td>
                            <td>5 Feb 2026</td>
                            <td><span class="status-badge status-success">Aktif</span></td>
                            <td>
                                <a href="<?= BASEURL; ?>/admin/user_form" class="btn-action" title="Edit"><i class="fas fa-pen"></i></a>
                                <button class="btn-action warning" title="Nonaktifkan"><i class="fas fa-ban"></i></button>
                                <button class="btn-action danger" title="Hapus"><i class="fas fa-trash"></i></button>
                            </td>
                        </tr>
                        <tr>
                            <td>4</td>
                            <td><strong>Citra Lestari</strong></td>
                            <td>citra@email.com</td>
                            <td><span class="sport-chip info">Pelanggan</span></td>
                            <td>20 Feb 2026</td>
                            <td><span class="status-badge status-success">Aktif</span></td>
                            <td>
                                <a href="<?= BASEURL; ?>/admin/user_form" class="btn-action" title="Edit"><i class="fas fa-pen"></i></a>
                                <button class="btn-action warning" title="Nonaktifkan"><i class="fas fa-ban"></i></button>
                                <button class="btn-action danger" title="Hapus"><i class="fas fa-trash"></i></button>
                            </td>
                        </tr>
                        <tr>
                            <td>5</td>
                            <td><strong>Deni Ramdani</strong></td>
                            <td>deni@email.com</td>
                            <td><span class="sport-chip info">Pelanggan</span></td>
                            <td>1 Mar 2026</td>
                            <td><span class="status-badge status-danger">Nonaktif</span></td>
                            <td>
                                <a href="<?= BASEURL; ?>/admin/user_form" class="btn-action" title="Edit"><i class="fas fa-pen"></i></a>
                                <button class="btn-action" title="Aktifkan"><i class="fas fa-check-circle"></i></button>
                                <button class="btn-action danger" title="Hapus"><i class="fas fa-trash"></i></button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </section>
        </main>
    </div>
</body>
</html>
