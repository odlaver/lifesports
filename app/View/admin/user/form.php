<?php
$isEdit = !empty($data['user']['id']);
$action = $isEdit ? BASEURL . '/admin/user/update/' . $data['user']['id'] : BASEURL . '/admin/user/store';
?>

<section class="table-container">
    <div class="table-header">
        <h2 class="table-title"><i class="fas fa-user-edit"></i> Data Akun</h2>
    </div>
    <form action="<?= $action; ?>" method="post">
        <div class="form-grid two-col">
            <div class="form-group">
                <label for="nama">Nama Lengkap</label>
                <input class="form-control" id="nama" name="nama" type="text" placeholder="Nama lengkap pengguna" value="<?= htmlspecialchars($data['user']['nama'] ?? ''); ?>" required>
            </div>

            <div class="form-group">
                <label for="email">Email</label>
                <input class="form-control" id="email" name="email" type="email" placeholder="email@domain.com" value="<?= htmlspecialchars($data['user']['email'] ?? ''); ?>" required>
            </div>

            <div class="form-group">
                <label for="no_telp">No. HP</label>
                <input class="form-control" id="no_telp" name="no_telp" type="text" placeholder="08xxxxxxxxxx" value="<?= htmlspecialchars($data['user']['no_telp'] ?? ''); ?>">
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
                <label for="password">Password <?= $isEdit ? '(Opsional)' : ''; ?></label>
                <input class="form-control" id="password" name="password" type="password" placeholder="<?= $isEdit ? 'Kosongkan jika tidak diganti' : 'Masukkan password'; ?>" <?= $isEdit ? '' : 'required'; ?>>
            </div>
        </div>

        <div class="form-actions">
            <button class="btn-primary" type="submit">
                <i class="fas fa-save"></i> Simpan
            </button>

            <a href="<?= BASEURL; ?>/admin/users" class="btn-primary ghost-light">
                <i class="fas fa-times"></i> Batal
            </a>
        </div>
    </form>
</section>
