<?php
namespace App\Controllers\Admin;

use App\Core\Controller;
use App\Core\Middleware;
use App\Core\View;
use App\Model\Booking;
use App\Model\Lapangan;

class LaporanController extends Controller {
    public function index() {
        Middleware::requireRole('admin');
        $bookingModel    = new Booking();
        $lapanganModel   = new Lapangan();
        $userModel       = new \App\Model\User();
        $pembayaranModel = new \App\Model\Pembayaran();
        
        $booking_stats = $bookingModel->getStats();
        
        $data = [
            'judul'          => 'Laporan Sistem',
            'top_lapangan'   => $bookingModel->getTopLapangan(),
            'top_pengelola'  => $bookingModel->getTopPengelola(),
            'total_revenue'  => $bookingModel->totalRevenue(),
            'total_booking'  => $bookingModel->count(),
            'total_lapangan' => $lapanganModel->count(),
            'selesai_booking'=> $booking_stats['selesai']['count'] ?? 0,
            'total_user'     => $userModel->countUsers(),
            'booking_stats'  => $booking_stats,
            'payment_stats'  => $pembayaranModel->getStats()
        ];
        View::render('admin/laporan/index', $data);
    }
}
