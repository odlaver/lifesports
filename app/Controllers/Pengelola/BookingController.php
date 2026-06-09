<?php
namespace App\Controllers\Pengelola;

use App\Core\Controller;
use App\Core\Middleware;
use App\Core\View;
use App\Core\Flasher;
use App\Model\Booking;
use App\Model\Pembayaran;

class BookingController extends Controller {
    public function index() {
        Middleware::requireRole('pengelola');
        $id = $_SESSION['user_id'];
        $bookingModel = new Booking();

        $keyword = $_GET['search'] ?? '';
        $status  = $_GET['status'] ?? '';
        $tanggal = $_GET['tanggal'] ?? '';

        if (!empty($keyword) || (!empty($status) && $status !== 'Semua Status') || !empty($tanggal)) {
            $booking = $bookingModel->searchPengelola($id, $keyword, $status, $tanggal);
        } else {
            $booking = $bookingModel->findByPengelola($id);
        }

        $data = [
            'judul'  => 'Kelola Booking',
            'booking'=> $booking,
            'filter' => compact('keyword', 'status', 'tanggal'),
        ];
        View::render('pengelola/booking/index', $data);
    }
    public function show($id) {
        Middleware::requireRole('pengelola');
        $id_pengelola = $_SESSION['user_id'];
        $bookingModel = new Booking();
        $booking      = $bookingModel->findDetailsForPengelola($id, $id_pengelola);
        if (empty($booking)) {
            Flasher::setFlash('Data booking tidak ditemukan!', 'warning');
            $this->redirect('pengelola/booking');
            return;
        }
        $data = [
            'judul'  => 'Detail Booking',
            'booking'=> $booking,
        ];
        View::render('pengelola/booking/show', $data);
    }
    public function confirm($id) {
        Middleware::requireRole('pengelola');
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') { $this->redirect('pengelola/booking'); return; }
        $id_pengelola = $_SESSION['user_id'];
        $bookingModel = new Booking();
        $booking      = $bookingModel->findDetailsForPengelola($id, $id_pengelola);
        if (!$booking) {
            Flasher::setFlash('Data booking tidak ditemukan!', 'warning');
            $this->redirect('pengelola/booking');
            return;
        }
        if ($booking['status'] === 'dibayar') {
            $bookingModel->updateStatus($id, 'dikonfirmasi');
            $pembayaranModel = new Pembayaran();
            $pembayaran = $pembayaranModel->findByBooking($id);
            if ($pembayaran) { $pembayaranModel->verify($id); }
            Flasher::setFlash('Booking berhasil dikonfirmasi!', 'success');
        } else { Flasher::setFlash('Status booking tidak valid untuk dikonfirmasi.', 'warning'); }
        $this->redirect('pengelola/booking/' . $id);
    }
    public function reject($id) {
        Middleware::requireRole('pengelola');
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') { $this->redirect('pengelola/booking'); return; }
        $id_pengelola = $_SESSION['user_id'];
        $bookingModel = new Booking();
        $booking      = $bookingModel->findDetailsForPengelola($id, $id_pengelola);
        if (!$booking) {
            Flasher::setFlash('Data booking tidak ditemukan!', 'warning');
            $this->redirect('pengelola/booking');
            return;
        }
        if ($booking['status'] === 'dibayar' || $booking['status'] === 'pending' || $booking['status'] === 'dikonfirmasi') {
            $bookingModel->updateStatus($id, 'dibatalkan');
            $pembayaranModel = new Pembayaran();
            $pembayaran = $pembayaranModel->findByBooking($id);
            if ($pembayaran) { $pembayaranModel->reject($id); }
            Flasher::setFlash('Booking telah dibatalkan.', 'success');
        } else { Flasher::setFlash('Status booking tidak valid untuk dibatalkan.', 'warning'); }
        $this->redirect('pengelola/booking/' . $id);
    }
    public function complete($id) {
        Middleware::requireRole('pengelola');
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') { $this->redirect('pengelola/booking'); return; }
        $id_pengelola = $_SESSION['user_id'];
        $bookingModel = new Booking();
        $booking      = $bookingModel->findDetailsForPengelola($id, $id_pengelola);
        if (!$booking) {
            Flasher::setFlash('Data booking tidak ditemukan!', 'warning');
            $this->redirect('pengelola/booking');
            return;
        }
        if ($booking['status'] === 'dikonfirmasi') {
            $bookingModel->updateStatus($id, 'selesai');
            Flasher::setFlash('Booking berhasil ditandai selesai.', 'success');
        } else {
            Flasher::setFlash('Status booking tidak valid untuk diselesaikan.', 'warning');
        }
        $this->redirect('pengelola/booking/' . $id);
    }
}
