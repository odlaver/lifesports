<?php

class Lapangan_model {
    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    public function getAllActiveLapangan()
    {
        $this->db->query("SELECT l.*, k.nama_kategori, COALESCE(AVG(r.rating), 5.0) as rating
                    FROM lapangan l
                    JOIN kategori_lapangan k ON l.id_kategori = k.id
                    LEFT JOIN booking b ON b.id_lapangan = l.id
                    LEFT JOIN review r ON r.id_booking = b.id
                    WHERE l.status = 'aktif'
                    GROUP BY l.id, l.id_pengelola, l.id_kategori, l.nama_lapangan, l.deskripsi, l.harga_per_jam, l.fasilitas, l.foto_utama, l.status, l.created_at, k.nama_kategori");
        return $this->db->resultSet();
    }

    public function getLapanganById($id)
    {
        $this->db->query("SELECT l.*, k.nama_kategori 
                    FROM lapangan l 
                    JOIN kategori_lapangan k ON l.id_kategori = k.id 
                    WHERE l.id = :id");
        $this->db->bind(':id', $id);
        return $this->db->single();
    }

    public function getLapanganRating($id)
    {
        $this->db->query("SELECT COALESCE(AVG(r.rating), 5.0) as rating 
                    FROM review r 
                    JOIN booking b ON r.id_booking = b.id 
                    WHERE b.id_lapangan = :id");
        $this->db->bind(':id', $id);
        return $this->db->single()['rating'];
    }

    public function getLapanganByPengelola($id_pengelola)
    {
        $this->db->query("SELECT l.*, k.nama_kategori, COUNT(b.id) as total_booking
                    FROM lapangan l
                    JOIN kategori_lapangan k ON l.id_kategori = k.id
                    LEFT JOIN booking b ON b.id_lapangan = l.id
                    WHERE l.id_pengelola = :id_pengelola
                    GROUP BY l.id, l.id_pengelola, l.id_kategori, l.nama_lapangan, l.deskripsi, l.harga_per_jam, l.fasilitas, l.foto_utama, l.status, l.created_at, k.nama_kategori
                    ORDER BY l.created_at DESC");
        $this->db->bind(':id_pengelola', $id_pengelola);
        return $this->db->resultSet();
    }

    public function countLapanganByPengelola($id_pengelola)
    {
        $this->db->query("SELECT COUNT(*) as total FROM lapangan WHERE id_pengelola = :id_pengelola");
        $this->db->bind(':id_pengelola', $id_pengelola);
        return $this->db->single()['total'];
    }

    public function countLapanganAktifByPengelola($id_pengelola)
    {
        $this->db->query("SELECT COUNT(*) as total FROM lapangan WHERE id_pengelola = :id_pengelola AND status = 'aktif'");
        $this->db->bind(':id_pengelola', $id_pengelola);
        return $this->db->single()['total'];
    }

    public function getPopularLapanganByPengelola($id_pengelola)
    {
        $this->db->query("SELECT l.*, k.nama_kategori, COUNT(b.id) as total_booking
                    FROM lapangan l
                    JOIN kategori_lapangan k ON l.id_kategori = k.id
                    LEFT JOIN booking b ON b.id_lapangan = l.id
                    WHERE l.id_pengelola = :id_pengelola
                    GROUP BY l.id, l.id_pengelola, l.id_kategori, l.nama_lapangan, l.deskripsi, l.harga_per_jam, l.fasilitas, l.foto_utama, l.status, l.created_at, k.nama_kategori
                    ORDER BY total_booking DESC
                    LIMIT 3");
        $this->db->bind(':id_pengelola', $id_pengelola);
        return $this->db->resultSet();
    }

    public function getMostPopularOverall()
    {
        $this->db->query("SELECT l.nama_lapangan 
                    FROM lapangan l 
                    LEFT JOIN booking b ON b.id_lapangan = l.id 
                    GROUP BY l.id, l.nama_lapangan 
                    ORDER BY COUNT(b.id) DESC 
                    LIMIT 1");
        $res = $this->db->single();
        return $res ? $res['nama_lapangan'] : 'Tidak ada data';
    }

    public function getMostPopularByPengelola($id_pengelola)
    {
        $this->db->query("SELECT l.nama_lapangan 
                    FROM lapangan l 
                    LEFT JOIN booking b ON b.id_lapangan = l.id 
                    WHERE l.id_pengelola = :id_pengelola 
                    GROUP BY l.id, l.nama_lapangan 
                    ORDER BY COUNT(b.id) DESC 
                    LIMIT 1");
        $this->db->bind(':id_pengelola', $id_pengelola);
        $res = $this->db->single();
        return $res ? $res['nama_lapangan'] : 'Tidak ada data';
    }

    public function getRecommendedLapangan()
    {
        $this->db->query("SELECT l.id, l.nama_lapangan, k.nama_kategori, l.foto_utama, l.harga_per_jam,
                           COALESCE(AVG(r.rating), 5.0) as rating
                    FROM lapangan l
                    JOIN kategori_lapangan k ON l.id_kategori = k.id
                    LEFT JOIN booking b ON b.id_lapangan = l.id
                    LEFT JOIN review r ON r.id_booking = b.id
                    WHERE l.status = 'aktif'
                    GROUP BY l.id, l.id_pengelola, l.id_kategori, l.nama_lapangan, l.deskripsi, l.harga_per_jam, l.fasilitas, l.foto_utama, l.status, l.created_at, k.nama_kategori
                    ORDER BY rating DESC
                    LIMIT 3");
        return $this->db->resultSet();
    }

    public function insertLapangan($id_pengelola, $id_kategori, $nama_lapangan, $deskripsi, $harga_per_jam, $fasilitas, $foto_utama, $status)
    {
        $this->db->query("INSERT INTO lapangan (id_pengelola, id_kategori, nama_lapangan, deskripsi, harga_per_jam, fasilitas, foto_utama, status)
                    VALUES (:id_pengelola, :id_kategori, :nama_lapangan, :deskripsi, :harga_per_jam, :fasilitas, :foto_utama, :status)");
        $this->db->bind(':id_pengelola', $id_pengelola);
        $this->db->bind(':id_kategori', $id_kategori);
        $this->db->bind(':nama_lapangan', $nama_lapangan);
        $this->db->bind(':deskripsi', $deskripsi);
        $this->db->bind(':harga_per_jam', $harga_per_jam);
        $this->db->bind(':fasilitas', $fasilitas);
        $this->db->bind(':foto_utama', $foto_utama);
        $this->db->bind(':status', $status);
        return $this->db->execute();
    }

    public function updateLapangan($id, $id_pengelola, $id_kategori, $nama_lapangan, $deskripsi, $harga_per_jam, $fasilitas, $foto_utama, $status)
    {
        $this->db->query("UPDATE lapangan 
                    SET id_kategori = :id_kategori, nama_lapangan = :nama_lapangan, deskripsi = :deskripsi, harga_per_jam = :harga_per_jam, fasilitas = :fasilitas, foto_utama = :foto_utama, status = :status
                    WHERE id = :id AND id_pengelola = :id_pengelola");
        $this->db->bind(':id', $id);
        $this->db->bind(':id_pengelola', $id_pengelola);
        $this->db->bind(':id_kategori', $id_kategori);
        $this->db->bind(':nama_lapangan', $nama_lapangan);
        $this->db->bind(':deskripsi', $deskripsi);
        $this->db->bind(':harga_per_jam', $harga_per_jam);
        $this->db->bind(':fasilitas', $fasilitas);
        $this->db->bind(':foto_utama', $foto_utama);
        $this->db->bind(':status', $status);
        return $this->db->execute();
    }

    public function deleteLapangan($id, $id_pengelola)
    {
        $this->db->query("DELETE FROM lapangan WHERE id = :id AND id_pengelola = :id_pengelola");
        $this->db->bind(':id', $id);
        $this->db->bind(':id_pengelola', $id_pengelola);
        return $this->db->execute();
    }

    public function countLapangan()
    {
        $this->db->query("SELECT COUNT(*) as total FROM lapangan");
        return $this->db->single()['total'];
    }

    public function getCategories()
    {
        $this->db->query("SELECT * FROM kategori_lapangan");
        return $this->db->resultSet();
    }

    public function getAllLapangan()
    {
        $this->db->query("SELECT l.*, k.nama_kategori, u.nama as nama_pengelola, COALESCE(AVG(r.rating), 5.0) as rating
                    FROM lapangan l
                    JOIN kategori_lapangan k ON l.id_kategori = k.id
                    JOIN users u ON l.id_pengelola = u.id
                    LEFT JOIN booking b ON b.id_lapangan = l.id
                    LEFT JOIN review r ON r.id_booking = b.id
                    GROUP BY l.id, l.id_pengelola, l.id_kategori, l.nama_lapangan, l.deskripsi, l.harga_per_jam, l.fasilitas, l.foto_utama, l.status, l.created_at, k.nama_kategori, u.nama");
        return $this->db->resultSet();
    }

    public function getCategoriesWithCount()
    {
        $this->db->query("SELECT k.*, COUNT(l.id) as total_lapangan 
                    FROM kategori_lapangan k 
                    LEFT JOIN lapangan l ON l.id_kategori = k.id 
                    GROUP BY k.id, k.nama_kategori, k.icon
                    ORDER BY k.nama_kategori ASC");
        return $this->db->resultSet();
    }
}

