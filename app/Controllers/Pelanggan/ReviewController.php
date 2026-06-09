<?php
namespace App\Controllers\Pelanggan;

use App\Core\Controller;
use App\Core\Middleware;
use App\Core\View;
use App\Core\Flasher;
use App\Model\Booking;
use App\Model\Review;

class ReviewController extends Controller {
    public function create($bookingId) {
        Middleware::requireRole('pelanggan');
        $bookingModel = new Booking();
        $booking      = $bookingModel->findForReview($bookingId, $_SESSION['user_id']);
        if (empty($booking)) {
            Flasher::setFlash('Anda hanya bisa mereview pemesanan yang berstatus selesai!', 'warning');
            $this->redirect('pelanggan/booking');
            return;
        }
        $reviewModel = new Review();
        if ($reviewModel->checkExists($bookingId)) {
            Flasher::setFlash('Anda sudah memberikan review untuk pemesanan ini!', 'warning');
            $this->redirect('pelanggan/booking/' . $bookingId);
            return;
        }
        $data = [
            'judul'  => 'Tulis Review',
            'booking'=> $booking,
        ];
        View::render('pelanggan/review/create', $data);
    }
    public function store($bookingId = null) {
        Middleware::requireRole('pelanggan');
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') { $this->redirect('pelanggan/booking'); return; }
        $bookingId = $bookingId ?? ($_POST['id_booking'] ?? null);
        $rating  = intval($_POST['rating'] ?? 0);
        $ulasan  = htmlspecialchars(trim($_POST['ulasan'] ?? ''));
        if (empty($bookingId) || empty($rating) || empty($ulasan)) {
            Flasher::setFlash('Semua kolom review wajib diisi!', 'warning');
            $this->redirect('pelanggan/review/' . $bookingId);
            return;
        }
        $bookingModel = new Booking();
        $reviewModel  = new Review();
        $booking = $bookingModel->findForReview($bookingId, $_SESSION['user_id']);
        if (empty($booking)) {
            Flasher::setFlash('Anda tidak memiliki izin atau pemesanan belum selesai!', 'warning');
            $this->redirect('pelanggan/booking');
            return;
        }
        if ($reviewModel->checkExists($bookingId)) {
            Flasher::setFlash('Anda sudah memberikan review untuk pemesanan ini!', 'warning');
            $this->redirect('pelanggan/booking/' . $bookingId);
            return;
        }
        try {
            $reviewModel->create($bookingId, $rating, $ulasan);
            Flasher::setFlash('Review Anda berhasil disimpan! Terima kasih.', 'success');
            $this->redirect('pelanggan/booking/' . $bookingId);
        } catch (\PDOException $e) {
            Flasher::setFlash('Gagal menyimpan review.', 'warning');
            $this->redirect('pelanggan/review/' . $bookingId);
        }
    }
}
