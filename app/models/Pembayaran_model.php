<?php

class Pembayaran_model {
    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    public function getPembayaranByBooking($id_booking)
    {
        $this->db->query("SELECT * FROM pembayaran WHERE id_booking = :id_booking");
        $this->db->bind(':id_booking', $id_booking);
        return $this->db->single();
    }

    public function insertPembayaran($id_booking, $metode_pembayaran, $bukti_transfer)
    {
        $this->db->query("INSERT INTO pembayaran (id_booking, metode_pembayaran, bukti_transfer, status_pembayaran, waktu_pembayaran) 
                    VALUES (:id_booking, :metode_pembayaran, :bukti_transfer, 'menunggu', NOW())");
        $this->db->bind(':id_booking', $id_booking);
        $this->db->bind(':metode_pembayaran', $metode_pembayaran);
        $this->db->bind(':bukti_transfer', $bukti_transfer);
        return $this->db->execute();
    }

    public function getAllPembayaranByPengelola($id_pengelola)
    {
        $this->db->query("SELECT p.*, b.kode_booking, b.total_harga, u.nama as nama_pelanggan, b.id as booking_id
                    FROM pembayaran p
                    JOIN booking b ON p.id_booking = b.id
                    JOIN lapangan l ON b.id_lapangan = l.id
                    JOIN users u ON b.id_pelanggan = u.id
                    WHERE l.id_pengelola = :id_pengelola
                    ORDER BY p.waktu_pembayaran DESC");
        $this->db->bind(':id_pengelola', $id_pengelola);
        return $this->db->resultSet();
    }

    public function updatePembayaranStatus($id_booking, $status_pembayaran)
    {
        $this->db->query("UPDATE pembayaran SET status_pembayaran = :status_pembayaran WHERE id_booking = :id_booking");
        $this->db->bind(':status_pembayaran', $status_pembayaran);
        $this->db->bind(':id_booking', $id_booking);
        return $this->db->execute();
    }

    public function getPaymentStatsAdmin()
    {
        $pay_statuses = ['menunggu', 'valid', 'tidak_valid'];
        $stats = [];
        foreach ($pay_statuses as $pst) {
            $this->db->query("SELECT COUNT(*) as count, COALESCE(SUM(b.total_harga), 0) as total 
                        FROM pembayaran p 
                        JOIN booking b ON p.id_booking = b.id 
                        WHERE p.status_pembayaran = :status");
            $this->db->bind(':status', $pst);
            $stats[$pst] = $this->db->single();
        }
        return $stats;
    }
}
