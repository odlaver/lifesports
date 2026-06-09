<?php

namespace App\Model;

use App\Core\Database;

class Booking
{
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

    public function all()
    {
        $this->db->query("SELECT b.*, u.nama as nama_pelanggan, l.nama_lapangan, k.nama_kategori, u2.nama as nama_pengelola FROM booking b JOIN users u ON b.id_pelanggan = u.id JOIN lapangan l ON b.id_lapangan = l.id JOIN users u2 ON l.id_pengelola = u2.id JOIN kategori_lapangan k ON l.id_kategori = k.id ORDER BY b.created_at DESC");
        return $this->db->resultSet();
    }

    public function searchAdmin($keyword = '', $status = '', $tanggal = '')
    {
        $query = "SELECT b.*, u.nama as nama_pelanggan, l.nama_lapangan, k.nama_kategori, u2.nama as nama_pengelola FROM booking b JOIN users u ON b.id_pelanggan = u.id JOIN lapangan l ON b.id_lapangan = l.id JOIN users u2 ON l.id_pengelola = u2.id JOIN kategori_lapangan k ON l.id_kategori = k.id WHERE (b.kode_booking LIKE :keyword OR u.nama LIKE :keyword)";
        
        if (!empty($status) && $status !== 'Semua Status') {
            if ($status === 'Pending / Paid') {
                $query .= " AND b.status IN ('pending', 'dibayar')";
            } elseif ($status === 'Pending') {
                $query .= " AND b.status IN ('pending', 'dibayar')";
            } else {
                $query .= " AND b.status = :status";
            }
        }
        if (!empty($tanggal)) {
            $query .= " AND b.tanggal_main = :tanggal";
        }
        $query .= " ORDER BY b.created_at DESC";

        $this->db->query($query);
        $this->db->bind(':keyword', "%$keyword%");
        if (!empty($status) && $status !== 'Semua Status' && $status !== 'Pending / Paid' && $status !== 'Pending') {
            if ($status === 'Confirmed') $status = 'dikonfirmasi';
            $this->db->bind(':status', strtolower($status));
        }
        if (!empty($tanggal)) {
            $this->db->bind(':tanggal', $tanggal);
        }
        return $this->db->resultSet();
    }

    public function findById($id)
    {
        $this->db->query("SELECT b.*, l.nama_lapangan, l.lokasi as lokasi_lapangan, l.foto_utama, k.nama_kategori, pelanggan.nama as nama_pelanggan, pengelola.nama as nama_pengelola, pengelola.email as email_pengelola, pengelola.info_pembayaran, p.metode_pembayaran, p.bukti_transfer, p.status_pembayaran, p.waktu_pembayaran FROM booking b JOIN users pelanggan ON b.id_pelanggan = pelanggan.id JOIN lapangan l ON b.id_lapangan = l.id JOIN kategori_lapangan k ON l.id_kategori = k.id JOIN users pengelola ON l.id_pengelola = pengelola.id LEFT JOIN pembayaran p ON p.id_booking = b.id WHERE b.id = :id");
        $this->db->bind(':id', $id);
        return $this->db->single();
    }

    public function findByUser($id_pelanggan)
    {
        $this->db->query("SELECT b.*, l.nama_lapangan, l.foto_utama, k.nama_kategori, p.id as pembayaran_id FROM booking b JOIN lapangan l ON b.id_lapangan = l.id JOIN kategori_lapangan k ON l.id_kategori = k.id LEFT JOIN pembayaran p ON p.id_booking = b.id WHERE b.id_pelanggan = :id_pelanggan ORDER BY b.created_at DESC");
        $this->db->bind(':id_pelanggan', $id_pelanggan);
        return $this->db->resultSet();
    }

