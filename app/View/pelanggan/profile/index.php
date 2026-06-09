<section class="form-panel">
                <?php \App\Core\Flasher::flash(); ?>
                
                <form action="<?= BASEURL; ?>/pelanggan/profile/update" method="POST">
                    <div class="form-grid">
                        <div class="form-group">
                            <label class="form-label" for="name">Nama Lengkap</label>
                            <input id="name" name="nama" class="form-control" value="<?= htmlspecialchars($data['user']['nama']); ?>" required>
                        </div>
                        <div class="form-group">
                            <label class="form-label" for="email-profile">Email</label>
                            <input id="email-profile" name="email" class="form-control" value="<?= htmlspecialchars($data['user']['email']); ?>" required>
                        </div>
                        <div class="form-group">
                            <label class="form-label" for="phone">No. Telepon</label>
                            <input id="phone" name="no_telp" class="form-control" value="<?= htmlspecialchars($data['user']['no_telp'] ?? ''); ?>">
                        </div>
                        <div class="form-group">
                            <label class="form-label" for="city">Kota</label>
                            <input id="city" class="form-control" value="Bandar Lampung" readonly disabled>
                        </div>
                        <div class="form-group full">
                            <label class="form-label" for="address">Alamat</label>
                            <textarea id="address" class="form-control" readonly disabled>Jl. Teuku Umar No. 12</textarea>
                        </div>
                    </div>
                    <button type="submit" class="btn-primary"><i class="fas fa-save"></i> Simpan Perubahan</button>
                </form>
            </section>
