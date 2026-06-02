<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Kategori - Admin Lifesports</title>
    <link rel="stylesheet" href="<?= BASEURL; ?>/public/assets/css/styles.css?v=3">
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
                <li><a href="<?= BASEURL; ?>/admin/users"><i class="fas fa-users"></i> Kelola User</a></li>
                <li><a href="<?= BASEURL; ?>/admin/kategori" class="active"><i class="fas fa-tags"></i> Kategori</a></li>
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
                    <h1>Edit Kategori</h1>
                    <p>Ubah data kategori olahraga pada sistem Lifesports.</p>
                </div>
            </header>

            <?php Flasher::flash(); ?>

            <section class="form-panel" style="max-width: 650px;">
                <h2 class="table-title" style="margin-bottom: 25px;">
                    <i class="fas fa-pen"></i> Form Edit Kategori
                </h2>

                <form action="<?= BASEURL; ?>/admin/update_kategori" method="post">
                    <input type="hidden" name="id" value="<?= $data['kategori']['id']; ?>">

                    <div class="form-group">
                        <label for="nama_kategori">Nama Kategori</label>
                        <input 
                            class="form-control" 
                            id="nama_kategori" 
                            name="nama_kategori" 
                            type="text" 
                            value="<?= htmlspecialchars($data['kategori']['nama_kategori']); ?>" 
                            required
                        >
                    </div>

                    <div class="form-group">
                        <label for="icon">Icon (Font Awesome class)</label>
                        <input 
                            class="form-control" 
                            id="icon" 
                            name="icon" 
                            type="text" 
                            value="<?= htmlspecialchars($data['kategori']['icon']); ?>" 
                            placeholder="Contoh: fas fa-futbol"
                        >
                    </div>

                    <div class="form-actions">
                        <button class="btn-primary" type="submit">
                            <i class="fas fa-save"></i> Simpan Perubahan
                        </button>

                        <a href="<?= BASEURL; ?>/admin/kategori" class="btn-primary ghost-light" style="text-decoration: none;">
                            <i class="fas fa-arrow-left"></i> Kembali
                        </a>
                    </div>
                </form>
            </section>
        </main>
    </div>
</body>

</html>