<?php
namespace App\Controllers;

use App\Core\Controller;
use App\Core\View;
use App\Model\Lapangan;
use App\Model\Booking;
use App\Model\User;

class HomeController extends Controller {
    public function index() {
        $lapanganModel = new Lapangan();
        $bookingModel  = new Booking();
        $userModel     = new User();
        $data = [
            'judul'          => 'Beranda',
            'rekomen'        => $lapanganModel->getRecommended(),
            'total_lapangan' => $lapanganModel->count(),
            'total_pelanggan'=> $userModel->countUsers(),
            'total_booking'  => $bookingModel->count(),
        ];
        View::render('public/index', $data);
    }
    public function lapangan() {
        $keyword = $_GET['search'] ?? '';
        $kategori = $_GET['sport'] ?? '';
        $lokasi  = $_GET['location'] ?? '';
        $sort    = $_GET['sort'] ?? '';
        $date    = $_GET['date'] ?? '';
        $lapanganModel = new Lapangan();
        $data = [
            'judul'   => 'Daftar Lapangan',
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
        View::render('public/lapangan', $data);
    }
    public function detailLapangan($id) {
        $lapanganModel = new Lapangan();
        $lapangan      = $lapanganModel->findById($id);
        if (empty($lapangan)) { $this->redirect('lapangan'); return; }
        $reviewModel = new \App\Model\Review();
        $data = [
            'judul'   => 'Detail Lapangan',
            'lapangan'=> $lapangan,
            'review'  => $reviewModel->findByLapangan($id),
            'rating'  => $lapanganModel->getRating($id),
        ];
        View::render('pelanggan/lapangan/show', $data, 'public');
    }
}
