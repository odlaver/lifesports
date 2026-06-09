<?php
namespace App\Controllers\Pengelola;

use App\Core\Controller;
use App\Core\Middleware;
use App\Core\View;
use App\Core\Flasher;
use App\Model\User;

class ProfileController extends Controller {
    public function index() {
        Middleware::requireRole('pengelola');
        $userModel = new User();
        $data = [
            'judul'=> 'Profil Pengelola',
            'user' => $userModel->findById($_SESSION['user_id']),
        ];
        View::render('pengelola/profile/index', $data);
    }
    public function update() {
        Middleware::requireRole('pengelola');
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') { $this->redirect('pengelola/profile'); return; }
        
        $nama            = htmlspecialchars(trim($_POST['nama'] ?? ''));
        $email           = filter_var($_POST['email'] ?? '', FILTER_SANITIZE_EMAIL);
        $info_pembayaran = htmlspecialchars(trim($_POST['info_pembayaran'] ?? ''));
        $password        = $_POST['password'] ?? '';
        
        if (empty($nama) || empty($email) || empty($info_pembayaran)) {
            Flasher::setFlash('Nama, email, dan info pembayaran wajib diisi!', 'warning');
            $this->redirect('pengelola/profile');
            return;
        }
        
        $id = $_SESSION['user_id'];
        $userModel = new User();
        $existing = $userModel->checkEmailExists($email);
        
        if ($existing && $existing['id'] != $id) {
            Flasher::setFlash('Email sudah digunakan oleh orang lain!', 'warning');
            $this->redirect('pengelola/profile');
            return;
        }
        
        $hashed = null;
        if (!empty($password)) { $hashed = password_hash($password, PASSWORD_BCRYPT); }
        
        try {
            $userModel->updateProfilePengelola($id, $nama, $email, $info_pembayaran, $hashed);
            $_SESSION['nama']  = $nama;
            $_SESSION['email'] = $email;
            Flasher::setFlash('Profil Anda berhasil diperbarui!', 'success');
        } catch (\PDOException $e) {
            Flasher::setFlash('Gagal memperbarui profil.', 'warning');
        }
        $this->redirect('pengelola/profile');
    }
    public function changePassword() {
        Middleware::requireRole('pengelola');
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') { $this->redirect('pengelola/profile'); return; }
        
        $password        = $_POST['password'] ?? '';
        $confirmPassword = $_POST['confirm_password'] ?? '';
        
        if (empty($password) || empty($confirmPassword)) {
            Flasher::setFlash('Kata sandi wajib diisi!', 'warning');
            $this->redirect('pengelola/profile');
            return;
        }
        
        if ($password !== $confirmPassword) {
            Flasher::setFlash('Konfirmasi kata sandi tidak cocok!', 'warning');
            $this->redirect('pengelola/profile');
            return;
        }
        
        $userModel = new User();
        $userModel->updatePassword($_SESSION['user_id'], password_hash($password, PASSWORD_BCRYPT));
        Flasher::setFlash('Kata sandi berhasil diperbarui!', 'success');
        $this->redirect('pengelola/profile');
    }
}
