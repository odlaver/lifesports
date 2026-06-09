<?php if (isset($_SESSION['flash'])) { \App\Core\Flasher::flash(); } ?>

            <section class="form-panel">
                <form action="<?= BASEURL; ?>/pengelola/profile/update" method="POST">
                    <div class="form-grid">
                        <div class="form-group">
                            <label class="form-label">Nama</label>
                            <input class="form-control" name="nama" value="<?= isset($data['user']['nama']) ? htmlspecialchars($data['user']['nama']) : ''; ?>" required>
                        </div>

                        <div class="form-group">
                            <label class="form-label">Email</label>
                            <input class="form-control" type="email" name="email" value="<?= isset($data['user']['email']) ? htmlspecialchars($data['user']['email']) : ''; ?>" required>
                        </div>

                        <div class="form-group full">
                            <label class="form-label">Info Dompet Digital (Wajib)</label>
                            <input class="form-control" name="info_pembayaran" value="<?= isset($data['user']['info_pembayaran']) ? htmlspecialchars($data['user']['info_pembayaran']) : ''; ?>" placeholder="Contoh: DANA - 0812345678 a.n Taufik" required>
                            <small>Satu opsi dompet digital yang digunakan pelanggan untuk membayar pesanan ke Anda.</small>
                        </div>

                        <div class="form-group full">
                            <label class="form-label">Password Baru (Opsional)</label>
                            <input class="form-control" type="password" name="password" placeholder="Kosongkan jika tidak ingin mengubah password">
                        </div>
                    </div>

                    <button class="btn-primary" type="submit"><i class="fas fa-save"></i> Simpan Perubahan</button>
                </form>
            </section>
