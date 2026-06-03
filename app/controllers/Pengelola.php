<?php

class Pengelola extends Controller {
    public function __construct()
    {
        if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'pengelola') {
            Flasher::setFlash('Akses ditolak! Halaman ini khusus untuk Pengelola.', 'warning');
            header('Location: ' . BASEURL . '/auth/login');
            exit;
        }
    }

    public function index()
    {
        $data['judul'] = 'Dashboard Pengelola';
        $id_pengelola = $_SESSION['user_id'];
        
        $lapanganModel = $this->model('Lapangan_model');
        $bookingModel = $this->model('Booking_model');

        $data['total_lapangan'] = $lapanganModel->countLapanganByPengelola($id_pengelola);
        $data['total_lapangan_aktif'] = $lapanganModel->countLapanganAktifByPengelola($id_pengelola);
        $data['booking_pending_count'] = $bookingModel->countBookingPendingByPengelola($id_pengelola);
        $data['total_booking'] = $bookingModel->countBookingByPengelola($id_pengelola);
        $data['total_booking_selesai'] = $bookingModel->countBookingSelesaiByPengelola($id_pengelola);
        $data['pendapatan_total'] = $bookingModel->totalRevenueByPengelola($id_pengelola);
        $data['booking_pending'] = $bookingModel->getPendingBookingsByPengelola($id_pengelola);
        $data['booking_hari_ini'] = $bookingModel->getTodayBookingsByPengelola($id_pengelola);
        $data['lapangan_populer'] = $lapanganModel->getPopularLapanganByPengelola($id_pengelola);

        $this->view('pengelola/pengelola', $data);
    }

    public function lapangan()
    {
        $data['judul'] = 'Lapangan Saya';
        $id_pengelola = $_SESSION['user_id'];
        $lapanganModel = $this->model('Lapangan_model');
        
        $keyword = $_GET['search'] ?? '';
        $status = $_GET['status'] ?? '';
        $kategori = $_GET['sport'] ?? '';

        $data['kategori'] = $lapanganModel->getCategories();
        
        if (!empty($keyword) || (!empty($status) && $status !== 'Semua Status') || (!empty($kategori) && $kategori !== 'Semua Kategori')) {
            $data['lapangan'] = $lapanganModel->searchLapanganPengelola($id_pengelola, $keyword, $status, $kategori);
        } else {
            $data['lapangan'] = $lapanganModel->getLapanganByPengelola($id_pengelola);
        }
        
        $data['filter'] = [
            'search' => $keyword,
            'status' => $status,
            'sport' => $kategori
        ];

        $this->view('pengelola/pengelola-lapangan', $data);
    }

    public function lapangan_form($id = null)
    {
        $data['judul'] = $id === null ? 'Tambah Lapangan' : 'Edit Lapangan';
        $lapanganModel = $this->model('Lapangan_model');

        $data['kategori'] = $lapanganModel->getCategories();

        if ($id !== null) {
            $data['lapangan'] = $lapanganModel->getLapanganById($id);

            if (empty($data['lapangan']) || $data['lapangan']['id_pengelola'] != $_SESSION['user_id']) {
                Flasher::setFlash('Lapangan tidak ditemukan!', 'warning');
                header('Location: ' . BASEURL . '/pengelola/lapangan');
                exit;
            }
        } else {
            $data['lapangan'] = [];
        }

        $this->view('pengelola/pengelola-lapangan-form', $data);
    }

    public function proses_lapangan()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = isset($_POST['id']) && !empty($_POST['id']) ? intval($_POST['id']) : null;
            $nama_lapangan = htmlspecialchars(trim($_POST['nama_lapangan']));
            $id_kategori = intval($_POST['id_kategori']);
            $harga_per_jam = intval($_POST['harga_per_jam']);
            $status = htmlspecialchars(trim($_POST['status']));
            $fasilitas = htmlspecialchars(trim($_POST['fasilitas']));
            $deskripsi = htmlspecialchars(trim($_POST['deskripsi']));

            if (empty($nama_lapangan) || empty($id_kategori) || empty($harga_per_jam) || empty($status)) {
                Flasher::setFlash('Nama, kategori, harga, dan status wajib diisi!', 'warning');
                header('Location: ' . BASEURL . '/pengelola/lapangan');
                exit;
            }

            $id_pengelola = $_SESSION['user_id'];
            $lapanganModel = $this->model('Lapangan_model');

            $foto_utama = 'default_lapangan.jpg';
            if (isset($_FILES['foto_utama']) && $_FILES['foto_utama']['error'] === 0) {
                $ext = pathinfo($_FILES['foto_utama']['name'], PATHINFO_EXTENSION);
                $allowed = ['jpg', 'jpeg', 'png', 'webp'];
                if (in_array(strtolower($ext), $allowed)) {
                    $foto_utama = 'LAP_' . time() . '_' . rand(100, 999) . '.' . $ext;
                    $target = 'public/assets/uploads/lapangan/' . $foto_utama;
                    if (!is_dir('public/assets/uploads/lapangan/')) {
                        mkdir('public/assets/uploads/lapangan/', 0777, true);
                    }
                    move_uploaded_file($_FILES['foto_utama']['tmp_name'], $target);
                }
            } else if ($id !== null) {
                $old = $lapanganModel->getLapanganById($id);
                if ($old) {
                    $foto_utama = $old['foto_utama'];
                }
            }

            try {
                if ($id === null) {
                    $lapanganModel->insertLapangan($id_pengelola, $id_kategori, $nama_lapangan, $deskripsi, $harga_per_jam, $fasilitas, $foto_utama, $status);
                } else {
                    $lapanganModel->updateLapangan($id, $id_pengelola, $id_kategori, $nama_lapangan, $deskripsi, $harga_per_jam, $fasilitas, $foto_utama, $status);
                }
                Flasher::setFlash('Data lapangan berhasil disimpan!', 'success');
                header('Location: ' . BASEURL . '/pengelola/lapangan');
                exit;
            } catch (PDOException $e) {
                Flasher::setFlash('Gagal menyimpan data: ' . $e->getMessage(), 'warning');
                header('Location: ' . BASEURL . '/pengelola/lapangan');
                exit;
            }
        } else {
            header('Location: ' . BASEURL . '/pengelola/lapangan');
            exit;
        }
    }

    public function hapus_lapangan($id = null)
    {
        if ($id === null) {
            header('Location: ' . BASEURL . '/pengelola/lapangan');
            exit;
        }

        $id_pengelola = $_SESSION['user_id'];
        $lapanganModel = $this->model('Lapangan_model');

        try {
            $lapangan = $lapanganModel->getLapanganById($id);
            if ($lapangan && $lapangan['id_pengelola'] == $id_pengelola) {

                $bookingModel = $this->model('Booking_model');
                $this->db = new Database();
                $this->db->query("SELECT COUNT(*) as total FROM booking WHERE id_lapangan = :id_lapangan");
                $this->db->bind(':id_lapangan', $id);
                $bookingCount = $this->db->single()['total'];

                if ($bookingCount > 0) {
                    Flasher::setFlash('Gagal: Lapangan tidak dapat dihapus permanen karena memiliki riwayat pemesanan. Silakan ubah statusnya menjadi Nonaktif melalui menu Edit.', 'warning');
                    header('Location: ' . BASEURL . '/pengelola/lapangan');
                    exit;
                }

                if ($lapangan['foto_utama'] !== 'default_lapangan.jpg' && file_exists('public/assets/uploads/lapangan/' . $lapangan['foto_utama'])) {
                    unlink('public/assets/uploads/lapangan/' . $lapangan['foto_utama']);
                }
                
                $lapanganModel->deleteLapangan($id, $id_pengelola);
                Flasher::setFlash('Data lapangan berhasil dihapus!', 'success');
            } else {
                Flasher::setFlash('Data lapangan tidak ditemukan atau akses ditolak.', 'warning');
            }
        } catch (PDOException $e) {
            Flasher::setFlash('Gagal menghapus data lapangan: ' . $e->getMessage(), 'danger');
        }

        header('Location: ' . BASEURL . '/pengelola/lapangan');
        exit;
    }

    public function booking()
    {
        $data['judul'] = 'Data Booking';
        $id_pengelola = $_SESSION['user_id'];
        $bookingModel = $this->model('Booking_model');
        $data['booking'] = $bookingModel->getAllBookingsByPengelola($id_pengelola);

        $this->view('pengelola/pengelola-booking', $data);
    }

    public function booking_detail($id = null)
    {
        if ($id === null) {
            header('Location: ' . BASEURL . '/pengelola/booking');
            exit;
        }

        $data['judul'] = 'Detail Booking Masuk';
        $id_pengelola = $_SESSION['user_id'];
        $bookingModel = $this->model('Booking_model');
        $data['booking'] = $bookingModel->getBookingDetailsForPengelola($id, $id_pengelola);

        if (empty($data['booking'])) {
            Flasher::setFlash('Booking tidak ditemukan!', 'warning');
            header('Location: ' . BASEURL . '/pengelola/booking');
            exit;
        }

        $this->view('pengelola/pengelola-booking-detail', $data);
    }

    public function konfirmasi_booking($id = null, $status = null)
    {
        if ($id === null || $status === null) {
            header('Location: ' . BASEURL . '/pengelola/booking');
            exit;
        }

        $id_pengelola = $_SESSION['user_id'];
        $bookingModel = $this->model('Booking_model');
        $pembayaranModel = $this->model('Pembayaran_model');
        
        $booking = $bookingModel->getBookingDetailsForPengelola($id, $id_pengelola);

        if (!$booking) {
            Flasher::setFlash('Akses ditolak atau booking tidak ditemukan!', 'warning');
            header('Location: ' . BASEURL . '/pengelola/booking');
            exit;
        }

        $allowedStatuses = [
            'konfirmasi' => 'dikonfirmasi', 
            'selesai' => 'selesai', 
            'batal' => 'dibatalkan'
        ];
        
        if (!array_key_exists($status, $allowedStatuses)) {
            Flasher::setFlash('Aksi tidak valid!', 'danger');
            header('Location: ' . BASEURL . '/pengelola/booking');
            exit;
        }
        
        $newStatus = $allowedStatuses[$status];

        try {
            $bookingModel->updateStatus($id, $newStatus);

            if ($newStatus === 'dikonfirmasi') {
                $pembayaranModel->updatePembayaranStatus($id, 'valid');
            } else if ($newStatus === 'dibatalkan') {
                $pembayaranModel->updatePembayaranStatus($id, 'tidak_valid');
            }

            Flasher::setFlash('Status booking berhasil diperbarui!', 'success');
        } catch (PDOException $e) {
            Flasher::setFlash('Gagal memperbarui status: ' . $e->getMessage(), 'warning');
        }

        header('Location: ' . BASEURL . '/pengelola/booking_detail/' . $id);
        exit;
    }

    public function pembayaran()
    {
        $data['judul'] = 'Verifikasi Pembayaran';
        $id_pengelola = $_SESSION['user_id'];
        $pembayaranModel = $this->model('Pembayaran_model');
        $data['pembayaran'] = $pembayaranModel->getAllPembayaranByPengelola($id_pengelola);

        $this->view('pengelola/pengelola-pembayaran', $data);
    }

    public function laporan()
    {
        $data['judul'] = 'Laporan';
        $id_pengelola = $_SESSION['user_id'];
        
        $bookingModel = $this->model('Booking_model');
        $lapanganModel = $this->model('Lapangan_model');

        $data['pendapatan_total'] = $bookingModel->totalRevenueByPengelola($id_pengelola);
        $data['total_booking'] = $bookingModel->countBookingByPengelola($id_pengelola);
        $data['lapangan_populer'] = $lapanganModel->getMostPopularByPengelola($id_pengelola);
        $data['monthly'] = $bookingModel->getMonthlyReportByPengelola($id_pengelola);

        $this->view('pengelola/pengelola-laporan', $data);
    }

    public function profile()
    {
        $data['judul'] = 'Profil & Pengaturan Pembayaran';
        $userModel = $this->model('User_model');
        $data['user'] = $userModel->getUserById($_SESSION['user_id']);

        $this->view('pengelola/pengelola-profile', $data);
    }

    public function proses_profile()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nama = htmlspecialchars(trim($_POST['nama']));
            $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
            $info_pembayaran = htmlspecialchars(trim($_POST['info_pembayaran']));
            $password = $_POST['password'];

            if (empty($nama) || empty($email) || empty($info_pembayaran)) {
                Flasher::setFlash('Nama, email, dan info pembayaran wajib diisi!', 'warning');
                header('Location: ' . BASEURL . '/pengelola/profile');
                exit;
            }

            $id_pengelola = $_SESSION['user_id'];
            $userModel = $this->model('User_model');

            $existing = $userModel->checkEmailExists($email);
            if ($existing && $existing['id'] != $id_pengelola) {
                Flasher::setFlash('Email sudah digunakan oleh orang lain!', 'warning');
                header('Location: ' . BASEURL . '/pengelola/profile');
                exit;
            }

            $hashed = null;
            if (!empty($password)) {
                $hashed = password_hash($password, PASSWORD_BCRYPT);
            }

            try {
                $userModel->updateProfilePengelola($id_pengelola, $nama, $email, $info_pembayaran, $hashed);
                
                $_SESSION['nama'] = $nama;
                $_SESSION['email'] = $email;

                Flasher::setFlash('Profil dan Pengaturan Pembayaran berhasil diperbarui!', 'success');
                header('Location: ' . BASEURL . '/pengelola/profile');
                exit;
            } catch (PDOException $e) {
                Flasher::setFlash('Gagal memperbarui profil: ' . $e->getMessage(), 'warning');
                header('Location: ' . BASEURL . '/pengelola/profile');
                exit;
            }
        } else {
            header('Location: ' . BASEURL . '/pengelola/profile');
            exit;
        }
    }
}
