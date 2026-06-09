<?php
namespace App\Controllers;

use App\Core\Controller;
use App\Core\View;
use App\Core\Flasher;
use App\Model\User;

class AuthController extends Controller {
    public function showLogin() {
        if (isset($_SESSION['user_id'])) {
            $redirect = $_SESSION['role'] === 'pelanggan' ? 'pelanggan/lapangan' : $_SESSION['role'];
            $this->redirect($redirect);
            return;
        }
        $data = ['judul' => 'Login'];
        View::render('auth/login', $data);
    }

    public function showRegister() {
        if (isset($_SESSION['user_id'])) {
            $redirect = $_SESSION['role'] === 'pelanggan' ? 'pelanggan/lapangan' : $_SESSION['role'];
            $this->redirect($redirect);
            return;
        }
        $data = ['judul' => 'Register'];
        View::render('auth/register', $data);
    }

    public function login() {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            $this->redirect('auth/login');
            return;
        }

        $email = filter_var($_POST['email'] ?? '', FILTER_SANITIZE_EMAIL);
        $password = $_POST['password'] ?? '';

        if (empty($email) || empty($password)) {
            Flasher::setFlash('Email dan password wajib diisi!', 'warning');
            $this->redirect('auth/login');
            return;
        }

        $userModel = new User();
        $user = $userModel->findByEmail($email);

        if ($user && password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['nama']    = $user['nama'];
            $_SESSION['email']   = $user['email'];
            $_SESSION['role']    = $user['role'];

            $redirect = $user['role'] === 'pelanggan' ? 'pelanggan/lapangan' : $user['role'];
            $this->redirect($redirect);
        } else {
            Flasher::setFlash('Email atau password salah!', 'danger');
            $this->redirect('auth/login');
        }
    }

    public function register() {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            $this->redirect('auth/register');
            return;
        }

        $nama = htmlspecialchars(trim($_POST['nama'] ?? ''));
        $email = filter_var($_POST['email'] ?? '', FILTER_SANITIZE_EMAIL);
        $password = $_POST['password'] ?? '';
        $konfirmasi_password = $_POST['konfirmasi_password'] ?? '';

        if (empty($nama) || empty($email) || empty($password)) {
            Flasher::setFlash('Semua field wajib diisi!', 'warning');
            $this->redirect('auth/register');
            return;
        }

        if ($password !== $konfirmasi_password) {
            Flasher::setFlash('Password dan konfirmasi tidak cocok!', 'warning');
            $this->redirect('auth/register');
            return;
        }

        $userModel = new User();
        
        if ($userModel->checkEmailExists($email)) {
            Flasher::setFlash('Email sudah terdaftar!', 'warning');
            $this->redirect('auth/register');
            return;
        }

        $data = [
            'nama'     => $nama,
            'email'    => $email,
            'password' => $password,
            'role'     => 'pelanggan'
        ];

        try {
            if ($userModel->create($data)) {
                Flasher::setFlash('Registrasi berhasil! Silakan login.', 'success');
                $this->redirect('auth/login');
            } else {
                Flasher::setFlash('Gagal mendaftar, silakan coba lagi.', 'danger');
                $this->redirect('auth/register');
            }
        } catch (\Exception $e) {
            Flasher::setFlash('Terjadi kesalahan pada server.', 'danger');
            $this->redirect('auth/register');
        }
    }

    public function logout() {
        session_unset();
        session_destroy();
        $this->redirect('auth/login');
    }
}
