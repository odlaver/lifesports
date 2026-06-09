<?php
namespace App\Controllers\Pelanggan;

use App\Core\Controller;
use App\Core\Middleware;
use App\Core\View;
use App\Core\Flasher;
use App\Model\User;

class ProfileController extends Controller {
    public function index() {
        Middleware::requireRole('pelanggan');
        $userModel = new User();
        $data = [
            'judul'=> 'Profile Saya',
            'user' => $userModel->findById($_SESSION['user_id']),
        ];
        View::render('pelanggan/profile/index', $data);
    }
    public function update() {
        Middleware::requireRole('pelanggan');
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') { $this->redirect('pelanggan/profile'); return; }
        $nama     = htmlspecialchars(trim($_POST['nama'] ?? ''));
        $email    = filter_var($_POST['email'] ?? '', FILTER_SANITIZE_EMAIL);
        $no_telp  = htmlspecialchars(trim($_POST['no_telp'] ?? ''));
        $password = $_POST['password'] ?? '';
        if (empty($nama) || empty($email)) {
            Flasher::setFlash('Nama dan email wajib diisi!', 'warning');
            $this->redirect('pelanggan/profile');
            return;
        }
        $id        = $_SESSION['user_id'];
        $userModel = new User();
        $existing = $userModel->checkEmailExists($email);
        if ($existing && $existing['id'] != $id) {
            Flasher::setFlash('Email sudah digunakan oleh orang lain!', 'warning');
            $this->redirect('pelanggan/profile');
            return;
        }
        $hashed = null;
        if (!empty($password)) { $hashed = password_hash($password, PASSWORD_BCRYPT); }
        try {
            $userModel->updateProfile($id, $nama, $email, $no_telp, $hashed);
            $_SESSION['nama']  = $nama;
            $_SESSION['email'] = $email;
            Flasher::setFlash('Profil Anda berhasil diperbarui!', 'success');
        } catch (\PDOException $e) {
            Flasher::setFlash('Gagal memperbarui profil.', 'warning');
        }
        $this->redirect('pelanggan/profile');
    }
    public function changePassword() {
        Middleware::requireRole('pelanggan');
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') { $this->redirect('pelanggan/profile'); return; }
        $password        = $_POST['password'] ?? '';
        $confirmPassword = $_POST['confirm_password'] ?? '';
        if (empty($password) || empty($confirmPassword)) {
            Flasher::setFlash('Kata sandi wajib diisi!', 'warning');
            $this->redirect('pelanggan/profile');
            return;
        }
        if ($password !== $confirmPassword) {
            Flasher::setFlash('Konfirmasi kata sandi tidak cocok!', 'warning');
            $this->redirect('pelanggan/profile');
            return;
        }
        $userModel = new User();
        $userModel->updatePassword($_SESSION['user_id'], password_hash($password, PASSWORD_BCRYPT));
        Flasher::setFlash('Kata sandi berhasil diperbarui!', 'success');
        $this->redirect('pelanggan/profile');
    }
}
