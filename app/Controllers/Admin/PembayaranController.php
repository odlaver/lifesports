<?php
namespace App\Controllers\Admin;

use App\Core\Controller;
use App\Core\Middleware;
use App\Core\View;
use App\Model\Pembayaran;

class PembayaranController extends Controller {
    public function index() {
        Middleware::requireRole('admin');
        $pembayaranModel = new Pembayaran();
        $bookingModel = new \App\Model\Booking();
        $data = [
            'judul'         => 'Semua Transaksi',
            'pembayaran'    => $pembayaranModel->all(),
            'payment_stats' => $pembayaranModel->getStats(),
            'total_revenue' => $bookingModel->totalRevenue(),
        ];
        View::render('admin/pembayaran/index', $data);
    }
}
