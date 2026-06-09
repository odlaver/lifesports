<?php
namespace App\Controllers\Pelanggan;

use App\Core\Controller;
use App\Core\Middleware;
use App\Core\View;
use App\Core\Flasher;
use App\Model\Lapangan;
use App\Model\Review;

class LapanganController extends Controller {
    public function index() {
        Middleware::requireRole('pelanggan');
        $keyword  = $_GET['search'] ?? '';
        $kategori = $_GET['sport'] ?? '';
        $lokasi   = $_GET['location'] ?? '';
        $sort     = $_GET['sort'] ?? '';
        $date     = $_GET['date'] ?? '';
        $lapanganModel = new Lapangan();
        $data = [
            'judul'   => 'Cari Lapangan',
            'lapangan'=> $lapanganModel->search($keyword, $kategori, $lokasi, $sort),
            'kategori'=> $lapanganModel->getCategories(),
            'filter'  => [
                'search'   => $keyword,
                'sport'    => $kategori,
                'location' => $lokasi,
                'sort'     => $sort,
                'date'     => $date
            ],
        ];
        View::render('pelanggan/lapangan/index', $data);
    }

    public function show($id) {
        Middleware::requireRole('pelanggan');
        $lapanganModel = new Lapangan();
        $lapangan      = $lapanganModel->findById($id);
        if (empty($lapangan)) {
            Flasher::setFlash('Lapangan tidak ditemukan!', 'warning');
            $this->redirect('pelanggan/lapangan');
            return;
        }
        $reviewModel = new Review();
        $data = [
            'judul'   => 'Detail Lapangan',
            'lapangan'=> $lapangan,
            'review'  => $reviewModel->findByLapangan($id),
            'rating'  => $lapanganModel->getRating($id),
        ];
        View::render('pelanggan/lapangan/show', $data);
    }
}
