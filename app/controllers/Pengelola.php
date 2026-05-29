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
        $data['lapangan'] = $lapanganModel->getLapanganByPengelola($id_pengelola);

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

        $newStatus = 'pending';
        if ($status === 'konfirmasi') {
            $newStatus = 'dikonfirmasi';
        } else if ($status === 'selesai') {
            $newStatus = 'selesai';
        } else if ($status === 'batal') {
            $newStatus = 'dibatalkan';
        }

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
}
