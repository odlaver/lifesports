<?php

namespace App\Model;

use App\Core\Database;

class Lapangan
{
    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    public function all()
    {
        $this->db->query("SELECT l.*, k.nama_kategori, u.nama as nama_pengelola, COALESCE(AVG(r.rating), 5.0) as rating FROM lapangan l JOIN kategori_lapangan k ON l.id_kategori = k.id JOIN users u ON l.id_pengelola = u.id LEFT JOIN booking b ON b.id_lapangan = l.id LEFT JOIN review r ON r.id_booking = b.id GROUP BY l.id, l.id_pengelola, l.id_kategori, l.nama_lapangan, l.deskripsi, l.harga_per_jam, l.fasilitas, l.foto_utama, l.status, l.lokasi, l.created_at, k.nama_kategori, u.nama");
        return $this->db->resultSet();
    }

    public function searchAdmin($keyword = '', $status = '', $kategori = '')
    {
        $query = "SELECT l.*, k.nama_kategori, u.nama as nama_pengelola, COALESCE(AVG(r.rating), 5.0) as rating FROM lapangan l JOIN kategori_lapangan k ON l.id_kategori = k.id JOIN users u ON l.id_pengelola = u.id LEFT JOIN booking b ON b.id_lapangan = l.id LEFT JOIN review r ON r.id_booking = b.id WHERE (l.nama_lapangan LIKE :keyword OR u.nama LIKE :keyword)";
        if (!empty($status) && $status !== 'Semua Status') {
            $query .= " AND l.status = :status";
        }
        if (!empty($kategori) && $kategori !== 'Semua Kategori') {
            $query .= " AND k.nama_kategori = :kategori";
        }
        $query .= " GROUP BY l.id, l.id_pengelola, l.id_kategori, l.nama_lapangan, l.deskripsi, l.harga_per_jam, l.fasilitas, l.foto_utama, l.status, l.lokasi, l.created_at, k.nama_kategori, u.nama ORDER BY l.id DESC";

        $this->db->query($query);
        $this->db->bind(':keyword', "%$keyword%");
        if (!empty($status) && $status !== 'Semua Status') {
            $this->db->bind(':status', strtolower($status));
        }
        if (!empty($kategori) && $kategori !== 'Semua Kategori') {
            $this->db->bind(':kategori', $kategori);
        }
        return $this->db->resultSet();
    }

    public function active()
    {
        $this->db->query("SELECT l.*, k.nama_kategori, COALESCE(AVG(r.rating), 5.0) as rating FROM lapangan l JOIN kategori_lapangan k ON l.id_kategori = k.id LEFT JOIN booking b ON b.id_lapangan = l.id LEFT JOIN review r ON r.id_booking = b.id WHERE l.status = 'aktif' GROUP BY l.id, l.id_pengelola, l.id_kategori, l.nama_lapangan, l.deskripsi, l.harga_per_jam, l.fasilitas, l.foto_utama, l.status, l.lokasi, l.created_at, k.nama_kategori");
        return $this->db->resultSet();
    }

    public function findById($id)
    {
        $this->db->query("SELECT l.*, k.nama_kategori, u.nama as nama_pengelola, u.email as email_pengelola, u.no_telp as telp_pengelola, COALESCE(AVG(r.rating), 5.0) as rating, COUNT(DISTINCT b.id) as total_booking, COUNT(DISTINCT r.id) as total_review, COALESCE(SUM(CASE WHEN b.status IN ('dibayar', 'dikonfirmasi', 'selesai') THEN b.total_harga ELSE 0 END), 0) as pendapatan FROM lapangan l JOIN kategori_lapangan k ON l.id_kategori = k.id JOIN users u ON l.id_pengelola = u.id LEFT JOIN booking b ON b.id_lapangan = l.id LEFT JOIN review r ON r.id_booking = b.id WHERE l.id = :id GROUP BY l.id, l.id_pengelola, l.id_kategori, l.nama_lapangan, l.deskripsi, l.harga_per_jam, l.fasilitas, l.foto_utama, l.status, l.lokasi, l.created_at, k.nama_kategori, u.nama, u.email, u.no_telp");
        $this->db->bind(':id', $id);
        return $this->db->single();
    }

    public function findByPengelola($id_pengelola)
    {
        $this->db->query("SELECT l.*, k.nama_kategori, COUNT(b.id) as total_booking FROM lapangan l JOIN kategori_lapangan k ON l.id_kategori = k.id LEFT JOIN booking b ON b.id_lapangan = l.id WHERE l.id_pengelola = :id_pengelola GROUP BY l.id, l.id_pengelola, l.id_kategori, l.nama_lapangan, l.deskripsi, l.harga_per_jam, l.fasilitas, l.foto_utama, l.status, l.lokasi, l.created_at, k.nama_kategori ORDER BY l.created_at DESC");
        $this->db->bind(':id_pengelola', $id_pengelola);
        return $this->db->resultSet();
    }

