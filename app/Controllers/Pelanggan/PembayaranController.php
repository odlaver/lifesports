<?php
namespace App\Controllers\Pelanggan;

use App\Core\Controller;
use App\Core\Middleware;
use App\Core\View;
use App\Core\Flasher;
use App\Model\Booking;
use App\Model\Pembayaran;

class PembayaranController extends Controller {
    public function create($bookingId) {
        Middleware::requireRole('pelanggan');
        $bookingModel = new Booking();
        $booking      = $bookingModel->findByPelangganId($bookingId, $_SESSION['user_id']);
        if (empty($booking)) {
            Flasher::setFlash('Pesanan tidak ditemukan!', 'warning');
            $this->redirect('pelanggan/booking');
            return;
        }
        if ($booking['status'] !== 'pending') {
            Flasher::setFlash('Pesanan ini sudah tidak bisa melakukan proses pembayaran baru!', 'warning');
            $this->redirect('pelanggan/booking/' . $bookingId);
            return;
        }
        if (empty($booking['info_pembayaran'])) {
            Flasher::setFlash('Metode pembayaran belum diatur oleh Pengelola. Silakan hubungi Pengelola terkait.', 'warning');
            $this->redirect('pelanggan/booking/' . $bookingId);
            return;
        }
        $data = [
            'judul'  => 'Pembayaran',
            'booking'=> $booking,
        ];
        View::render('pelanggan/pembayaran/create', $data);
    }
    public function store($bookingId = null) {
        Middleware::requireRole('pelanggan');
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') { $this->redirect('pelanggan/booking'); return; }
        $bookingId = $bookingId ?? ($_POST['id_booking'] ?? null);
        $metode_pembayaran = $_POST['metode_pembayaran'] ?? '';
        if (empty($bookingId) || empty($metode_pembayaran)) {
            Flasher::setFlash('Metode pembayaran wajib dipilih!', 'warning');
            $this->redirect('pelanggan/pembayaran/' . $bookingId);
            return;
        }
        $bookingModel    = new Booking();
        $pembayaranModel = new Pembayaran();
        $booking         = $bookingModel->findByPelangganId($bookingId, $_SESSION['user_id']);
        if (!$booking) {
            Flasher::setFlash('Pemesanan tidak ditemukan!', 'warning');
            $this->redirect('pelanggan/booking');
            return;
        }
        if ($booking['status'] !== 'pending') {
            Flasher::setFlash('Pesanan ini sudah tidak bisa menerima pembayaran baru!', 'warning');
            $this->redirect('pelanggan/booking/' . $bookingId);
            return;
        }
        if (empty($booking['info_pembayaran'])) {
            Flasher::setFlash('Metode pembayaran belum diatur oleh Pengelola!', 'warning');
            $this->redirect('pelanggan/booking/' . $bookingId);
            return;
        }
        if (!isset($_FILES['bukti_transfer']) || $_FILES['bukti_transfer']['error'] !== 0) {
            Flasher::setFlash('Bukti transfer wajib diunggah!', 'warning');
            $this->redirect('pelanggan/pembayaran/' . $bookingId);
            return;
        }
        if ($_FILES['bukti_transfer']['size'] > 5 * 1024 * 1024) {
            Flasher::setFlash('Ukuran bukti transfer maksimal 5MB.', 'warning');
            $this->redirect('pelanggan/pembayaran/' . $bookingId);
            return;
        }
        $ext     = pathinfo($_FILES['bukti_transfer']['name'], PATHINFO_EXTENSION);
        $allowed = ['jpg', 'jpeg', 'png', 'pdf'];
        if (!in_array(strtolower($ext), $allowed)) {
            Flasher::setFlash('Format file tidak didukung! Gunakan JPG, JPEG, PNG, atau PDF.', 'warning');
            $this->redirect('pelanggan/pembayaran/' . $bookingId);
            return;
        }
        $bukti_transfer = 'PAY_' . $bookingId . '_' . time() . '.' . $ext;
        $target_dir     = dirname(__DIR__, 3) . '/public/assets/uploads/pembayaran/';
        if (!is_dir($target_dir)) { mkdir($target_dir, 0777, true); }
        if (!move_uploaded_file($_FILES['bukti_transfer']['tmp_name'], $target_dir . $bukti_transfer)) {
            Flasher::setFlash('Gagal mengunggah bukti transfer!', 'warning');
            $this->redirect('pelanggan/pembayaran/' . $bookingId);
            return;
        }
        try {
            $pembayaranModel->create($bookingId, $metode_pembayaran, $bukti_transfer);
            $bookingModel->updateStatus($bookingId, 'dibayar');
            Flasher::setFlash('Bukti transfer berhasil diunggah! Menunggu verifikasi pengelola.', 'success');
            $this->redirect('pelanggan/booking/' . $bookingId);
        } catch (\PDOException $e) {
            Flasher::setFlash('Gagal memproses pembayaran.', 'warning');
            $this->redirect('pelanggan/pembayaran/' . $bookingId);
        }
    }
}
