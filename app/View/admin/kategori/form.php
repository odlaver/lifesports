<div class="panel-card">
    <div class="panel-header">
        <h2><?= isset($data['kategori']) ? 'Edit Kategori' : 'Tambah Kategori'; ?></h2>
    </div>
    <div class="panel-body">
        <form action="<?= BASEURL; ?>/admin/kategori/<?= isset($data['kategori']) ? 'update/' . $data['kategori']['id'] : 'store'; ?>" method="POST" class="form-panel">
            <div class="form-group">
                <label>Nama Kategori</label>
                <input type="text" name="nama_kategori" class="form-control" value="<?= isset($data['kategori']) ? htmlspecialchars($data['kategori']['nama_kategori']) : ''; ?>" required>
            </div>
            
            <div class="form-group">
                <label>Icon (FontAwesome Class)</label>
                <input type="text" name="icon" class="form-control" value="<?= isset($data['kategori']) ? htmlspecialchars($data['kategori']['icon']) : 'fas fa-futbol'; ?>">
            </div>

            <div class="form-actions">
                <button type="submit" class="btn-primary">
                    <i class="fas fa-save"></i> <?= isset($data['kategori']) ? 'Perbarui' : 'Simpan'; ?>
                </button>
                <a href="<?= BASEURL; ?>/admin/kategori" class="btn-secondary">
                    Batal
                </a>
            </div>
        </form>
    </div>
</div>
