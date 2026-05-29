<?php

class Pelanggan extends Controller {
    public function __construct()
    {
        if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'pelanggan') {
            Flasher::setFlash('Silakan login sebagai Pelanggan terlebih dahulu!', 'warning');
            header('Location: ' . BASEURL . '/auth/login');
            exit;
        }
    }

    public function index()
    {
        $data['judul'] = 'Dashboard Pelanggan';
        $id_pelanggan = $_SESSION['user_id'];

        $bookingModel = $this->model('Booking_model');
        $lapanganModel = $this->model('Lapangan_model');

        $data['total_booking'] = $bookingModel->countBookingByPelanggan($id_pelanggan);
        $data['menunggu_konfirmasi'] = $bookingModel->countBookingPendingByPelanggan($id_pelanggan);
        $data['selesai'] = $bookingModel->countBookingSelesaiByPelanggan($id_pelanggan);
        $data['total_belanja'] = $bookingModel->totalExpenditureByPelanggan($id_pelanggan);
        $data['booking_aktif'] = $bookingModel->getActiveBookingsByPelanggan($id_pelanggan);
        $data['riwayat_booking'] = $bookingModel->getRecentBookingsByPelanggan($id_pelanggan);
        $data['rekomendasi_lapangan'] = $lapanganModel->getRecommendedLapangan();

        $this->view('pelanggan/pelanggan', $data);
    }

    public function lapangan()
    {
        $data['judul'] = 'Daftar Lapangan';
        $lapanganModel = $this->model('Lapangan_model');

        $data['kategori'] = $lapanganModel->getCategories();
        $data['lapangan'] = $lapanganModel->getAllActiveLapangan();

        $this->view('pelanggan/pelanggan-lapangan', $data);
    }

    public function pelanggan_detail_lapangan($id = null)
    {
        if ($id === null) {
            header('Location: ' . BASEURL . '/pelanggan/lapangan');
            exit;
        }

        $data['judul'] = 'Detail Lapangan';
        $lapanganModel = $this->model('Lapangan_model');
        $reviewModel = $this->model('Review_model');

        $data['lapangan'] = $lapanganModel->getLapanganById($id);

        if (empty($data['lapangan'])) {
            Flasher::setFlash('Lapangan tidak ditemukan!', 'warning');
            header('Location: ' . BASEURL . '/pelanggan/lapangan');
            exit;
        }

        $data['review'] = $reviewModel->getReviewsByLapangan($id);
        $data['rating'] = $lapanganModel->getLapanganRating($id);

        $this->view('pelanggan/pelanggan-detail-lapangan', $data);
    }
    
    public function detail_lapangan($id = null)
    {
        $this->pelanggan_detail_lapangan($id);
    }

    public function proses_booking()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id_pelanggan = $_SESSION['user_id'];
            $id_lapangan = $_POST['id_lapangan'];
            $tanggal_main = $_POST['tanggal_main'];
            $jam_mulai = $_POST['jam_mulai'];
            $durasi = intval($_POST['durasi']);

            if (empty($id_lapangan) || empty($tanggal_main) || empty($jam_mulai) || empty($durasi)) {
                Flasher::setFlash('Semua data booking wajib diisi!', 'warning');
                header('Location: ' . BASEURL . '/pelanggan/pelanggan_detail_lapangan/' . $id_lapangan);
                exit;
            }

            $lapanganModel = $this->model('Lapangan_model');
            $bookingModel = $this->model('Booking_model');

            $lapangan = $lapanganModel->getLapanganById($id_lapangan);

            if (!$lapangan) {
                Flasher::setFlash('Lapangan tidak ditemukan!', 'warning');
                header('Location: ' . BASEURL . '/pelanggan/lapangan');
                exit;
            }

            $start_time = strtotime($jam_mulai);
            $end_time = $start_time + ($durasi * 3600);
            $jam_selesai = date('H:i:s', $end_time);

            $total_harga = $lapangan['harga_per_jam'] * $durasi;
            $kode_booking = 'BKG' . date('Ymd') . rand(1000, 9999);

            try {
                $bookingModel->insertBooking($kode_booking, $id_pelanggan, $id_lapangan, $tanggal_main, $jam_mulai, $jam_selesai, $total_harga);
                $new_booking_id = $bookingModel->getBookingIdByCode($kode_booking);

                Flasher::setFlash('Booking berhasil dibuat! Silakan lakukan pembayaran.', 'success');
                header('Location: ' . BASEURL . '/pelanggan/pembayaran/' . $new_booking_id);
                exit;
            } catch (PDOException $e) {
                Flasher::setFlash('Gagal membuat booking: ' . $e->getMessage(), 'warning');
                header('Location: ' . BASEURL . '/pelanggan/pelanggan_detail_lapangan/' . $id_lapangan);
                exit;
            }
        } else {
            header('Location: ' . BASEURL . '/pelanggan/lapangan');
            exit;
        }
    }

    public function pembayaran($id = null)
    {
        if ($id === null) {
            header('Location: ' . BASEURL . '/pelanggan/booking');
            exit;
        }
        
        $data['judul'] = 'Pembayaran';
        $bookingModel = $this->model('Booking_model');
        $data['booking'] = $bookingModel->getBookingById($id, $_SESSION['user_id']);

        if (empty($data['booking'])) {
            Flasher::setFlash('Pesanan tidak ditemukan!', 'warning');
            header('Location: ' . BASEURL . '/pelanggan/booking');
            exit;
        }

        $this->view('pelanggan/pembayaran', $data);
    }

    public function proses_pembayaran()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id_booking = $_POST['id_booking'];
            $metode_pembayaran = $_POST['metode_pembayaran'];

            if (empty($id_booking) || empty($metode_pembayaran)) {
                Flasher::setFlash('Metode pembayaran wajib dipilih!', 'warning');
                header('Location: ' . BASEURL . '/pelanggan/pembayaran/' . $id_booking);
                exit;
            }

            $bookingModel = $this->model('Booking_model');
            $pembayaranModel = $this->model('Pembayaran_model');

            $booking = $bookingModel->getBookingById($id_booking, $_SESSION['user_id']);

            if (!$booking) {
                Flasher::setFlash('Pemesanan tidak ditemukan!', 'warning');
                header('Location: ' . BASEURL . '/pelanggan/booking');
                exit;
            }

            $bukti_transfer = '';
            if (isset($_FILES['bukti_transfer']) && $_FILES['bukti_transfer']['error'] === 0) {
                $ext = pathinfo($_FILES['bukti_transfer']['name'], PATHINFO_EXTENSION);
                $allowed = ['jpg', 'jpeg', 'png', 'pdf'];
                
                if (in_array(strtolower($ext), $allowed)) {
                    $bukti_transfer = 'PAY_' . $id_booking . '_' . time() . '.' . $ext;
                    $target_dir = 'public/assets/uploads/pembayaran/';
                    
                    if (!is_dir($target_dir)) {
                        mkdir($target_dir, 0777, true);
                    }
                    
                    if (!move_uploaded_file($_FILES['bukti_transfer']['tmp_name'], $target_dir . $bukti_transfer)) {
                        Flasher::setFlash('Gagal mengunggah bukti transfer!', 'warning');
                        header('Location: ' . BASEURL . '/pelanggan/pembayaran/' . $id_booking);
                        exit;
                    }
                } else {
                    Flasher::setFlash('Format file tidak didukung! Gunakan JPG, JPEG, PNG, atau PDF.', 'warning');
                    header('Location: ' . BASEURL . '/pelanggan/pembayaran/' . $id_booking);
                    exit;
                }
            } else {
                Flasher::setFlash('Bukti transfer wajib diunggah!', 'warning');
                header('Location: ' . BASEURL . '/pelanggan/pembayaran/' . $id_booking);
                exit;
            }

            try {
                $pembayaranModel->insertPembayaran($id_booking, $metode_pembayaran, $bukti_transfer);
                $bookingModel->updateStatus($id_booking, 'dibayar');

                Flasher::setFlash('Bukti transfer berhasil diunggah! Menunggu verifikasi pengelola.', 'success');
                header('Location: ' . BASEURL . '/pelanggan/booking_detail/' . $id_booking);
                exit;
            } catch (PDOException $e) {
                Flasher::setFlash('Gagal memproses pembayaran: ' . $e->getMessage(), 'warning');
                header('Location: ' . BASEURL . '/pelanggan/pembayaran/' . $id_booking);
                exit;
            }
        } else {
            header('Location: ' . BASEURL . '/pelanggan/booking');
            exit;
        }
    }

    public function booking()
    {
        $data['judul'] = 'Riwayat Booking';
        $bookingModel = $this->model('Booking_model');
        $data['booking'] = $bookingModel->getAllBookingsByPelanggan($_SESSION['user_id']);

        $this->view('pelanggan/booking', $data);
    }

    public function booking_detail($id = null)
    {
        if ($id === null) {
            header('Location: ' . BASEURL . '/pelanggan/booking');
            exit;
        }

        $data['judul'] = 'Detail Booking';
        $bookingModel = $this->model('Booking_model');
        $pembayaranModel = $this->model('Pembayaran_model');

        $data['booking'] = $bookingModel->getBookingById($id, $_SESSION['user_id']);

        if (empty($data['booking'])) {
            Flasher::setFlash('Booking tidak ditemukan!', 'warning');
            header('Location: ' . BASEURL . '/pelanggan/booking');
            exit;
        }

        $data['pembayaran'] = $pembayaranModel->getPembayaranByBooking($id);

        $this->view('pelanggan/booking-detail', $data);
    }

    public function review($id = null)
    {
        if ($id === null) {
            header('Location: ' . BASEURL . '/pelanggan/booking');
            exit;
        }

        $data['judul'] = 'Tulis Review';
        $bookingModel = $this->model('Booking_model');

        $data['booking'] = $bookingModel->getBookingByIdForReview($id, $_SESSION['user_id']);

        if (empty($data['booking'])) {
            Flasher::setFlash('Anda hanya bisa mereview pemesanan yang berstatus selesai!', 'warning');
            header('Location: ' . BASEURL . '/pelanggan/booking');
            exit;
        }

        $this->view('pelanggan/review', $data);
    }

    public function proses_review()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id_booking = $_POST['id_booking'];
            $rating = intval($_POST['rating']);
            $ulasan = htmlspecialchars(trim($_POST['ulasan']));

            if (empty($id_booking) || empty($rating) || empty($ulasan)) {
                Flasher::setFlash('Semua kolom review wajib diisi!', 'warning');
                header('Location: ' . BASEURL . '/pelanggan/review/' . $id_booking);
                exit;
            }

            $reviewModel = $this->model('Review_model');

            try {
                $reviewModel->insertReview($id_booking, $rating, $ulasan);
                Flasher::setFlash('Review Anda berhasil disimpan! Terima kasih.', 'success');
                header('Location: ' . BASEURL . '/pelanggan/booking_detail/' . $id_booking);
                exit;
            } catch (PDOException $e) {
                Flasher::setFlash('Gagal menyimpan review: ' . $e->getMessage(), 'warning');
                header('Location: ' . BASEURL . '/pelanggan/review/' . $id_booking);
                exit;
            }
        } else {
            header('Location: ' . BASEURL . '/pelanggan/booking');
            exit;
        }
    }

    public function profile()
    {
        $data['judul'] = 'Profile Saya';
        $userModel = $this->model('User_model');
        $data['user'] = $userModel->getUserById($_SESSION['user_id']);

        $this->view('pelanggan/profile', $data);
    }

    public function proses_profile()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nama = htmlspecialchars(trim($_POST['nama']));
            $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
            $password = $_POST['password'];

            if (empty($nama) || empty($email)) {
                Flasher::setFlash('Nama dan email wajib diisi!', 'warning');
                header('Location: ' . BASEURL . '/pelanggan/profile');
                exit;
            }

            $id_pelanggan = $_SESSION['user_id'];
            $userModel = $this->model('User_model');

            $existing = $userModel->checkEmailExists($email);
            if ($existing && $existing['id'] != $id_pelanggan) {
                Flasher::setFlash('Email sudah digunakan oleh orang lain!', 'warning');
                header('Location: ' . BASEURL . '/pelanggan/profile');
                exit;
            }

            $hashed = null;
            if (!empty($password)) {
                $hashed = password_hash($password, PASSWORD_BCRYPT);
            }

            try {
                $userModel->updateProfile($id_pelanggan, $nama, $email, $hashed);
                
                $_SESSION['nama'] = $nama;
                $_SESSION['email'] = $email;

                Flasher::setFlash('Profil Anda berhasil diperbarui!', 'success');
                header('Location: ' . BASEURL . '/pelanggan/profile');
                exit;
            } catch (PDOException $e) {
                Flasher::setFlash('Gagal memperbarui profil: ' . $e->getMessage(), 'warning');
                header('Location: ' . BASEURL . '/pelanggan/profile');
                exit;
            }
        } else {
            header('Location: ' . BASEURL . '/pelanggan/profile');
            exit;
        }
    }
}
