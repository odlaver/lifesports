<?php
$isEdit = !empty($data['lapangan']);
$action = $isEdit ? BASEURL . '/pengelola/lapangan/update/' . $data['lapangan']['id'] : BASEURL . '/pengelola/lapangan/store';
?>

<section class="form-panel">
                <form action="<?= $action; ?>" method="POST" enctype="multipart/form-data">
                    <?php if (!empty($data['lapangan'])): ?>
                        <input type="hidden" name="id" value="<?= $data['lapangan']['id']; ?>">
                    <?php endif; ?>
                    
                    <div class="form-grid">
                        <div class="form-group">
                            <label class="form-label">Nama Lapangan</label>
                            <input class="form-control" name="nama_lapangan" value="<?= isset($data['lapangan']['nama_lapangan']) ? htmlspecialchars($data['lapangan']['nama_lapangan']) : ''; ?>" required>
                        </div>
                        
                        <div class="form-group">
                            <label class="form-label">Kategori</label>
                            <select class="form-control" name="id_kategori" required>
                                <?php foreach ($data['kategori'] as $kat): ?>
                                    <option value="<?= $kat['id']; ?>" <?= (!empty($data['lapangan']) && $data['lapangan']['id_kategori'] == $kat['id']) ? 'selected' : ''; ?>>
                                        <?= htmlspecialchars($kat['nama_kategori']); ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        
                        <div class="form-group">
                            <label class="form-label">Lokasi / Area</label>
                            <input class="form-control" name="lokasi" value="<?= isset($data['lapangan']['lokasi']) ? htmlspecialchars($data['lapangan']['lokasi']) : 'Bandar Lampung'; ?>" placeholder="Misal: Kedaton, Kemiling..." required>
                        </div>
                        
                        <div class="form-group">
                            <label class="form-label">Harga / Jam</label>
                            <input class="form-control" type="number" name="harga_per_jam" value="<?= isset($data['lapangan']['harga_per_jam']) ? htmlspecialchars($data['lapangan']['harga_per_jam']) : ''; ?>" required>
                        </div>
                        
                        <div class="form-group">
                            <label class="form-label">Status</label>
                            <select class="form-control" name="status" required>
                                <option value="aktif" <?= (!empty($data['lapangan']) && $data['lapangan']['status'] === 'aktif') ? 'selected' : ''; ?>>Tersedia</option>
                                <option value="nonaktif" <?= (!empty($data['lapangan']) && $data['lapangan']['status'] === 'nonaktif') ? 'selected' : ''; ?>>Nonaktif</option>
                            </select>
                        </div>
                        
                        <div class="form-group full">
                            <label class="form-label">Fasilitas (pisahkan dengan koma)</label>
                            <input class="form-control" name="fasilitas" value="<?= isset($data['lapangan']['fasilitas']) ? htmlspecialchars($data['lapangan']['fasilitas']) : ''; ?>" placeholder="Sintetis, Shower, WiFi">
                        </div>
                        
                        <div class="form-group full">
                            <label class="form-label">Deskripsi</label>
                            <textarea class="form-control" name="deskripsi" rows="4"><?= isset($data['lapangan']['deskripsi']) ? htmlspecialchars($data['lapangan']['deskripsi']) : ''; ?></textarea>
                        </div>
                        
                        <div class="form-group full">
                            <label class="form-label">Foto Utama</label>
                            <input class="form-control" type="file" name="foto_utama">
                        </div>
                    </div>
                    
                    <button class="btn-primary" type="submit"><i class="fas fa-save"></i> Simpan Lapangan</button>
                </form>
            </section>
