<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar - Lifesports Premium Club</title>
    <link rel="stylesheet" href="<?= BASEURL; ?>/public/assets/css/styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>

<body>

    <div class="watermark">LIFESPORTS</div>

    <a href="../public/index.html" class="auth-back">
        <i class="fas fa-arrow-left"></i> Kembali
    </a>

    <div class="auth-wrapper">
        <div class="auth-card">
            <div class="auth-header">
                <h1 class="auth-title">Bergabunglah</h1>
                <h2 class="auth-subtitle">Bersama Kami</h2>
            </div>

            <?php Flasher::flash(); ?>

            <form action="<?= BASEURL; ?>/auth/prosesRegister" method="POST">
                <div class="form-group">
                    <label class="form-label" for="nama">Nama Lengkap</label>
                    <input type="text" id="nama" name="nama" class="form-control" placeholder="Masukkan nama Anda" required>
                </div>

                <div class="form-group">
                    <label class="form-label" for="email">Alamat Email</label>
                    <input type="email" id="email" name="email" class="form-control" placeholder="Masukkan email Anda" required>
                </div>

                <div class="form-group">
                    <label class="form-label" for="password">Kata Sandi</label>
                    <input type="password" id="password" name="password" class="form-control" placeholder="Buat kata sandi baru"
                        required>
                </div>

                <div class="form-group">
                    <label class="form-label" for="confirm-password">Konfirmasi Sandi</label>
                    <input type="password" id="confirm-password" name="confirm-password" class="form-control" placeholder="Ulangi kata sandi"
                        required>
                </div>

                <button type="submit" class="btn-primary btn-auth">
                    Buat Akun
                </button>
            </form>


            <div class="auth-footer">
                Sudah memiliki akun? <a href="<?= BASEURL; ?>/auth/login">Masuk di sini</a>
            </div>
        </div>
    </div>

</body>

</html>
