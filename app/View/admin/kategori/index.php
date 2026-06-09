<div class="section-grid two-col">

                <section class="table-container">
                    <div class="table-header">
                        <h2 class="table-title"><i class="fas fa-plus-circle"></i> Tambah Kategori</h2>
                    </div>
                    <form class="form-panel" id="form-kategori" action="<?= BASEURL; ?>/admin/kategori/store" method="post">
                        <div class="form-group">
                            <label for="input-nama-kategori">Nama Kategori</label>
                            <input class="form-control" id="input-nama-kategori" name="nama_kategori" type="text" placeholder="Contoh: Futsal, Badminton..." required>
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
                            <?php if (empty($data['kategori'])): ?>
                                <tr class="table-empty-row">
                                    <td colspan="4">
                                        Belum ada kategori terdaftar.
                                    </td>
                                </tr>
                            <?php else: ?>
                                <?php $i = 1; foreach ($data['kategori'] as $cat): ?>
                                    <tr>
                                        <td><?= $i++; ?></td>
                                        <td><strong><i class="<?= htmlspecialchars($cat['icon']); ?>"></i> <?= htmlspecialchars($cat['nama_kategori']); ?></strong></td>
                                        <td><?= $cat['total_lapangan']; ?></td>
                                        <td>
                                            <a href="<?= BASEURL; ?>/admin/kategori/edit/<?= $cat['id']; ?>" class="btn-icon edit" title="Edit Kategori">
                                                <i class="fas fa-pen"></i>
                                            </a>

                                            <form action="<?= BASEURL; ?>/admin/kategori/delete/<?= $cat['id']; ?>" method="POST" class="d-inline-block" onsubmit="return confirm('Apakah Anda yakin ingin menghapus kategori ini? Tindakan ini akan mempengaruhi lapangan yang menggunakan kategori ini.');">
                                                <button type="submit" class="btn-icon delete" title="Hapus Kategori">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </section>
            </div>
