<?php

namespace App\Model;

use App\Core\Database;

class Kategori
{
    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    public function all()
    {
        $this->db->query("SELECT * FROM kategori_lapangan ORDER BY nama_kategori ASC");
        return $this->db->resultSet();
    }

    public function allWithCount()
    {
        $this->db->query("SELECT k.*, COUNT(l.id) as total_lapangan FROM kategori_lapangan k LEFT JOIN lapangan l ON l.id_kategori = k.id GROUP BY k.id, k.nama_kategori, k.icon ORDER BY k.nama_kategori ASC");
        return $this->db->resultSet();
    }

    public function findById($id)
    {
        $this->db->query("SELECT * FROM kategori_lapangan WHERE id = :id");
        $this->db->bind(':id', $id);
        return $this->db->single();
    }

    public function create($nama_kategori, $icon)
    {
        $this->db->query("INSERT INTO kategori_lapangan (nama_kategori, icon) VALUES (:nama_kategori, :icon)");
        $this->db->bind(':nama_kategori', $nama_kategori);
        $this->db->bind(':icon', $icon);
        $this->db->execute();
        return $this->db->rowCount();
    }

    public function update($id, $nama_kategori, $icon)
    {
        $this->db->query("UPDATE kategori_lapangan SET nama_kategori = :nama_kategori, icon = :icon WHERE id = :id");
        $this->db->bind(':nama_kategori', $nama_kategori);
        $this->db->bind(':icon', $icon);
        $this->db->bind(':id', $id);
        $this->db->execute();
        return $this->db->rowCount();
    }

    public function delete($id)
    {
        $this->db->query("DELETE FROM kategori_lapangan WHERE id = :id");
        $this->db->bind(':id', $id);
        $this->db->execute();
        return $this->db->rowCount();
    }

    public function getTotalLapangan($id_kategori)
    {
        $this->db->query("SELECT COUNT(*) AS total FROM lapangan WHERE id_kategori = :id_kategori");
        $this->db->bind(':id_kategori', $id_kategori);
        $result = $this->db->single();
        return $result['total'] ?? 0;
    }
}
