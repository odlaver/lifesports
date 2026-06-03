<?php

class Home extends Controller {
    public function index()
    {
        $data['judul'] = 'Beranda';
        $data['rekomen'] = $this->model('Lapangan_model')->getRecommendedLapangan();
        $data['total_lapangan'] = $this->model('Lapangan_model')->countLapangan();
        $data['total_pelanggan'] = $this->model('User_model')->countUsers();
        $data['total_booking'] = $this->model('Booking_model')->countAllBookings();
        $this->view('public/index', $data);
    }

    public function lapangan()
    {
        $data['judul'] = 'Daftar Lapangan';
        
        $keyword = $_GET['search'] ?? '';
        $kategori = $_GET['sport'] ?? '';
        $lokasi = $_GET['location'] ?? '';
        $sort = $_GET['sort'] ?? '';
        $date = $_GET['date'] ?? '';

        $data['lapangan'] = $this->model('Lapangan_model')->searchLapangan($keyword, $kategori, $lokasi, $sort);
        $data['kategori'] = $this->model('Lapangan_model')->getCategories();
        
        $data['filter'] = [
            'search' => $keyword,
            'sport' => $kategori,
            'location' => $lokasi,
            'sort' => $sort,
            'date' => $date
        ];
        
        $this->view('public/lapangan', $data);
    }
}
