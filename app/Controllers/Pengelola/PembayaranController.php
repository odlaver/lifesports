<?php
namespace App\Controllers\Pengelola;

use App\Core\Controller;
use App\Core\Middleware;
use App\Core\View;
use App\Model\Pembayaran;

class PembayaranController extends Controller {
    public function index() {
        Middleware::requireRole('pengelola');
        $id = $_SESSION['user_id'];
        $pembayaranModel = new Pembayaran();
        $data = [
            'judul'     => 'Riwayat Transaksi',
            'pembayaran'=> $pembayaranModel->allByPengelola($id),
        ];
        View::render('pengelola/pembayaran/index', $data);
    }
}
