<?php

class Admin extends Controller {
    public function index()
    {
        $data['judul'] = 'Dashboard Admin';
        $this->view('admin/admin', $data);
    }

    public function users()
    {
        $data['judul'] = 'Data Users';
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
        $this->view('admin/admin-kategori', $data);
    }

    public function lapangan()
    {
        $data['judul'] = 'Data Lapangan';
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