    public function searchPelanggan($id_pelanggan, $keyword = '', $status = '', $tanggal = '')
    {
        $query = "SELECT b.*, l.nama_lapangan, l.foto_utama, k.nama_kategori, p.id as pembayaran_id FROM booking b JOIN lapangan l ON b.id_lapangan = l.id JOIN kategori_lapangan k ON l.id_kategori = k.id LEFT JOIN pembayaran p ON p.id_booking = b.id WHERE b.id_pelanggan = :id_pelanggan AND (b.kode_booking LIKE :keyword OR l.nama_lapangan LIKE :keyword)";
        
        if (!empty($status) && $status !== 'Semua Status') {
            if ($status === 'Pending') {
                $query .= " AND b.status IN ('pending', 'dibayar')";
            } else {
                $query .= " AND b.status = :status";
            }
        }
        if (!empty($tanggal)) {
            $query .= " AND b.tanggal_main = :tanggal";
        }
        $query .= " ORDER BY b.created_at DESC";

        $this->db->query($query);
        $this->db->bind(':id_pelanggan', $id_pelanggan);
        $this->db->bind(':keyword', "%$keyword%");
        if (!empty($status) && $status !== 'Semua Status' && $status !== 'Pending') {
            if ($status === 'Confirmed') $status = 'dikonfirmasi';
            $this->db->bind(':status', strtolower($status));
        }
        if (!empty($tanggal)) {
            $this->db->bind(':tanggal', $tanggal);
        }
        return $this->db->resultSet();
    }

    public function findByPelangganId($id, $id_pelanggan)
    {
        $this->db->query("SELECT b.*, l.nama_lapangan, l.lokasi as lokasi_lapangan, l.foto_utama, k.nama_kategori, u.info_pembayaran, p.metode_pembayaran, p.bukti_transfer, p.status_pembayaran, p.waktu_pembayaran FROM booking b JOIN lapangan l ON b.id_lapangan = l.id JOIN kategori_lapangan k ON l.id_kategori = k.id JOIN users u ON l.id_pengelola = u.id LEFT JOIN pembayaran p ON p.id_booking = b.id WHERE b.id = :id AND b.id_pelanggan = :id_pelanggan");
        $this->db->bind(':id', $id);
        $this->db->bind(':id_pelanggan', $id_pelanggan);
        return $this->db->single();
    }

    public function findByPengelola($id_pengelola)
    {
        $this->db->query("SELECT b.*, l.nama_lapangan, u.nama as nama_pelanggan, k.nama_kategori FROM booking b JOIN lapangan l ON b.id_lapangan = l.id JOIN users u ON b.id_pelanggan = u.id JOIN kategori_lapangan k ON l.id_kategori = k.id WHERE l.id_pengelola = :id_pengelola ORDER BY b.created_at DESC");
        $this->db->bind(':id_pengelola', $id_pengelola);
        return $this->db->resultSet();
    }

    public function searchPengelola($id_pengelola, $keyword = '', $status = '', $tanggal = '')
    {
        $query = "SELECT b.*, l.nama_lapangan, u.nama as nama_pelanggan, k.nama_kategori FROM booking b JOIN lapangan l ON b.id_lapangan = l.id JOIN users u ON b.id_pelanggan = u.id JOIN kategori_lapangan k ON l.id_kategori = k.id WHERE l.id_pengelola = :id_pengelola AND (b.kode_booking LIKE :keyword OR u.nama LIKE :keyword)";
        
        if (!empty($status) && $status !== 'Semua Status') {
            if ($status === 'Pending') {
                $query .= " AND b.status IN ('pending', 'dibayar')";
            } else {
                $query .= " AND b.status = :status";
            }
        }
        if (!empty($tanggal)) {
            $query .= " AND b.tanggal_main = :tanggal";
        }
        $query .= " ORDER BY b.created_at DESC";

        $this->db->query($query);
        $this->db->bind(':id_pengelola', $id_pengelola);
        $this->db->bind(':keyword', "%$keyword%");
        if (!empty($status) && $status !== 'Semua Status' && $status !== 'Pending') {
            if ($status === 'Confirmed') $status = 'dikonfirmasi';
            $this->db->bind(':status', strtolower($status));
        }
        if (!empty($tanggal)) {
            $this->db->bind(':tanggal', $tanggal);
        }
        return $this->db->resultSet();
    }

