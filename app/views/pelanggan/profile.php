<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile Saya - Lifesports</title>
    <link rel="stylesheet" href="<?= BASEURL; ?>/public/assets/css/styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>
    <div class="dashboard-container">
        <aside class="sidebar">
            <div class="sidebar-header">
                <div class="sidebar-brand">Lifesports</div>
                <div class="role-label">MEMBER</div>
            </div>
            <ul class="sidebar-menu">
                <li><a href="<?= BASEURL; ?>/pelanggan"><i class="fas fa-home"></i> Dashboard</a></li>
                <li><a href="<?= BASEURL; ?>/pelanggan/booking"><i class="fas fa-calendar-check"></i> Riwayat Booking</a></li>
                <li><a href="<?= BASEURL; ?>/pelanggan/profile" class="active"><i class="fas fa-user"></i> Profile Saya</a></li>
                <li><a href="<?= BASEURL; ?>/pelanggan/lapangan"><i class="fas fa-search"></i> Cari Lapangan</a></li>
                <li><a href="<?= BASEURL; ?>/auth/login" class="nav-danger"><i class="fas fa-sign-out-alt"></i> Keluar</a></li>
            </ul>
        </aside>

        <main class="main-content">
            <header class="dashboard-header">
                <div class="dash-title">
                    <h1>Profile Saya</h1>
                    <p>Kelola data akun dan informasi kontak.</p>
                </div>
            </header>

            <section class="form-panel">
                <form action="<?= BASEURL; ?>/pelanggan">
                    <div class="form-grid">
                        <div class="form-group">
                            <label class="form-label" for="name">Nama Lengkap</label>
                            <input id="name" class="form-control" value="Deni Ramdani">
                        </div>
                        <div class="form-group">
                            <label class="form-label" for="email-profile">Email</label>
                            <input id="email-profile" class="form-control" value="deni@example.com">
                        </div>
                        <div class="form-group">
                            <label class="form-label" for="phone">No. Telepon</label>
                            <input id="phone" class="form-control" value="0812-3344-5566">
                        </div>
                        <div class="form-group">
                            <label class="form-label" for="city">Kota</label>
                            <input id="city" class="form-control" value="Bandar Lampung">
                        </div>
                        <div class="form-group full">
                            <label class="form-label" for="address">Alamat</label>
                            <textarea id="address" class="form-control">Jl. Teuku Umar No. 12</textarea>
                        </div>
                    </div>
                    <button class="btn-primary"><i class="fas fa-save"></i> Simpan Perubahan</button>
                </form>
            </section>
        </main>
    </div>
</body>
</html>