    public function search($keyword = '', $kategori = '', $lokasi = '', $sort = '')
    {
        $query = "SELECT l.*, k.nama_kategori, COALESCE(AVG(r.rating), 5.0) as rating, COUNT(b.id) as total_booking FROM lapangan l JOIN kategori_lapangan k ON l.id_kategori = k.id LEFT JOIN booking b ON b.id_lapangan = l.id LEFT JOIN review r ON r.id_booking = b.id WHERE l.status = 'aktif'";
        if (!empty($keyword)) {
            $query .= " AND l.nama_lapangan LIKE :keyword";
        }
        if (!empty($kategori) && $kategori !== 'Semua Cabang') {
            $query .= " AND k.nama_kategori = :kategori";
        }
        if (!empty($lokasi) && $lokasi !== 'Semua Lokasi') {
            $query .= " AND (l.nama_lapangan LIKE :lokasi OR l.deskripsi LIKE :lokasi)";
        }
        $query .= " GROUP BY l.id, l.id_pengelola, l.id_kategori, l.nama_lapangan, l.deskripsi, l.harga_per_jam, l.fasilitas, l.foto_utama, l.status, l.lokasi, l.created_at, k.nama_kategori";
        if ($sort === 'Harga Terendah') {
            $query .= " ORDER BY l.harga_per_jam ASC";
        } elseif ($sort === 'Rating Tertinggi') {
            $query .= " ORDER BY rating DESC, total_booking DESC";
        } else {
            $query .= " ORDER BY total_booking DESC, rating DESC";
        }
        $this->db->query($query);
        if (!empty($keyword)) {
            $this->db->bind(':keyword', '%' . $keyword . '%');
        }
        if (!empty($kategori) && $kategori !== 'Semua Cabang') {
            $this->db->bind(':kategori', $kategori);
        }
        if (!empty($lokasi) && $lokasi !== 'Semua Lokasi') {
            $this->db->bind(':lokasi', '%' . $lokasi . '%');
        }
        return $this->db->resultSet();
    }

    public function searchByPengelola($id_pengelola, $keyword = '', $status = '', $kategori = '')
    {
        $query = "SELECT l.*, k.nama_kategori, (SELECT COUNT(id) FROM booking WHERE id_lapangan = l.id) as total_booking FROM lapangan l JOIN kategori_lapangan k ON l.id_kategori = k.id WHERE l.id_pengelola = :id_pengelola";
        if (!empty($keyword)) {
            $query .= " AND l.nama_lapangan LIKE :keyword";
        }
        $status_val = '';
        if (!empty($status) && $status !== 'Semua Status') {
            if ($status === 'Tersedia') $status_val = 'aktif';
            elseif ($status === 'Nonaktif') $status_val = 'nonaktif';
            if ($status_val) {
                $query .= " AND l.status = :status";
            }
        }
        if (!empty($kategori) && $kategori !== 'Semua Kategori') {
            $query .= " AND k.nama_kategori = :kategori";
        }
        $query .= " ORDER BY l.id DESC";
        $this->db->query($query);
        $this->db->bind(':id_pengelola', $id_pengelola);
        if (!empty($keyword)) {
            $this->db->bind(':keyword', '%' . $keyword . '%');
        }
        if ($status_val) {
            $this->db->bind(':status', $status_val);
        }
        if (!empty($kategori) && $kategori !== 'Semua Kategori') {
            $this->db->bind(':kategori', $kategori);
        }
        return $this->db->resultSet();
    }

    public function create($id_pengelola, $id_kategori, $nama_lapangan, $deskripsi, $harga_per_jam, $fasilitas, $foto_utama, $status, $lokasi = 'Bandar Lampung')
    {
        $this->db->query("INSERT INTO lapangan (id_pengelola, id_kategori, nama_lapangan, deskripsi, harga_per_jam, fasilitas, foto_utama, status, lokasi) VALUES (:id_pengelola, :id_kategori, :nama_lapangan, :deskripsi, :harga_per_jam, :fasilitas, :foto_utama, :status, :lokasi)");
        $this->db->bind(':id_pengelola', $id_pengelola);
        $this->db->bind(':id_kategori', $id_kategori);
        $this->db->bind(':nama_lapangan', $nama_lapangan);
        $this->db->bind(':deskripsi', $deskripsi);
        $this->db->bind(':harga_per_jam', $harga_per_jam);
        $this->db->bind(':fasilitas', $fasilitas);
        $this->db->bind(':foto_utama', $foto_utama);
        $this->db->bind(':status', $status);
        $this->db->bind(':lokasi', $lokasi);
        return $this->db->execute();
    }

