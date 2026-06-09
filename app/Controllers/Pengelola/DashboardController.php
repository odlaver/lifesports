<?php
namespace App\Controllers\Pengelola;

use App\Core\Controller;
use App\Core\Middleware;
use App\Core\View;
use App\Model\Lapangan;
use App\Model\Booking;

class DashboardController extends Controller {
    public function index() {
        Middleware::requireRole('pengelola');
        $id = $_SESSION['user_id'];
        $lapanganModel = new Lapangan();
        $bookingModel  = new Booking();
        $data = [
            'judul'               => 'Dashboard Pengelola',
            'total_lapangan'      => $lapanganModel->countByPengelola($id),
            'total_lapangan_aktif'=> $lapanganModel->countAktifByPengelola($id),
            'booking_pending_count'=> $bookingModel->countPendingByPengelola($id),
            'total_booking'       => $bookingModel->countByPengelola($id),
            'total_booking_selesai'=> $bookingModel->countSelesaiByPengelola($id),
            'pendapatan_total'    => $bookingModel->totalRevenueByPengelola($id),
            'booking_pending'     => $bookingModel->getPendingByPengelola($id),
            'booking_hari_ini'    => $bookingModel->getTodayByPengelola($id),
            'lapangan_populer'    => $lapanganModel->getPopularByPengelola($id),
        ];
        View::render('pengelola/dashboard', $data);
    }
}
