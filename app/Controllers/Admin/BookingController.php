<?php
namespace App\Controllers\Admin;

use App\Core\Controller;
use App\Core\Middleware;
use App\Core\View;
use App\Core\Flasher;
use App\Model\Booking;
use App\Model\Pembayaran;

class BookingController extends Controller {
    public function index() {
        Middleware::requireRole('admin');
        $bookingModel = new Booking();

        $keyword = $_GET['search'] ?? '';
        $status  = $_GET['status'] ?? '';
        $tanggal = $_GET['tanggal'] ?? '';

        if (!empty($keyword) || (!empty($status) && $status !== 'Semua Status') || !empty($tanggal)) {
            $booking = $bookingModel->searchAdmin($keyword, $status, $tanggal);
        } else {
            $booking = $bookingModel->all();
        }

        $data = [
            'judul'  => 'Semua Booking',
            'booking'=> $booking,
            'filter' => compact('keyword', 'status', 'tanggal'),
        ];
        View::render('admin/booking/index', $data);
    }
    public function show($id) {
        Middleware::requireRole('admin');
        $bookingModel    = new Booking();
        $pembayaranModel = new Pembayaran();
        $booking         = $bookingModel->findById($id);
        if (empty($booking)) {
            Flasher::setFlash('Booking tidak ditemukan!', 'warning');
            $this->redirect('admin/booking');
            return;
        }
        $data = [
            'judul'     => 'Detail Booking',
            'booking'   => $booking,
            'pembayaran'=> $pembayaranModel->findByBooking($id),
        ];
        View::render('admin/booking/show', $data);
    }
}
