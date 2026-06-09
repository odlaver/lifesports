<?php
namespace App\Controllers\Pelanggan;

use App\Core\Controller;
use App\Core\Middleware;
use App\Core\View;
use App\Core\Flasher;
use App\Model\Booking;
use App\Model\Lapangan;
use App\Model\Pembayaran;

class BookingController extends Controller {
    public function index() {
        Middleware::requireRole('pelanggan');
        $bookingModel = new Booking();

        $keyword = $_GET['search'] ?? '';
        $status  = $_GET['status'] ?? '';
        $tanggal = $_GET['tanggal'] ?? '';

        if (!empty($keyword) || (!empty($status) && $status !== 'Semua Status') || !empty($tanggal)) {
            $booking = $bookingModel->searchPelanggan($_SESSION['user_id'], $keyword, $status, $tanggal);
        } else {
            $booking = $bookingModel->findByUser($_SESSION['user_id']);
        }

        $data = [
            'judul'  => 'Riwayat Booking',
            'booking'=> $booking,
            'filter' => compact('keyword', 'status', 'tanggal'),
        ];
        View::render('pelanggan/booking/index', $data);
    }
    public function create($lapanganId) {
        Middleware::requireRole('pelanggan');
        $lapanganModel = new Lapangan();
        $lapangan      = $lapanganModel->findById($lapanganId);
        if (empty($lapangan)) {
            Flasher::setFlash('Lapangan tidak ditemukan!', 'warning');
            $this->redirect('pelanggan/lapangan');
            return;
        }
        $data = [
            'judul'  => 'Buat Booking',
            'lapangan'=> $lapangan,
        ];
        View::render('pelanggan/booking/create', $data);
    }
    public function store() {
        Middleware::requireRole('pelanggan');
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') { $this->redirect('pelanggan/lapangan'); return; }
        $id_pelanggan = $_SESSION['user_id'];
        $id_lapangan  = $_POST['id_lapangan'] ?? '';
        $tanggal_main = $_POST['tanggal_main'] ?? '';
        $jam_mulai    = $_POST['jam_mulai'] ?? '';
        $durasi       = intval($_POST['durasi'] ?? 0);
        if (empty($id_lapangan) || empty($tanggal_main) || empty($jam_mulai) || empty($durasi)) {
            Flasher::setFlash('Semua data booking wajib diisi!', 'warning');
            $this->redirect('pelanggan/lapangan/' . $id_lapangan);
            return;
        }
        if ($durasi <= 0 || $durasi > 12) {
            Flasher::setFlash('Durasi booking tidak valid (Maksimal 12 jam)!', 'warning');
            $this->redirect('pelanggan/lapangan/' . $id_lapangan);
            return;
        }
        $today    = date('Y-m-d');
        $now_time = date('H:i');
        if ($tanggal_main < $today) {
            Flasher::setFlash('Tidak dapat memesan untuk tanggal yang sudah lewat!', 'warning');
            $this->redirect('pelanggan/lapangan/' . $id_lapangan);
            return;
        }
        if ($tanggal_main === $today && $jam_mulai <= $now_time) {
            Flasher::setFlash('Jam mulai sudah lewat untuk hari ini!', 'warning');
            $this->redirect('pelanggan/lapangan/' . $id_lapangan);
            return;
        }
        $lapanganModel = new Lapangan();
        $bookingModel  = new Booking();
        $lapangan      = $lapanganModel->findById($id_lapangan);
        if (!$lapangan) {
            Flasher::setFlash('Lapangan tidak ditemukan!', 'warning');
            $this->redirect('pelanggan/lapangan');
            return;
        }
        if ($lapangan['status'] !== 'aktif') {
            Flasher::setFlash('Lapangan sedang tidak tersedia untuk booking.', 'warning');
            $this->redirect('pelanggan/lapangan');
            return;
        }
        $start_time  = strtotime($jam_mulai);
        $end_time    = $start_time + ($durasi * 3600);
        $jam_selesai = date('H:i:s', $end_time);
        if ($bookingModel->checkAvailability($id_lapangan, $tanggal_main, $jam_mulai, $jam_selesai)) {
            Flasher::setFlash('Jadwal pada tanggal dan jam tersebut sudah terisi, silakan pilih waktu lain!', 'warning');
            $this->redirect('pelanggan/lapangan/' . $id_lapangan);
            return;
        }
        $total_harga  = $lapangan['harga_per_jam'] * $durasi;
        $kode_booking = 'BKG' . date('Ymd') . rand(1000, 9999);
        try {
            $bookingModel->create($kode_booking, $id_pelanggan, $id_lapangan, $tanggal_main, $jam_mulai, $jam_selesai, $total_harga);
            $new_id = $bookingModel->getIdByCode($kode_booking);
            Flasher::setFlash('Booking berhasil dibuat! Silakan lakukan pembayaran.', 'success');
            $this->redirect('pelanggan/pembayaran/' . $new_id);
        } catch (\PDOException $e) {
            Flasher::setFlash('Gagal membuat booking.', 'warning');
            $this->redirect('pelanggan/lapangan/' . $id_lapangan);
        }
    }
    public function show($id) {
        Middleware::requireRole('pelanggan');
        $bookingModel  = new Booking();
        $pembayaranModel = new Pembayaran();
        $booking = $bookingModel->findByPelangganId($id, $_SESSION['user_id']);
        if (empty($booking)) {
            Flasher::setFlash('Booking tidak ditemukan!', 'warning');
            $this->redirect('pelanggan/booking');
            return;
        }
        $data = [
            'judul'     => 'Detail Booking',
            'booking'   => $booking,
            'pembayaran'=> $pembayaranModel->findByBooking($id),
        ];
        View::render('pelanggan/booking/show', $data);
    }
    public function cancel($id) {
        Middleware::requireRole('pelanggan');
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') { $this->redirect('pelanggan/booking'); return; }
        $bookingModel = new Booking();
        $booking      = $bookingModel->findByPelangganId($id, $_SESSION['user_id']);
        if (!$booking) {
            Flasher::setFlash('Booking tidak ditemukan!', 'warning');
            $this->redirect('pelanggan/booking');
            return;
        }
        if ($booking['status'] !== 'pending') {
            Flasher::setFlash('Booking ini tidak dapat dibatalkan!', 'warning');
            $this->redirect('pelanggan/booking/' . $id);
            return;
        }
        $bookingModel->cancel($id, $_SESSION['user_id']);
        Flasher::setFlash('Booking berhasil dibatalkan.', 'success');
        $this->redirect('pelanggan/booking');
    }
}