    public function update($id, $id_pengelola, $id_kategori, $nama_lapangan, $deskripsi, $harga_per_jam, $fasilitas, $foto_utama, $status, $lokasi = 'Bandar Lampung')
    {
        $this->db->query("UPDATE lapangan SET id_kategori = :id_kategori, nama_lapangan = :nama_lapangan, deskripsi = :deskripsi, harga_per_jam = :harga_per_jam, fasilitas = :fasilitas, foto_utama = :foto_utama, status = :status, lokasi = :lokasi WHERE id = :id AND id_pengelola = :id_pengelola");
        $this->db->bind(':id', $id);
        $this->db->bind(':id_pengelola', $id_pengelola);
        $this->db->bind(':id_kategori', $id_kategori);
        $this->db->bind(':nama_lapangan', $nama_lapangan);
        $this->db->bind(':deskripsi', $deskripsi);
        $this->db->bind(':harga_per_jam', $harga_per_jam);
        $this->db->bind(':fasilitas', $fasilitas);
        $this->db->bind(':foto_utama', $foto_utama);
        $this->db->bind(':status', $status);
        $this->db->bind(':lokasi', $lokasi);
        return $this->db->execute();
    }

    public function delete($id, $id_pengelola)
    {
        $this->db->query("DELETE FROM lapangan WHERE id = :id AND id_pengelola = :id_pengelola");
        $this->db->bind(':id', $id);
        $this->db->bind(':id_pengelola', $id_pengelola);
        return $this->db->execute();
    }

    public function toggleStatus($id, $id_pengelola, $status)
    {
        $this->db->query("UPDATE lapangan SET status = :status WHERE id = :id AND id_pengelola = :id_pengelola");
        $this->db->bind(':status', $status);
        $this->db->bind(':id', $id);
        $this->db->bind(':id_pengelola', $id_pengelola);
        return $this->db->execute();
    }

    public function count()
    {
        $this->db->query("SELECT COUNT(*) as total FROM lapangan");
        return $this->db->single()['total'];
    }

    public function countByPengelola($id_pengelola)
    {
        $this->db->query("SELECT COUNT(*) as total FROM lapangan WHERE id_pengelola = :id_pengelola");
        $this->db->bind(':id_pengelola', $id_pengelola);
        return $this->db->single()['total'];
    }

    public function countAktifByPengelola($id_pengelola)
    {
        $this->db->query("SELECT COUNT(*) as total FROM lapangan WHERE id_pengelola = :id_pengelola AND status = 'aktif'");
        $this->db->bind(':id_pengelola', $id_pengelola);
        return $this->db->single()['total'];
    }

    public function getBookingCount($id)
    {
        $this->db->query("SELECT COUNT(*) as total FROM booking WHERE id_lapangan = :id_lapangan");
        $this->db->bind(':id_lapangan', $id);
        return $this->db->single()['total'];
    }

    public function getRating($id)
    {
        $this->db->query("SELECT COALESCE(AVG(r.rating), 5.0) as rating FROM review r JOIN booking b ON r.id_booking = b.id WHERE b.id_lapangan = :id");
        $this->db->bind(':id', $id);
        return $this->db->single()['rating'];
    }

    public function getRecommended()
    {
        $this->db->query("SELECT l.id, l.nama_lapangan, l.lokasi, k.nama_kategori, l.foto_utama, l.harga_per_jam, COALESCE(AVG(r.rating), 5.0) as rating FROM lapangan l JOIN kategori_lapangan k ON l.id_kategori = k.id LEFT JOIN booking b ON b.id_lapangan = l.id LEFT JOIN review r ON r.id_booking = b.id WHERE l.status = 'aktif' GROUP BY l.id, l.id_pengelola, l.id_kategori, l.nama_lapangan, l.deskripsi, l.harga_per_jam, l.fasilitas, l.foto_utama, l.status, l.lokasi, l.created_at, k.nama_kategori ORDER BY rating DESC, COUNT(b.id) DESC LIMIT 3");
        return $this->db->resultSet();
    }

    public function getPopularByPengelola($id_pengelola)
    {
        $this->db->query("SELECT l.*, k.nama_kategori, COUNT(b.id) as total_booking FROM lapangan l JOIN kategori_lapangan k ON l.id_kategori = k.id LEFT JOIN booking b ON b.id_lapangan = l.id WHERE l.id_pengelola = :id_pengelola GROUP BY l.id, l.id_pengelola, l.id_kategori, l.nama_lapangan, l.deskripsi, l.harga_per_jam, l.fasilitas, l.foto_utama, l.status, l.lokasi, l.created_at, k.nama_kategori ORDER BY total_booking DESC LIMIT 3");
        $this->db->bind(':id_pengelola', $id_pengelola);
        return $this->db->resultSet();
    }

    public function getMostPopularByPengelola($id_pengelola)
    {
        $this->db->query("SELECT l.nama_lapangan FROM lapangan l LEFT JOIN booking b ON b.id_lapangan = l.id WHERE l.id_pengelola = :id_pengelola GROUP BY l.id, l.nama_lapangan ORDER BY COUNT(b.id) DESC LIMIT 1");
        $this->db->bind(':id_pengelola', $id_pengelola);
        $res = $this->db->single();
        return $res ? $res['nama_lapangan'] : 'Tidak ada data';
    }

    public function getCategories()
    {
        $this->db->query("SELECT * FROM kategori_lapangan");
        return $this->db->resultSet();
    }
}
