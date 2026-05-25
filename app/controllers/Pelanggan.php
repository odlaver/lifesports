<?php

class Pelanggan extends Controller {
    public function index()
    {
        $data['judul'] = 'Dashboard Pelanggan';
        $this->view('pelanggan/pelanggan', $data);
    }

    public function lapangan()
    {
        $data['judul'] = 'Daftar Lapangan';
        $this->view('pelanggan/pelanggan-lapangan', $data);
    }

    public function pelanggan_detail_lapangan()
    {
        $data['judul'] = 'Detail Lapangan';
        $this->view('pelanggan/pelanggan-detail-lapangan', $data);
    }
    
    public function detail_lapangan()
    {
        $data['judul'] = 'Detail Lapangan Umum';
        $this->view('pelanggan/detail-lapangan', $data);
    }

    public function booking()
    {
        $data['judul'] = 'Riwayat Booking';
        $this->view('pelanggan/booking', $data);
    }

    public function booking_detail()
    {
        $data['judul'] = 'Detail Booking';
        $this->view('pelanggan/booking-detail', $data);
    }

    public function pembayaran()
    {
        $data['judul'] = 'Pembayaran';
        $this->view('pelanggan/pembayaran', $data);
    }

    public function review()
    {
        $data['judul'] = 'Review';
        $this->view('pelanggan/review', $data);
    }

    public function profile()
    {
        $data['judul'] = 'Profil Saya';
        $this->view('pelanggan/profile', $data);
    }
}
