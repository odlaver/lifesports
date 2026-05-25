<?php

class Pengelola extends Controller {
    public function index()
    {
        $data['judul'] = 'Dashboard Pengelola';
        $this->view('pengelola/pengelola', $data);
    }

    public function lapangan()
    {
        $data['judul'] = 'Lapangan Saya';
        $this->view('pengelola/pengelola-lapangan', $data);
    }

    public function lapangan_form()
    {
        $data['judul'] = 'Form Lapangan';
        $this->view('pengelola/pengelola-lapangan-form', $data);
    }

    public function booking()
    {
        $data['judul'] = 'Data Booking';
        $this->view('pengelola/pengelola-booking', $data);
    }

    public function booking_detail()
    {
        $data['judul'] = 'Detail Booking';
        $this->view('pengelola/pengelola-booking-detail', $data);
    }

    public function pembayaran()
    {
        $data['judul'] = 'Verifikasi Pembayaran';
        $this->view('pengelola/pengelola-pembayaran', $data);
    }

    public function laporan()
    {
        $data['judul'] = 'Laporan';
        $this->view('pengelola/pengelola-laporan', $data);
    }
}
