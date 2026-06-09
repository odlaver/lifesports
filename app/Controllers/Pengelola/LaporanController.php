<?php
namespace App\Controllers\Pengelola;

use App\Core\Controller;
use App\Core\Middleware;
use App\Core\View;
use App\Model\Booking;

class LaporanController extends Controller {
    public function index() {
        Middleware::requireRole('pengelola');
        $id = $_SESSION['user_id'];
        $bookingModel = new Booking();
        $data = [
            'judul'           => 'Laporan Keuangan',
            'monthly'         => $bookingModel->getMonthlyByPengelola($id),
            'pendapatan_total'=> $bookingModel->totalRevenueByPengelola($id),
            'total_booking'   => $bookingModel->countByPengelola($id),
            'lapangan_populer'=> $bookingModel->getTopLapanganByPengelola($id),
        ];
        View::render('pengelola/laporan/index', $data);
    }
}
