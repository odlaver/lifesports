<?php \App\Core\Flasher::flash(); ?>

            

            <section class="form-panel bg-dark-01 border-radius-12 p-25">
                <form action="<?= BASEURL; ?>/pelanggan/review/store/<?= $data['booking']['id']; ?>" method="POST">
                    <input type="hidden" name="id_booking" value="<?= $data['booking']['id']; ?>">
                    
                    <div class="form-grid d-grid grid-2">
                        <div class="form-group">
                            <label class="form-label" for="field">Lapangan</label>
                            <input id="field" class="form-control bg-dark-03 text-muted-color" value="<?= htmlspecialchars($data['booking']['nama_lapangan']); ?>" readonly>
                        </div>
                        <div class="form-group">
                            <label class="form-label" for="rating">Rating</label>
                            <select id="rating" name="rating" class="form-control bg-dark-05 text-white p-10 border-radius-6" required>
                                <option value="5">5 - Sempurna</option>
                                <option value="4">4 - Sangat Baik</option>
                                <option value="3">3 - Cukup Baik</option>
                                <option value="2">2 - Kurang</option>
                                <option value="1">1 - Buruk</option>
                            </select>
                        </div>
                        <div class="form-group full grid-full mt-10">
                            <label class="form-label" for="comment">Komentar / Ulasan</label>
                            <textarea id="comment" name="ulasan" class="form-control bg-dark-05 text-white p-15 border-radius-6 w-100 min-h-120" placeholder="Tulis pengalaman Anda menyewa lapangan ini..." required></textarea>
                        </div>
                    </div>
                    
                    <button type="submit" class="btn-primary mt-20 border-none cursor-pointer"><i class="fas fa-paper-plane"></i> Kirim Review</button>
                </form>
            </section>
