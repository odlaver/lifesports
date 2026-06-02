SET FOREIGN_KEY_CHECKS = 0;
DELETE FROM review;
DELETE FROM pembayaran;
DELETE FROM booking;
DELETE FROM lapangan;

ALTER TABLE review AUTO_INCREMENT = 1;
ALTER TABLE pembayaran AUTO_INCREMENT = 1;
ALTER TABLE booking AUTO_INCREMENT = 1;
ALTER TABLE lapangan AUTO_INCREMENT = 1;
SET FOREIGN_KEY_CHECKS = 1;

INSERT INTO `lapangan` (`id`, `id_pengelola`, `id_kategori`, `nama_lapangan`, `deskripsi`, `harga_per_jam`, `fasilitas`, `foto_utama`, `status`) VALUES
(1, 2, 1, 'Inter Futsal Kedaton', 'Lapangan futsal indoor standar internasional dengan rumput sintetis premium. Dilengkapi dengan tribun penonton, sistem pencahayaan LED malam hari yang terang, kamar bilas air panas, dan parkir luas aman.', 150000, 'Sintetis,Shower,WiFi,Tribun,Kantin', 'bola.png', 'aktif'),
(2, 2, 2, 'Sukarame Badminton Hall', 'Gedung olahraga bulu tangkis indoor dengan 4 lapangan berlapis karpet vinyl standar PBSI. Bebas hembusan angin langsung, pencahayaan merata anti-silau, tersedia kantin makanan dan loker penyimpanan.', 80000, 'Karpet Vinyl,Loker,Kantin,Parkir,Toilet', 'badminton.jpg', 'aktif'),
(3, 2, 3, 'Way Halim Basketball Court', 'Fasilitas lapangan basket semi-indoor premium di pusat Way Halim. Ring basket hidrolik standar profesional, papan pantul akrilik tebal, permukaan lantai kayu parket berkualitas tinggi dan tribun nyaman.', 120000, 'Parket Kayu,Tribun,Shower,Kantin,WiFi', 'basket.jpg', 'aktif'),
(4, 2, 4, 'Kemiling Tennis Club', 'Lapangan tenis outdoor tanah liat (clay court) terbaik di kawasan Kemiling dengan suasana perbukitan yang sejuk. Sangat cocok untuk latihan pagi maupun turnamen komunitas akhir pekan.', 100000, 'Clay Court,Kamar Mandi,Kantin,Parkir Luas', 'tenis.jpg', 'aktif'),
(5, 2, 1, 'Tanjung Karang Futsal Center', 'Lapangan futsal matras interlock indoor premium di pusat kota Tanjung Karang. Menawarkan kenyamanan bermain maksimal, fasilitas kafetaria modern, ruang tunggu ber-AC, dan sewa perlengkapan.', 140000, 'Matras Interlock,Ruang AC,Shower,Cafe,Loker', 'bola.png', 'aktif');

INSERT INTO `booking` (`id`, `kode_booking`, `id_pelanggan`, `id_lapangan`, `tanggal_main`, `jam_mulai`, `jam_selesai`, `total_harga`, `status`, `created_at`) VALUES
(1, 'BKG202605204481', 3, 1, '2026-05-20', '19:00:00', '21:00:00', 300000, 'selesai', '2026-05-19 14:30:00'),
(2, 'BKG202605221087', 3, 2, '2026-05-22', '16:00:00', '18:00:00', 160000, 'selesai', '2026-05-21 09:15:00'),
(3, 'BKG202606019572', 3, 3, '2026-06-01', '15:00:00', '17:00:00', 240000, 'pending', '2026-05-28 10:00:00'),
(4, 'BKG202606023348', 3, 4, '2026-06-02', '08:00:00', '10:00:00', 200000, 'dibayar', '2026-05-28 11:20:00');

INSERT INTO `review` (`id_booking`, `rating`, `komentar`, `created_at`) VALUES
(1, 5, 'Lapangan futsal di Kedaton ini luar biasa bersih dan rumput sintetisnya sangat empuk. Pencahayaan malamnya juga terang benderang. Sangat direkomendasikan!', '2026-05-20 21:30:00'),
(2, 4, 'Karpet badminton di Sukarame ini sangat kesat dan tidak licin. Ruangan sedikit hangat di siang hari, tapi pelayanan sangat ramah dan fasilitas loker sangat membantu.', '2026-05-22 18:45:00');

INSERT INTO `pembayaran` (`id_booking`, `metode_pembayaran`, `bukti_transfer`, `status_pembayaran`, `waktu_pembayaran`) VALUES
(4, 'Transfer Bank BCA', 'PAY_4_1716942000.jpg', 'menunggu', '2026-05-28 11:30:00');