    public function findDetailsForPengelola($id, $id_pengelola)
    {
        $this->db->query("SELECT b.*, l.nama_lapangan, u.nama as nama_pelanggan, u.email as email_pelanggan, k.nama_kategori, p.metode_pembayaran, p.bukti_transfer, p.status_pembayaran FROM booking b JOIN lapangan l ON b.id_lapangan = l.id JOIN users u ON b.id_pelanggan = u.id JOIN kategori_lapangan k ON l.id_kategori = k.id LEFT JOIN pembayaran p ON p.id_booking = b.id WHERE b.id = :id AND l.id_pengelola = :id_pengelola");
        $this->db->bind(':id', $id);
        $this->db->bind(':id_pengelola', $id_pengelola);
        return $this->db->single();
    }

    public function findForReview($id, $id_pelanggan)
    {
        $this->db->query("SELECT b.*, l.nama_lapangan, k.nama_kategori FROM booking b JOIN lapangan l ON b.id_lapangan = l.id JOIN kategori_lapangan k ON l.id_kategori = k.id WHERE b.id = :id AND b.id_pelanggan = :id_pelanggan AND b.status = 'selesai'");
        $this->db->bind(':id', $id);
        $this->db->bind(':id_pelanggan', $id_pelanggan);
        return $this->db->single();
    }

    public function create($kode_booking, $id_pelanggan, $id_lapangan, $tanggal_main, $jam_mulai, $jam_selesai, $total_harga)
    {
        $this->db->query("INSERT INTO booking (kode_booking, id_pelanggan, id_lapangan, tanggal_main, jam_mulai, jam_selesai, total_harga, status) VALUES (:kode_booking, :id_pelanggan, :id_lapangan, :tanggal_main, :jam_mulai, :jam_selesai, :total_harga, 'pending')");
        $this->db->bind(':kode_booking', $kode_booking);
        $this->db->bind(':id_pelanggan', $id_pelanggan);
        $this->db->bind(':id_lapangan', $id_lapangan);
        $this->db->bind(':tanggal_main', $tanggal_main);
        $this->db->bind(':jam_mulai', $jam_mulai);
        $this->db->bind(':jam_selesai', $jam_selesai);
        $this->db->bind(':total_harga', $total_harga);
        return $this->db->execute();
    }

    public function getIdByCode($kode_booking)
    {
        $this->db->query("SELECT id FROM booking WHERE kode_booking = :kode_booking");
        $this->db->bind(':kode_booking', $kode_booking);
        return $this->db->single()['id'];
    }

    public function updateStatus($id, $status)
    {
        $this->db->query("UPDATE booking SET status = :status WHERE id = :id");
        $this->db->bind(':status', $status);
        $this->db->bind(':id', $id);
        return $this->db->execute();
    }

    public function cancel($id, $id_pelanggan)
    {
        $this->db->query("UPDATE booking SET status = 'dibatalkan' WHERE id = :id AND id_pelanggan = :id_pelanggan AND status = 'pending'");
        $this->db->bind(':id', $id);
        $this->db->bind(':id_pelanggan', $id_pelanggan);
        return $this->db->execute();
    }

    public function checkAvailability($id_lapangan, $tanggal_main, $jam_mulai, $jam_selesai)
    {
        $this->db->query("SELECT COUNT(*) as total FROM booking WHERE id_lapangan = :id_lapangan AND tanggal_main = :tanggal_main AND status IN ('pending', 'dibayar', 'dikonfirmasi', 'selesai') AND (jam_mulai < :jam_selesai AND jam_selesai > :jam_mulai)");
        $this->db->bind(':id_lapangan', $id_lapangan);
        $this->db->bind(':tanggal_main', $tanggal_main);
        $this->db->bind(':jam_mulai', $jam_mulai);
        $this->db->bind(':jam_selesai', $jam_selesai);
        return $this->db->single()['total'] > 0;
    }

    public function count()
    {
        $this->db->query("SELECT COUNT(*) as total FROM booking");
        return $this->db->single()['total'];
    }

    public function countByPengelola($id_pengelola)
    {
        $this->db->query("SELECT COUNT(*) as total FROM booking b JOIN lapangan l ON b.id_lapangan = l.id WHERE l.id_pengelola = :id_pengelola");
        $this->db->bind(':id_pengelola', $id_pengelola);
        return $this->db->single()['total'];
    }

