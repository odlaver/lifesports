<?php

class Admin extends Controller {
    public function __construct()
    {
        if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
            Flasher::setFlash('Akses ditolak! Halaman ini khusus untuk Admin.', 'warning');
            header('Location: ' . BASEURL . '/auth/login');
            exit;
        }
    }

    public function index()
    {
        $data['judul'] = 'Dashboard Admin';
        $userModel = $this->model('User_model');
        $lapanganModel = $this->model('Lapangan_model');
        $bookingModel = $this->model('Booking_model');
        $pembayaranModel = $this->model('Pembayaran_model');

        $data['total_user'] = $userModel->countUsers();
        $data['total_lapangan'] = $lapanganModel->countLapangan();
        $data['total_booking'] = $bookingModel->countAllBookings();
        $data['total_revenue'] = $bookingModel->totalAllRevenue();
        $data['booking_stats'] = $bookingModel->getBookingStatsAdmin();
        $data['payment_stats'] = $pembayaranModel->getPaymentStatsAdmin();
        $data['booking_terbaru'] = $bookingModel->getRecentBookingsAdmin();

        $this->view('admin/admin', $data);
    }

    public function users()
    {
        $data['judul'] = 'Data Users';
        $userModel = $this->model('User_model');
        $data['users'] = $userModel->getAllUsers();

        $this->view('admin/admin-users', $data);
    }

    public function user_form()
    {
        $data['judul'] = 'Form User';
        $this->view('admin/admin-user-form', $data);
    }

    public function kategori()
    {
        $data['judul'] = 'Kategori Lapangan';
        $lapanganModel = $this->model('Lapangan_model');
        $data['kategori'] = $lapanganModel->getCategoriesWithCount();

        $this->view('admin/admin-kategori', $data);
    }

    public function lapangan()
    {
        $data['judul'] = 'Data Lapangan';
        $lapanganModel = $this->model('Lapangan_model');
        $data['lapangan'] = $lapanganModel->getAllLapangan();

        $this->view('admin/admin-lapangan', $data);
    }

    public function lapangan_detail()
    {
        $data['judul'] = 'Detail Lapangan';
        $this->view('admin/admin-lapangan-detail', $data);
    }

    public function booking()
    {
        $data['judul'] = 'Data Booking';
        $bookingModel = $this->model('Booking_model');
        $data['booking'] = $bookingModel->getAllBookingsAdmin();

        $this->view('admin/admin-booking', $data);
    }


    public function booking_detail()
    {
        $data['judul'] = 'Detail Booking';
        $this->view('admin/admin-booking-detail', $data);
    }

    public function pembayaran()
    {
        $data['judul'] = 'Data Pembayaran';
        $this->view('admin/admin-pembayaran', $data);
    }

    public function laporan()
    {
        $data['judul'] = 'Laporan';
        $this->view('admin/admin-laporan', $data);
    }
}
