<?php
namespace App\Controllers\Admin;

use App\Core\Controller;
use App\Core\Middleware;
use App\Core\View;
use App\Model\User;
use App\Model\Lapangan;
use App\Model\Booking;
use App\Model\Pembayaran;

class DashboardController extends Controller {
    public function index() {
        Middleware::requireRole('admin');
        $userModel       = new User();
        $lapanganModel   = new Lapangan();
        $bookingModel    = new Booking();
        $pembayaranModel = new Pembayaran();
        $data = [
            'judul'          => 'Dashboard Admin',
            'total_user'     => $userModel->countUsers(),
            'total_lapangan' => $lapanganModel->count(),
            'total_booking'  => $bookingModel->count(),
            'total_revenue'  => $bookingModel->totalRevenue(),
            'booking_stats'  => $bookingModel->getStats(),
            'payment_stats'  => $pembayaranModel->getStats(),
            'booking_terbaru'=> $bookingModel->getRecent(),
        ];
        View::render('admin/dashboard', $data);
    }
}
