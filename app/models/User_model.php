<?php

class User_model {
    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    public function getUserByEmail($email)
    {
        $this->db->query("SELECT * FROM users WHERE email = :email");
        $this->db->bind(':email', $email);
        return $this->db->single();
    }

    public function getUserById($id)
    {
        $this->db->query("SELECT * FROM users WHERE id = :id");
        $this->db->bind(':id', $id);
        return $this->db->single();
    }

    public function checkEmailExists($email)
    {
        $this->db->query("SELECT id FROM users WHERE email = :email");
        $this->db->bind(':email', $email);
        return $this->db->single();
    }

    public function register($nama, $email, $password)
    {
        $this->db->query("INSERT INTO users (nama, email, password, role) VALUES (:nama, :email, :password, 'pelanggan')");
        $this->db->bind(':nama', $nama);
        $this->db->bind(':email', $email);
        $this->db->bind(':password', $password);
        return $this->db->execute();
    }

    public function updateProfile($id, $nama, $email, $password = null)
    {
        if ($password !== null) {
            $this->db->query("UPDATE users SET nama = :nama, email = :email, password = :password WHERE id = :id");
            $this->db->bind(':password', $password);
        } else {
            $this->db->query("UPDATE users SET nama = :nama, email = :email WHERE id = :id");
        }
        $this->db->bind(':id', $id);
        $this->db->bind(':nama', $nama);
        $this->db->bind(':email', $email);
        return $this->db->execute();
    }

    public function getAllUsers()
    {
        $this->db->query("SELECT * FROM users ORDER BY role ASC, nama ASC");
        return $this->db->resultSet();
    }

    public function countUsers()
    {
        $this->db->query("SELECT COUNT(*) as total FROM users");
        return $this->db->single()['total'];
    }

public function tambahUser($data)
{
    $this->db->query("INSERT INTO users 
        (nama, email, password, no_telp, role, foto) 
        VALUES 
        (:nama, :email, :password, :no_telp, :role, 'default.jpg')
    ");

    $this->db->bind(':nama', $data['nama']);
    $this->db->bind(':email', $data['email']);
    $this->db->bind(':password', password_hash($data['password'], PASSWORD_DEFAULT));
    $this->db->bind(':no_telp', $data['no_telp']);
    $this->db->bind(':role', $data['role']);

    $this->db->execute();

    return $this->db->rowCount();
}

public function updateUser($data)
{
    if (!empty($data['password'])) {
        $this->db->query("UPDATE users 
            SET nama = :nama,
                email = :email,
                no_telp = :no_telp,
                role = :role,
                password = :password
            WHERE id = :id
        ");

        $this->db->bind(':password', password_hash($data['password'], PASSWORD_DEFAULT));
    } else {
        $this->db->query("UPDATE users 
            SET nama = :nama,
                email = :email,
                no_telp = :no_telp,
                role = :role
            WHERE id = :id
        ");
    }

    $this->db->bind(':nama', $data['nama']);
    $this->db->bind(':email', $data['email']);
    $this->db->bind(':no_telp', $data['no_telp']);
    $this->db->bind(':role', $data['role']);
    $this->db->bind(':id', $data['id']);

    $this->db->execute();

    return $this->db->rowCount();
}

public function hapusUser($id)
{
    $this->db->query("DELETE FROM users WHERE id = :id");
    $this->db->bind(':id', $id);

    $this->db->execute();

    return $this->db->rowCount();
}
}
