<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form User - Admin Lifesports</title>
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
                    <h1>Form User</h1>
                    <p>Tambah atau edit data akun pengguna</p>
                </div>
                <a href="<?= BASEURL; ?>/admin/users" class="btn-primary ghost-light" id="btn-back-users">
                    <i class="fas fa-arrow-left"></i> Kembali
                </a>
            </header>

            <section class="table-container">
                <div class="table-header">
                    <h2 class="table-title"><i class="fas fa-user-edit"></i> Data Akun</h2>
                </div>
               <form action="<?= BASEURL; ?>/admin/simpan_user" method="post">
                <input type="hidden" name="id" value="<?= $data['user']['id'] ?? ''; ?>">
    <div class="form-grid two-col">
        <div class="form-group">
            <label for="nama">Nama Lengkap</label>
            <input 
                class="form-control" 
                name="nama" 
                type="text" 
                placeholder="Nama lengkap pengguna"
                value="<?= $data['user']['nama'] ?? ''; ?>"
                required
            >
        </div>

        <div class="form-group">
            <label for="email">Email</label>
            <input 
                class="form-control" 
                name="email" 
                type="email" 
                placeholder="email@domain.com"
                value="<?= $data['user']['email'] ?? ''; ?>"
                required
            >
        </div>

        <div class="form-group">
            <label for="no_telp">No. HP</label>
           <input 
                class="form-control" 
                name="no_telp" 
                type="text" 
                placeholder="08xxxxxxxxxx"
                value="<?= $data['user']['no_telp'] ?? ''; ?>"
            >
        </div>

        <div class="form-group">
            <label for="role">Role</label>
            <select class="form-control" id="role" name="role" required>
                <option value="">-- Pilih Role --</option>
                <option value="pelanggan" <?= (($data['user']['role'] ?? '') == 'pelanggan') ? 'selected' : ''; ?>>Pelanggan</option>
                <option value="pengelola" <?= (($data['user']['role'] ?? '') == 'pengelola') ? 'selected' : ''; ?>>Pengelola</option>
                <option value="admin" <?= (($data['user']['role'] ?? '') == 'admin') ? 'selected' : ''; ?>>Admin</option>
            </select>
        </div>

        <div class="form-group">
            <label for="status">Status Akun</label>
            <select class="form-control" id="status" name="status">
                <option value="aktif">Aktif</option>
                <option value="nonaktif">Nonaktif</option>
            </select>
        </div>

        <div class="form-group">
            <label for="password">Password</label>
            <input 
                class="form-control" 
                id="password" 
                name="password" 
                type="password" 
                placeholder="Masukkan password" 
                required
            >
        </div>
    </div>

    <div class="form-actions">
        <button class="btn-primary" type="submit">
            <i class="fas fa-save"></i> Simpan
        </button>

        <a href="<?= BASEURL; ?>/admin/users" class="btn-primary ghost-light" style="text-decoration: none;">
            <i class="fas fa-times"></i> Batal
        </a>
    </div>
</form>
            </section>
        </main>
    </div>
</body>
</html>