    public function countPendingByPengelola($id_pengelola)
    {
        $this->db->query("SELECT COUNT(*) as total FROM booking b JOIN lapangan l ON b.id_lapangan = l.id WHERE l.id_pengelola = :id_pengelola AND b.status IN ('pending', 'dibayar')");
        $this->db->bind(':id_pengelola', $id_pengelola);
        return $this->db->single()['total'];
    }

    public function countSelesaiByPengelola($id_pengelola)
    {
        $this->db->query("SELECT COUNT(*) as total FROM booking b JOIN lapangan l ON b.id_lapangan = l.id WHERE l.id_pengelola = :id_pengelola AND b.status = 'selesai'");
        $this->db->bind(':id_pengelola', $id_pengelola);
        return $this->db->single()['total'];
    }

    public function countByPelanggan($id_pelanggan)
    {
        $this->db->query("SELECT COUNT(*) as total FROM booking WHERE id_pelanggan = :id_pelanggan");
        $this->db->bind(':id_pelanggan', $id_pelanggan);
        return $this->db->single()['total'];
    }

    public function countPendingByPelanggan($id_pelanggan)
    {
        $this->db->query("SELECT COUNT(*) as total FROM booking WHERE id_pelanggan = :id_pelanggan AND status IN ('pending', 'dibayar')");
        $this->db->bind(':id_pelanggan', $id_pelanggan);
        return $this->db->single()['total'];
    }

    public function countSelesaiByPelanggan($id_pelanggan)
    {
        $this->db->query("SELECT COUNT(*) as total FROM booking WHERE id_pelanggan = :id_pelanggan AND status = 'selesai'");
        $this->db->bind(':id_pelanggan', $id_pelanggan);
        return $this->db->single()['total'];
    }

    public function totalRevenue()
    {
        $this->db->query("SELECT SUM(total_harga) as total FROM booking WHERE status IN ('dibayar', 'dikonfirmasi', 'selesai')");
        $res = $this->db->single()['total'];
        return $res ? $res : 0;
    }

    public function totalRevenueByPengelola($id_pengelola)
    {
        $this->db->query("SELECT SUM(b.total_harga) as total FROM booking b JOIN lapangan l ON b.id_lapangan = l.id WHERE l.id_pengelola = :id_pengelola AND b.status IN ('dibayar', 'dikonfirmasi', 'selesai')");
        $this->db->bind(':id_pengelola', $id_pengelola);
        $res = $this->db->single()['total'];
        return $res ? $res : 0;
    }

    public function totalExpenditureByPelanggan($id_pelanggan)
    {
        $this->db->query("SELECT SUM(total_harga) as total FROM booking WHERE id_pelanggan = :id_pelanggan AND status IN ('dibayar', 'dikonfirmasi', 'selesai')");
        $this->db->bind(':id_pelanggan', $id_pelanggan);
        $res = $this->db->single()['total'];
        return $res ? $res : 0;
    }

    public function getActiveByPelanggan($id_pelanggan)
    {
        $this->db->query("SELECT b.*, l.nama_lapangan, l.foto_utama, k.nama_kategori FROM booking b JOIN lapangan l ON b.id_lapangan = l.id JOIN kategori_lapangan k ON l.id_kategori = k.id WHERE b.id_pelanggan = :id_pelanggan AND b.status IN ('pending', 'dibayar', 'dikonfirmasi') ORDER BY b.tanggal_main ASC, b.jam_mulai ASC");
        $this->db->bind(':id_pelanggan', $id_pelanggan);
        return $this->db->resultSet();
    }

    public function getRecentByPelanggan($id_pelanggan)
    {
        $this->db->query("SELECT b.*, l.nama_lapangan, l.foto_utama, k.nama_kategori FROM booking b JOIN lapangan l ON b.id_lapangan = l.id JOIN kategori_lapangan k ON l.id_kategori = k.id WHERE b.id_pelanggan = :id_pelanggan ORDER BY b.created_at DESC LIMIT 5");
        $this->db->bind(':id_pelanggan', $id_pelanggan);
        return $this->db->resultSet();
    }

