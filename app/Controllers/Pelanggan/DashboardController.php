<?php
namespace App\Controllers\Pelanggan;

use App\Core\Controller;
use App\Core\Middleware;
use App\Core\View;
use App\Model\Booking;
use App\Model\Lapangan;

class DashboardController extends Controller {
    public function index() {
        Middleware::requireRole('pelanggan');
        $id = $_SESSION['user_id'];
        $bookingModel  = new Booking();
        $lapanganModel = new Lapangan();
        $data = [
            'judul'               => 'Dashboard Pelanggan',
            'total_booking'       => $bookingModel->countByPelanggan($id),
            'menunggu_konfirmasi' => $bookingModel->countPendingByPelanggan($id),
            'selesai'             => $bookingModel->countSelesaiByPelanggan($id),
            'total_belanja'       => $bookingModel->totalExpenditureByPelanggan($id),
            'booking_aktif'       => $bookingModel->getActiveByPelanggan($id),
            'riwayat_booking'     => $bookingModel->getRecentByPelanggan($id),
            'rekomendasi_lapangan'=> $lapanganModel->getRecommended(),
        ];
        View::render('pelanggan/dashboard', $data);
    }
}
