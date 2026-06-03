<?php

class Booking_model {
    private $db;

    public function __construct()
    {
        $this->db = new Database();
        $this->autoUpdateStatuses();
    }

    private function autoUpdateStatuses()
    {

        $this->db->query("UPDATE booking SET status = 'dibatalkan' WHERE status = 'pending' AND created_at <= DATE_SUB(NOW(), INTERVAL 2 HOUR)");
        $this->db->execute();


        $this->db->query("UPDATE booking SET status = 'selesai' WHERE status = 'dikonfirmasi' AND CONCAT(tanggal_main, ' ', jam_selesai) <= NOW()");
        $this->db->execute();
    }

    public function countBookingByPelanggan($id_pelanggan)
    {
        $this->db->query("SELECT COUNT(*) as total FROM booking WHERE id_pelanggan = :id_pelanggan");
        $this->db->bind(':id_pelanggan', $id_pelanggan);
        return $this->db->single()['total'];
    }

    public function countBookingPendingByPelanggan($id_pelanggan)
    {
        $this->db->query("SELECT COUNT(*) as total FROM booking WHERE id_pelanggan = :id_pelanggan AND status IN ('pending', 'dibayar')");
        $this->db->bind(':id_pelanggan', $id_pelanggan);
        return $this->db->single()['total'];
    }

    public function countBookingSelesaiByPelanggan($id_pelanggan)
    {
        $this->db->query("SELECT COUNT(*) as total FROM booking WHERE id_pelanggan = :id_pelanggan AND status = 'selesai'");
        $this->db->bind(':id_pelanggan', $id_pelanggan);
        return $this->db->single()['total'];
    }

    public function totalExpenditureByPelanggan($id_pelanggan)
    {
        $this->db->query("SELECT SUM(total_harga) as total FROM booking WHERE id_pelanggan = :id_pelanggan AND status IN ('dibayar', 'dikonfirmasi', 'selesai')");
        $this->db->bind(':id_pelanggan', $id_pelanggan);
        $res = $this->db->single()['total'];
        return $res ? $res : 0;
    }