    public function getPendingByPengelola($id_pengelola)
    {
        $this->db->query("SELECT b.*, l.nama_lapangan, u.nama as nama_pelanggan, k.nama_kategori FROM booking b JOIN lapangan l ON b.id_lapangan = l.id JOIN users u ON b.id_pelanggan = u.id JOIN kategori_lapangan k ON l.id_kategori = k.id WHERE l.id_pengelola = :id_pengelola AND b.status IN ('pending', 'dibayar') ORDER BY b.created_at DESC LIMIT 5");
        $this->db->bind(':id_pengelola', $id_pengelola);
        return $this->db->resultSet();
    }

    public function getTodayByPengelola($id_pengelola)
    {
        $this->db->query("SELECT b.*, l.nama_lapangan, u.nama as nama_pelanggan FROM booking b JOIN lapangan l ON b.id_lapangan = l.id JOIN users u ON b.id_pelanggan = u.id WHERE l.id_pengelola = :id_pengelola AND b.tanggal_main = CURDATE() ORDER BY b.jam_mulai ASC");
        $this->db->bind(':id_pengelola', $id_pengelola);
        return $this->db->resultSet();
    }

    public function getStats()
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

    public function getRecent($limit = 5)
    {
        $this->db->query("SELECT b.*, u.nama as nama_pelanggan, l.nama_lapangan, k.nama_kategori FROM booking b JOIN users u ON b.id_pelanggan = u.id JOIN lapangan l ON b.id_lapangan = l.id JOIN kategori_lapangan k ON l.id_kategori = k.id ORDER BY b.created_at DESC LIMIT " . intval($limit));
        return $this->db->resultSet();
    }

    public function getMonthlyByPengelola($id_pengelola)
    {
        $this->db->query("SELECT DATE_FORMAT(b.created_at, '%M %Y') as bulan, COUNT(b.id) as booking_count, SUM(b.total_harga) as pendapatan, COALESCE(AVG(r.rating), 5.0) as rating FROM booking b JOIN lapangan l ON b.id_lapangan = l.id LEFT JOIN review r ON r.id_booking = b.id WHERE l.id_pengelola = :id_pengelola GROUP BY DATE_FORMAT(b.created_at, '%M %Y'), DATE_FORMAT(b.created_at, '%Y-%m') ORDER BY DATE_FORMAT(b.created_at, '%Y-%m') DESC");
        $this->db->bind(':id_pengelola', $id_pengelola);
        return $this->db->resultSet();
    }

    public function getTopLapangan()
    {
        $this->db->query("SELECT l.nama_lapangan, k.nama_kategori, u.nama as nama_pengelola, COUNT(b.id) as total_booking, SUM(b.total_harga) as pendapatan FROM booking b JOIN lapangan l ON b.id_lapangan = l.id JOIN kategori_lapangan k ON l.id_kategori = k.id JOIN users u ON l.id_pengelola = u.id WHERE b.status = 'selesai' GROUP BY l.id ORDER BY pendapatan DESC LIMIT 5");
        return $this->db->resultSet();
    }

    public function getTopLapanganByPengelola($id_pengelola)
    {
        $this->db->query("SELECT l.nama_lapangan FROM booking b JOIN lapangan l ON b.id_lapangan = l.id WHERE b.status = 'selesai' AND l.id_pengelola = :id_pengelola GROUP BY l.id ORDER BY COUNT(b.id) DESC LIMIT 1");
        $this->db->bind(':id_pengelola', $id_pengelola);
        $res = $this->db->single();
        return $res ? $res['nama_lapangan'] : '-';
    }

    public function getTopPengelola()
    {
        $this->db->query("SELECT u.nama as nama_pengelola, COUNT(DISTINCT l.id) as jumlah_lapangan, COUNT(b.id) as total_booking, SUM(b.total_harga) as pendapatan FROM booking b JOIN lapangan l ON b.id_lapangan = l.id JOIN users u ON l.id_pengelola = u.id WHERE b.status = 'selesai' GROUP BY u.id ORDER BY pendapatan DESC LIMIT 5");
        return $this->db->resultSet();
    }
}
