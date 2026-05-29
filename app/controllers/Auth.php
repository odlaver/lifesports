<?php

class Auth extends Controller {
    public function index()
    {
        $this->login();
    }

    public function login()
    {
        if (isset($_SESSION['role'])) {
            $redirect = $_SESSION['role'] === 'pelanggan' ? 'pelanggan/lapangan' : $_SESSION['role'];
            header('Location: ' . BASEURL . '/' . $redirect);
            exit;
        }
        $data['judul'] = 'Login';
        $this->view('auth/login', $data);
    }

    public function register()
    {
        if (isset($_SESSION['role'])) {
            $redirect = $_SESSION['role'] === 'pelanggan' ? 'pelanggan/lapangan' : $_SESSION['role'];
            header('Location: ' . BASEURL . '/' . $redirect);
            exit;
        }
        $data['judul'] = 'Register';
        $this->view('auth/register', $data);
    }

    public function prosesLogin()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
            $password = $_POST['password'];

            if (empty($email) || empty($password)) {
                Flasher::setFlash('Email dan kata sandi harus diisi!', 'warning');
                header('Location: ' . BASEURL . '/auth/login');
                exit;
            }

            $user = $this->model('User_model')->getUserByEmail($email);

            if ($user && password_verify($password, $user['password'])) {
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['nama'] = $user['nama'];
                $_SESSION['email'] = $user['email'];
                $_SESSION['role'] = $user['role'];

                $redirect = $user['role'] === 'pelanggan' ? 'pelanggan/lapangan' : $user['role'];
                header('Location: ' . BASEURL . '/' . $redirect);
                exit;
            } else {
                Flasher::setFlash('Email atau kata sandi salah!', 'warning');
                header('Location: ' . BASEURL . '/auth/login');
                exit;
            }
        } else {
            header('Location: ' . BASEURL . '/auth/login');
            exit;
        }
    }

    public function prosesRegister()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nama = htmlspecialchars(trim($_POST['nama']));
            $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
            $password = $_POST['password'];
            $confirmPassword = $_POST['confirm-password'];

            if (empty($nama) || empty($email) || empty($password) || empty($confirmPassword)) {
                Flasher::setFlash('Semua field wajib diisi!', 'warning');
                header('Location: ' . BASEURL . '/auth/register');
                exit;
            }

            if ($password !== $confirmPassword) {
                Flasher::setFlash('Konfirmasi kata sandi tidak cocok!', 'warning');
                header('Location: ' . BASEURL . '/auth/register');
                exit;
            }

            $userModel = $this->model('User_model');
            $existingUser = $userModel->checkEmailExists($email);

            if ($existingUser) {
                Flasher::setFlash('Email sudah terdaftar!', 'warning');
                header('Location: ' . BASEURL . '/auth/register');
                exit;
            }

            $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
            try {
                $userModel->register($nama, $email, $hashedPassword);
                Flasher::setFlash('Registrasi berhasil! Silakan login.', 'success');
                header('Location: ' . BASEURL . '/auth/login');
                exit;
            } catch (PDOException $e) {
                Flasher::setFlash('Terjadi kesalahan saat registrasi: ' . $e->getMessage(), 'warning');
                header('Location: ' . BASEURL . '/auth/register');
                exit;
            }
        } else {
            header('Location: ' . BASEURL . '/auth/register');
            exit;
        }
    }

    public function logout()
    {
        $_SESSION = [];
        session_unset();
        session_destroy();

        header('Location: ' . BASEURL . '/auth/login');
        exit;
    }
}
