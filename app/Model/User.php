<?php

namespace App\Model;

use App\Core\Database;

class User
{
    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    public function all()
    {
        $this->db->query("SELECT * FROM users ORDER BY role ASC, nama ASC");
        return $this->db->resultSet();
    }

    public function search($keyword, $role)
    {
        $query = "SELECT * FROM users WHERE (nama LIKE :keyword OR email LIKE :keyword)";
        if (!empty($role) && $role !== 'Semua Role') {
            $query .= " AND role = :role";
        }
        $query .= " ORDER BY role ASC, nama ASC";
        
        $this->db->query($query);
        $this->db->bind(':keyword', "%$keyword%");
        if (!empty($role) && $role !== 'Semua Role') {
            $this->db->bind(':role', strtolower($role));
        }
        return $this->db->resultSet();
    }

    public function findById($id)
    {
        $this->db->query("SELECT * FROM users WHERE id = :id");
        $this->db->bind(':id', $id);
        return $this->db->single();
    }

    public function findByEmail($email)
    {
        $this->db->query("SELECT * FROM users WHERE email = :email");
        $this->db->bind(':email', $email);
        return $this->db->single();
    }

    public function checkEmailExists($email)
    {
        $this->db->query("SELECT id FROM users WHERE email = :email");
        $this->db->bind(':email', $email);
        return $this->db->single();
    }

    public function create($data)
    {
        $this->db->query("INSERT INTO users (nama, email, password, no_telp, role, foto) VALUES (:nama, :email, :password, :no_telp, :role, 'default.jpg')");
        $this->db->bind(':nama', $data['nama']);
        $this->db->bind(':email', $data['email']);
        $this->db->bind(':password', password_hash($data['password'], PASSWORD_DEFAULT));
        $this->db->bind(':no_telp', $data['no_telp'] ?? '');
        $this->db->bind(':role', $data['role']);
        $this->db->execute();
        return $this->db->rowCount();
    }

    public function register($nama, $email, $password)
    {
        $this->db->query("INSERT INTO users (nama, email, password, role) VALUES (:nama, :email, :password, 'pelanggan')");
        $this->db->bind(':nama', $nama);
        $this->db->bind(':email', $email);
        $this->db->bind(':password', $password);
        return $this->db->execute();
    }

    public function update($data)
    {
        if (!empty($data['password'])) {
            $this->db->query("UPDATE users SET nama = :nama, email = :email, no_telp = :no_telp, role = :role, password = :password WHERE id = :id");
            $this->db->bind(':password', password_hash($data['password'], PASSWORD_DEFAULT));
        } else {
            $this->db->query("UPDATE users SET nama = :nama, email = :email, no_telp = :no_telp, role = :role WHERE id = :id");
        }
        $this->db->bind(':nama', $data['nama']);
        $this->db->bind(':email', $data['email']);
        $this->db->bind(':no_telp', $data['no_telp'] ?? '');
        $this->db->bind(':role', $data['role']);
        $this->db->bind(':id', $data['id']);
        $this->db->execute();
        return $this->db->rowCount();
    }

    public function updateProfile($id, $nama, $email, $no_telp = '', $password = null)
    {
        if ($password !== null) {
            $this->db->query("UPDATE users SET nama = :nama, email = :email, no_telp = :no_telp, password = :password WHERE id = :id");
            $this->db->bind(':password', $password);
        } else {
            $this->db->query("UPDATE users SET nama = :nama, email = :email, no_telp = :no_telp WHERE id = :id");
        }
        $this->db->bind(':id', $id);
        $this->db->bind(':nama', $nama);
        $this->db->bind(':email', $email);
        $this->db->bind(':no_telp', $no_telp);
        return $this->db->execute();
    }

    public function updateProfilePengelola($id, $nama, $email, $info_pembayaran, $password = null)
    {
        if ($password !== null) {
            $this->db->query("UPDATE users SET nama = :nama, email = :email, info_pembayaran = :info_pembayaran, password = :password WHERE id = :id");
            $this->db->bind(':password', $password);
        } else {
            $this->db->query("UPDATE users SET nama = :nama, email = :email, info_pembayaran = :info_pembayaran WHERE id = :id");
        }
        $this->db->bind(':id', $id);
        $this->db->bind(':nama', $nama);
        $this->db->bind(':email', $email);
        $this->db->bind(':info_pembayaran', $info_pembayaran);
        return $this->db->execute();
    }

    public function delete($id)
    {
        $this->db->query("DELETE FROM users WHERE id = :id");
        $this->db->bind(':id', $id);
        $this->db->execute();
        return $this->db->rowCount();
    }

    public function authenticate($email, $password)
    {
        $user = $this->findByEmail($email);
        if ($user && password_verify($password, $user['password'])) {
            return $user;
        }
        return false;
    }

    public function updatePassword($id, $hashedPassword)
    {
        $this->db->query("UPDATE users SET password = :password WHERE id = :id");
        $this->db->bind(':password', $hashedPassword);
        $this->db->bind(':id', $id);
        return $this->db->execute();
    }

    public function countByRole($role)
    {
        $this->db->query("SELECT COUNT(*) as total FROM users WHERE role = :role");
        $this->db->bind(':role', $role);
        return $this->db->single()['total'];
    }

    public function countUsers()
    {
        $this->db->query("SELECT COUNT(*) as total FROM users");
        return $this->db->single()['total'];
    }
}
