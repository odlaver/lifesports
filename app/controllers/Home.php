<?php

class Home extends Controller {
    public function index()
    {
        $data['judul'] = 'Beranda';
        $this->view('public/index', $data);
    }

    public function lapangan()
    {
        $data['judul'] = 'Daftar Lapangan';
        $this->view('public/lapangan', $data);
    }
}
