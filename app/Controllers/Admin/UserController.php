<?php
namespace App\Controllers\Admin;

use App\Core\Controller;
use App\Core\Middleware;
use App\Core\View;
use App\Core\Flasher;
use App\Model\User;

class UserController extends Controller {
    public function index() {
        Middleware::requireRole('admin');
        $userModel = new User();
        
        $keyword = $_GET['search'] ?? '';
        $role    = $_GET['role'] ?? '';
        
        if (!empty($keyword) || (!empty($role) && $role !== 'Semua Role')) {
            $users = $userModel->search($keyword, $role);
        } else {
            $users = $userModel->all();
        }
        
        $data = [
            'judul'=> 'Kelola Pengguna',
            'users'=> $users,
            'filter'=> compact('keyword', 'role'),
        ];
        View::render('admin/user/index', $data);
    }
    public function create() {
        Middleware::requireRole('admin');
        $data = [
            'judul'=> 'Tambah Pengguna',
            'user' => [],
        ];
        View::render('admin/user/form', $data);
    }
    public function store() {
        Middleware::requireRole('admin');
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') { $this->redirect('admin/user'); return; }
        $nama     = htmlspecialchars(trim($_POST['nama'] ?? ''));
        $email    = filter_var($_POST['email'] ?? '', FILTER_SANITIZE_EMAIL);
        $password = $_POST['password'] ?? '';
        $role     = $_POST['role'] ?? 'pelanggan';
        $no_telp  = htmlspecialchars(trim($_POST['no_telp'] ?? ''));
        if (empty($nama) || empty($email) || empty($password)) {
            Flasher::setFlash('Nama, Email, dan Password wajib diisi!', 'warning');
            $this->redirect('admin/user/create');
            return;
        }
        $userModel = new User();
        if ($userModel->checkEmailExists($email)) {
            Flasher::setFlash('Email sudah terdaftar!', 'warning');
            $this->redirect('admin/user/create');
            return;
        }
        $data = [
            'nama'    => $nama,
            'email'   => $email,
            'password'=> $password,
            'role'    => $role,
            'no_telp' => $no_telp,
        ];
        try {
            $userModel->create($data);
            Flasher::setFlash('Pengguna berhasil ditambahkan!', 'success');
        } catch (\PDOException $e) { Flasher::setFlash('Gagal menambahkan pengguna.', 'warning'); }
        $this->redirect('admin/user');
    }
    public function save() {
        Middleware::requireRole('admin');
        $id = $_POST['id'] ?? null;
        if ($id) {
            $this->update($id);
            return;
        }
        $this->store();
    }
    public function edit($id) {
        Middleware::requireRole('admin');
        $userModel = new User();
        $user      = $userModel->findById($id);
        if (empty($user)) {
            Flasher::setFlash('Pengguna tidak ditemukan!', 'warning');
            $this->redirect('admin/user');
            return;
        }
        $data = [
            'judul'=> 'Edit Pengguna',
            'user' => $user,
        ];
        View::render('admin/user/form', $data);
    }
    public function update($id) {
        Middleware::requireRole('admin');
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') { $this->redirect('admin/user'); return; }
        $nama    = htmlspecialchars(trim($_POST['nama'] ?? ''));
        $email   = filter_var($_POST['email'] ?? '', FILTER_SANITIZE_EMAIL);
        $role    = $_POST['role'] ?? 'pelanggan';
        $no_telp = htmlspecialchars(trim($_POST['no_telp'] ?? ''));
        $password= $_POST['password'] ?? '';
        if (empty($nama) || empty($email)) {
            Flasher::setFlash('Nama dan Email wajib diisi!', 'warning');
            $this->redirect('admin/user/edit/' . $id);
            return;
        }
        $userModel = new User();
        $existing  = $userModel->checkEmailExists($email);
        if ($existing && $existing['id'] != $id) {
            Flasher::setFlash('Email sudah terdaftar untuk pengguna lain!', 'warning');
            $this->redirect('admin/user/edit/' . $id);
            return;
        }
        $data = [
            'id'      => $id,
            'nama'    => $nama,
            'email'   => $email,
            'role'    => $role,
            'no_telp' => $no_telp,
            'password'=> $password,
        ];
        try {
            $userModel->update($data);
            Flasher::setFlash('Pengguna berhasil diperbarui!', 'success');
        } catch (\PDOException $e) { Flasher::setFlash('Gagal memperbarui pengguna.', 'warning'); }
        $this->redirect('admin/user');
    }
    public function delete($id) {
        Middleware::requireRole('admin');
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') { $this->redirect('admin/user'); return; }
        if ($id == $_SESSION['user_id']) {
            Flasher::setFlash('Anda tidak dapat menghapus akun Anda sendiri!', 'danger');
            $this->redirect('admin/user');
            return;
        }
        $userModel = new User();
        try {
            $userModel->delete($id);
            Flasher::setFlash('Pengguna berhasil dihapus!', 'success');
        } catch (\PDOException $e) { Flasher::setFlash('Gagal menghapus pengguna. Pastikan tidak ada data yang terkait.', 'danger'); }
        $this->redirect('admin/user');
    }
}
