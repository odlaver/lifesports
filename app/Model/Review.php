<?php

namespace App\Model;

use App\Core\Database;

class Review
{
    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    public function all()
    {
        $this->db->query("SELECT r.*, u.nama, b.tanggal_main, l.nama_lapangan FROM review r JOIN booking b ON r.id_booking = b.id JOIN users u ON b.id_pelanggan = u.id JOIN lapangan l ON b.id_lapangan = l.id ORDER BY r.created_at DESC");
        return $this->db->resultSet();
    }

    public function findByLapangan($id_lapangan)
    {
        $this->db->query("SELECT r.*, u.nama, b.tanggal_main, k.nama_kategori FROM review r JOIN booking b ON r.id_booking = b.id JOIN users u ON b.id_pelanggan = u.id JOIN lapangan l ON b.id_lapangan = l.id JOIN kategori_lapangan k ON l.id_kategori = k.id WHERE l.id = :id ORDER BY r.created_at DESC");
        $this->db->bind(':id', $id_lapangan);
        return $this->db->resultSet();
    }

    public function create($id_booking, $rating, $komentar)
    {
        $this->db->query("INSERT INTO review (id_booking, rating, komentar, created_at) VALUES (:id_booking, :rating, :komentar, NOW())");
        $this->db->bind(':id_booking', $id_booking);
        $this->db->bind(':rating', $rating);
        $this->db->bind(':komentar', $komentar);
        return $this->db->execute();
    }

    public function averageRatingByLapangan($id_lapangan)
    {
        $this->db->query("SELECT COALESCE(AVG(r.rating), 5.0) as rating FROM review r JOIN booking b ON r.id_booking = b.id WHERE b.id_lapangan = :id");
        $this->db->bind(':id', $id_lapangan);
        return $this->db->single()['rating'];
    }

    public function checkExists($id_booking)
    {
        $this->db->query("SELECT COUNT(*) as total FROM review WHERE id_booking = :id_booking");
        $this->db->bind(':id_booking', $id_booking);
        return $this->db->single()['total'] > 0;
    }
}
