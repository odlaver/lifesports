<a href="<?= BASEURL; ?>/" class="auth-back">
        <i class="fas fa-arrow-left"></i> Kembali
    </a>

    <div class="auth-wrapper">
        <div class="auth-card">
            <div class="auth-header">
                <h1 class="auth-title">Selamat Datang</h1>
                <h2 class="auth-subtitle">Kembali</h2>
            </div>

            <?php \App\Core\Flasher::flash(); ?>

            <form action="<?= BASEURL; ?>/auth/prosesLogin" method="POST">
                <div class="form-group">
                    <label class="form-label" for="email">Alamat Email</label>
                    <input type="email" id="email" name="email" class="form-control" placeholder="Masukkan email Anda" required>
                </div>

                <div class="form-group">
                    <label class="form-label" for="password">Kata Sandi</label>
                    <input type="password" id="password" name="password" class="form-control" placeholder="Masukkan kata sandi"
                        required>
                </div>

                <div class="auth-meta">
                    <a href="<?= BASEURL; ?>/auth/login">Lupa Sandi?</a>
                </div>

                <button type="submit" class="btn-primary btn-auth">
                    Masuk Sekarang
                </button>
            </form>


            <div class="auth-footer">
                Belum memiliki akun? <a href="<?= BASEURL; ?>/auth/register">Daftar Gratis</a>
            </div>
        </div>
    </div>