    public function getActiveBookingsByPelanggan($id_pelanggan)
    {
        $this->db->query("SELECT b.*, l.nama_lapangan, l.foto_utama, k.nama_kategori
                    FROM booking b
                    JOIN lapangan l ON b.id_lapangan = l.id
                    JOIN kategori_lapangan k ON l.id_kategori = k.id
                    WHERE b.id_pelanggan = :id_pelanggan
                    AND b.status IN ('pending', 'dibayar', 'dikonfirmasi')
                    ORDER BY b.tanggal_main ASC, b.jam_mulai ASC");
        $this->db->bind(':id_pelanggan', $id_pelanggan);
        return $this->db->resultSet();
    }

    public function getRecentBookingsByPelanggan($id_pelanggan)
    {
        $this->db->query("SELECT b.*, l.nama_lapangan, l.foto_utama, k.nama_kategori
                    FROM booking b
                    JOIN lapangan l ON b.id_lapangan = l.id
                    JOIN kategori_lapangan k ON l.id_kategori = k.id
                    WHERE b.id_pelanggan = :id_pelanggan
                    ORDER BY b.created_at DESC
                    LIMIT 5");
        $this->db->bind(':id_pelanggan', $id_pelanggan);
        return $this->db->resultSet();
    }

    public function getAllBookingsByPelanggan($id_pelanggan)
    {
        $this->db->query("SELECT b.*, l.nama_lapangan, l.foto_utama, k.nama_kategori, p.id as pembayaran_id
                    FROM booking b
                    JOIN lapangan l ON b.id_lapangan = l.id
                    JOIN kategori_lapangan k ON l.id_kategori = k.id
                    LEFT JOIN pembayaran p ON p.id_booking = b.id
                    WHERE b.id_pelanggan = :id_pelanggan
                    ORDER BY b.created_at DESC");
        $this->db->bind(':id_pelanggan', $id_pelanggan);
        return $this->db->resultSet();
    }

    public function getBookingById($id, $id_pelanggan = null)
    {
        if ($id_pelanggan !== null) {
            $this->db->query("SELECT b.*, l.nama_lapangan, l.foto_utama, k.nama_kategori, u.info_pembayaran
                        FROM booking b
                        JOIN lapangan l ON b.id_lapangan = l.id
                        JOIN kategori_lapangan k ON l.id_kategori = k.id
                        JOIN users u ON l.id_pengelola = u.id
                        WHERE b.id = :id AND b.id_pelanggan = :id_pelanggan");
            $this->db->bind(':id_pelanggan', $id_pelanggan);
        } else {
            $this->db->query("SELECT b.*, l.nama_lapangan, l.foto_utama, k.nama_kategori, u.info_pembayaran
                        FROM booking b
                        JOIN lapangan l ON b.id_lapangan = l.id
                        JOIN kategori_lapangan k ON l.id_kategori = k.id
                        JOIN users u ON l.id_pengelola = u.id
                        WHERE b.id = :id");
        }
        $this->db->bind(':id', $id);
        return $this->db->single();
    }

    public function getBookingByIdForReview($id, $id_pelanggan)
    {
        $this->db->query("SELECT b.*, l.nama_lapangan, k.nama_kategori
                    FROM booking b
                    JOIN lapangan l ON b.id_lapangan = l.id
                    JOIN kategori_lapangan k ON l.id_kategori = k.id
                    WHERE b.id = :id AND b.id_pelanggan = :id_pelanggan AND b.status = 'selesai'");
        $this->db->bind(':id', $id);
        $this->db->bind(':id_pelanggan', $id_pelanggan);
        return $this->db->single();
    }

    public function checkAvailability($id_lapangan, $tanggal_main, $jam_mulai, $jam_selesai)
    {

        $this->db->query("SELECT COUNT(*) as total FROM booking
                          WHERE id_lapangan = :id_lapangan
                          AND tanggal_main = :tanggal_main
                          AND status IN ('pending', 'dibayar', 'dikonfirmasi', 'selesai')
                          AND (
                              (jam_mulai < :jam_selesai AND jam_selesai > :jam_mulai)
                          )");
        $this->db->bind(':id_lapangan', $id_lapangan);
        $this->db->bind(':tanggal_main', $tanggal_main);
        $this->db->bind(':jam_mulai', $jam_mulai);
        $this->db->bind(':jam_selesai', $jam_selesai);
        return $this->db->single()['total'] > 0;
    }

    public function insertBooking($kode_booking, $id_pelanggan, $id_lapangan, $tanggal_main, $jam_mulai, $jam_selesai, $total_harga)
    {
        $this->db->query("INSERT INTO booking (kode_booking, id_pelanggan, id_lapangan, tanggal_main, jam_mulai, jam_selesai, total_harga, status)
                    VALUES (:kode_booking, :id_pelanggan, :id_lapangan, :tanggal_main, :jam_mulai, :jam_selesai, :total_harga, 'pending')");
        $this->db->bind(':kode_booking', $kode_booking);
        $this->db->bind(':id_pelanggan', $id_pelanggan);
        $this->db->bind(':id_lapangan', $id_lapangan);
        $this->db->bind(':tanggal_main', $tanggal_main);
        $this->db->bind(':jam_mulai', $jam_mulai);
        $this->db->bind(':jam_selesai', $jam_selesai);
        $this->db->bind(':total_harga', $total_harga);
        return $this->db->execute();
    }

    public function getBookingIdByCode($kode_booking)
    {
        $this->db->query("SELECT id FROM booking WHERE kode_booking = :kode_booking");
        $this->db->bind(':kode_booking', $kode_booking);
        return $this->db->single()['id'];
    }

    public function countBookingPendingByPengelola($id_pengelola)
    {
        $this->db->query("SELECT COUNT(*) as total FROM booking b JOIN lapangan l ON b.id_lapangan = l.id WHERE l.id_pengelola = :id_pengelola AND b.status IN ('pending', 'dibayar')");
        $this->db->bind(':id_pengelola', $id_pengelola);
        return $this->db->single()['total'];
    }

    public function countBookingByPengelola($id_pengelola)
    {
        $this->db->query("SELECT COUNT(*) as total FROM booking b JOIN lapangan l ON b.id_lapangan = l.id WHERE l.id_pengelola = :id_pengelola");
        $this->db->bind(':id_pengelola', $id_pengelola);
        return $this->db->single()['total'];
    }

    public function countBookingSelesaiByPengelola($id_pengelola)
    {
        $this->db->query("SELECT COUNT(*) as total FROM booking b JOIN lapangan l ON b.id_lapangan = l.id WHERE l.id_pengelola = :id_pengelola AND b.status = 'selesai'");
        $this->db->bind(':id_pengelola', $id_pengelola);
        return $this->db->single()['total'];
    }

    public function totalRevenueByPengelola($id_pengelola)
    {
        $this->db->query("SELECT SUM(b.total_harga) as total FROM booking b JOIN lapangan l ON b.id_lapangan = l.id WHERE l.id_pengelola = :id_pengelola AND b.status IN ('dibayar', 'dikonfirmasi', 'selesai')");
        $this->db->bind(':id_pengelola', $id_pengelola);
        $res = $this->db->single()['total'];
        return $res ? $res : 0;
    }

    public function getPendingBookingsByPengelola($id_pengelola)
    {
        $this->db->query("SELECT b.*, l.nama_lapangan, u.nama as nama_pelanggan, k.nama_kategori
                    FROM booking b
                    JOIN lapangan l ON b.id_lapangan = l.id
                    JOIN users u ON b.id_pelanggan = u.id
                    JOIN kategori_lapangan k ON l.id_kategori = k.id
                    WHERE l.id_pengelola = :id_pengelola AND b.status IN ('pending', 'dibayar')
                    ORDER BY b.created_at DESC
                    LIMIT 5");
        $this->db->bind(':id_pengelola', $id_pengelola);
        return $this->db->resultSet();
    }

    public function getTodayBookingsByPengelola($id_pengelola)
    {
        $this->db->query("SELECT b.*, l.nama_lapangan, u.nama as nama_pelanggan
                    FROM booking b
                    JOIN lapangan l ON b.id_lapangan = l.id
                    JOIN users u ON b.id_pelanggan = u.id
                    WHERE l.id_pengelola = :id_pengelola AND b.tanggal_main = CURDATE()
                    ORDER BY b.jam_mulai ASC");
        $this->db->bind(':id_pengelola', $id_pengelola);
        return $this->db->resultSet();
    }

    public function getAllBookingsByPengelola($id_pengelola)
    {
        $this->db->query("SELECT b.*, l.nama_lapangan, u.nama as nama_pelanggan, k.nama_kategori
                    FROM booking b
                    JOIN lapangan l ON b.id_lapangan = l.id
                    JOIN users u ON b.id_pelanggan = u.id
                    JOIN kategori_lapangan k ON l.id_kategori = k.id
                    WHERE l.id_pengelola = :id_pengelola
                    ORDER BY b.created_at DESC");
        $this->db->bind(':id_pengelola', $id_pengelola);
        return $this->db->resultSet();
    }

    public function getBookingDetailsForPengelola($id, $id_pengelola)
    {
        $this->db->query("SELECT b.*, l.nama_lapangan, u.nama as nama_pelanggan, u.email as email_pelanggan, k.nama_kategori,
                           p.metode_pembayaran, p.bukti_transfer, p.status_pembayaran
                    FROM booking b
                    JOIN lapangan l ON b.id_lapangan = l.id
                    JOIN users u ON b.id_pelanggan = u.id
                    JOIN kategori_lapangan k ON l.id_kategori = k.id
                    LEFT JOIN pembayaran p ON p.id_booking = b.id
                    WHERE b.id = :id AND l.id_pengelola = :id_pengelola");
        $this->db->bind(':id', $id);
        $this->db->bind(':id_pengelola', $id_pengelola);
        return $this->db->single();
    }

    public function updateStatus($id, $status)
    {
        $this->db->query("UPDATE booking SET status = :status WHERE id = :id");
        $this->db->bind(':status', $status);
        $this->db->bind(':id', $id);
        return $this->db->execute();
    }

    public function countAllBookings()
    {
        $this->db->query("SELECT COUNT(*) as total FROM booking");
        return $this->db->single()['total'];
    }

    public function totalAllRevenue()
    {
        $this->db->query("SELECT SUM(total_harga) as total FROM booking WHERE status IN ('dibayar', 'dikonfirmasi', 'selesai')");
        $res = $this->db->single()['total'];
        return $res ? $res : 0;
    }

    public function getBookingStatsAdmin()
    {
        $statuses = ['pending', 'dikonfirmasi', 'selesai', 'dibatalkan'];
        $stats = [];
        foreach ($statuses as $st) {
            $this->db->query("SELECT COUNT(*) as count, COALESCE(SUM(total_harga), 0) as total FROM booking WHERE status = :status");
            $this->db->bind(':status', $st);
            $stats[$st] = $this->db->single();
        }
        return $stats;
    }

    public function getRecentBookingsAdmin()
    {
        $this->db->query("SELECT b.*, u.nama as nama_pelanggan, l.nama_lapangan, k.nama_kategori
                    FROM booking b
                    JOIN users u ON b.id_pelanggan = u.id
                    JOIN lapangan l ON b.id_lapangan = l.id
                    JOIN kategori_lapangan k ON l.id_kategori = k.id
                    ORDER BY b.created_at DESC
                    LIMIT 5");
        return $this->db->resultSet();
    }

    public function getMonthlyReportByPengelola($id_pengelola)
    {
        $this->db->query("SELECT DATE_FORMAT(b.created_at, '%M %Y') as bulan, COUNT(b.id) as booking_count, SUM(b.total_harga) as pendapatan, COALESCE(AVG(r.rating), 5.0) as rating
                    FROM booking b
                    JOIN lapangan l ON b.id_lapangan = l.id
                    LEFT JOIN review r ON r.id_booking = b.id
                    WHERE l.id_pengelola = :id_pengelola
                    GROUP BY DATE_FORMAT(b.created_at, '%M %Y'), DATE_FORMAT(b.created_at, '%Y-%m')
                    ORDER BY DATE_FORMAT(b.created_at, '%Y-%m') DESC");
        $this->db->bind(':id_pengelola', $id_pengelola);
        return $this->db->resultSet();
    }

    public function getAllBookingsAdmin()
    {
        $this->db->query("SELECT b.*, u.nama as nama_pelanggan, l.nama_lapangan, k.nama_kategori, u2.nama as nama_pengelola
                    FROM booking b
                    JOIN users u ON b.id_pelanggan = u.id
                    JOIN lapangan l ON b.id_lapangan = l.id
                    JOIN users u2 ON l.id_pengelola = u2.id
                    JOIN kategori_lapangan k ON l.id_kategori = k.id
                    ORDER BY b.created_at DESC");
        return $this->db->resultSet();
    }

    public function getTopLapanganAdmin()
    {
        $this->db->query("SELECT l.nama_lapangan, k.nama_kategori, u.nama as nama_pengelola, COUNT(b.id) as total_booking, SUM(b.total_harga) as pendapatan
                    FROM booking b
                    JOIN lapangan l ON b.id_lapangan = l.id
                    JOIN kategori_lapangan k ON l.id_kategori = k.id
                    JOIN users u ON l.id_pengelola = u.id
                    WHERE b.status = 'selesai'
                    GROUP BY l.id
                    ORDER BY pendapatan DESC
                    LIMIT 5");
        return $this->db->resultSet();
    }

    public function getTopPengelolaAdmin()
    {
        $this->db->query("SELECT u.nama as nama_pengelola, COUNT(DISTINCT l.id) as jumlah_lapangan, COUNT(b.id) as total_booking, SUM(b.total_harga) as pendapatan
                    FROM booking b
                    JOIN lapangan l ON b.id_lapangan = l.id
                    JOIN users u ON l.id_pengelola = u.id
                    WHERE b.status = 'selesai'
                    GROUP BY u.id
                    ORDER BY pendapatan DESC
                    LIMIT 5");
        return $this->db->resultSet();
    }
}

