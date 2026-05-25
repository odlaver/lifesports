<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Kategori - Admin Lifesports</title>
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
                <li><a href="<?= BASEURL; ?>/admin/users"><i class="fas fa-users"></i> Kelola User</a></li>
                <li><a href="<?= BASEURL; ?>/admin/kategori" class="active"><i class="fas fa-tags"></i> Kategori</a></li>
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
                    <h1>Kelola Kategori</h1>
                    <p>Atur kategori olahraga yang tersedia di platform</p>
                </div>
            </header>

            <div class="section-grid two-col">

                <section class="table-container">
                    <div class="table-header">
                        <h2 class="table-title"><i class="fas fa-plus-circle"></i> Tambah Kategori</h2>
                    </div>
                    <form class="form-panel" id="form-kategori" action="#" method="post">
                        <div class="form-group">
                            <label for="input-nama-kategori">Nama Kategori</label>
                            <input class="form-control" id="input-nama-kategori" name="nama" type="text" placeholder="Contoh: Futsal, Badminton..." required>
                        </div>
                        <div class="form-group">
                            <label for="input-icon-kategori">Icon (Font Awesome class)</label>
                            <input class="form-control" id="input-icon-kategori" name="icon" type="text" placeholder="Contoh: fa-futbol">
                        </div>
                        <div class="form-group">
                            <label for="input-deskripsi-kategori">Deskripsi Singkat</label>
                            <textarea class="form-control" id="input-deskripsi-kategori" name="deskripsi" rows="3" placeholder="Deskripsi singkat kategori olahraga..."></textarea>
                        </div>
                        <div class="form-actions">
                            <button class="btn-primary" id="btn-simpan-kategori" type="submit">
                                <i class="fas fa-save"></i> Simpan
                            </button>
                            <button class="btn-primary ghost-light" id="btn-reset-kategori" type="reset">
                                <i class="fas fa-undo"></i> Reset
                            </button>
                        </div>
                    </form>
                </section>

                <section class="table-container">
                    <div class="table-header">
                        <h2 class="table-title"><i class="fas fa-list"></i> Daftar Kategori</h2>
                    </div>
                    <table class="data-table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Nama</th>
                                <th>Total Lapangan</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td><strong><i class="fas fa-futbol"></i> Futsal</strong></td>
                                <td>7</td>
                                <td>
                                    <button class="btn-action" id="btn-edit-kategori-1" title="Edit"><i class="fas fa-pen"></i></button>
                                    <button class="btn-action danger" id="btn-hapus-kategori-1" title="Hapus"><i class="fas fa-trash"></i></button>
                                </td>
                            </tr>
                            <tr>
                                <td>2</td>
                                <td><strong><i class="fas fa-volleyball-ball"></i> Badminton</strong></td>
                                <td>5</td>
                                <td>
                                    <button class="btn-action" id="btn-edit-kategori-2" title="Edit"><i class="fas fa-pen"></i></button>
                                    <button class="btn-action danger" id="btn-hapus-kategori-2" title="Hapus"><i class="fas fa-trash"></i></button>
                                </td>
                            </tr>
                            <tr>
                                <td>3</td>
                                <td><strong><i class="fas fa-baseball-ball"></i> Tennis</strong></td>
                                <td>3</td>
                                <td>
                                    <button class="btn-action" id="btn-edit-kategori-3" title="Edit"><i class="fas fa-pen"></i></button>
                                    <button class="btn-action danger" id="btn-hapus-kategori-3" title="Hapus"><i class="fas fa-trash"></i></button>
                                </td>
                            </tr>
                            <tr>
                                <td>4</td>
                                <td><strong><i class="fas fa-basketball-ball"></i> Basket</strong></td>
                                <td>2</td>
                                <td>
                                    <button class="btn-action" id="btn-edit-kategori-4" title="Edit"><i class="fas fa-pen"></i></button>
                                    <button class="btn-action danger" id="btn-hapus-kategori-4" title="Hapus"><i class="fas fa-trash"></i></button>
                                </td>
                            </tr>
                            <tr>
                                <td>5</td>
                                <td><strong><i class="fas fa-swimming-pool"></i> Kolam Renang</strong></td>
                                <td>1</td>
                                <td>
                                    <button class="btn-action" id="btn-edit-kategori-5" title="Edit"><i class="fas fa-pen"></i></button>
                                    <button class="btn-action danger" id="btn-hapus-kategori-5" title="Hapus"><i class="fas fa-trash"></i></button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </section>
            </div>
        </main>
    </div>
</body>
</html>
