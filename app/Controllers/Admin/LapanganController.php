<?php
namespace App\Controllers\Admin;

use App\Core\Controller;
use App\Core\Middleware;
use App\Core\View;
use App\Core\Flasher;
use App\Model\Lapangan;

class LapanganController extends Controller {
    public function index() {
        Middleware::requireRole('admin');
        $lapanganModel = new Lapangan();
        $kategoriModel = new \App\Model\Kategori();
        
        $keyword  = $_GET['search'] ?? '';
        $kategori = $_GET['sport'] ?? '';
        $status   = $_GET['status'] ?? '';
        
        if (!empty($keyword) || (!empty($status) && $status !== 'Semua Status') || (!empty($kategori) && $kategori !== 'Semua Kategori')) {
            $lapangan = $lapanganModel->searchAdmin($keyword, $status, $kategori);
        } else {
            $lapangan = $lapanganModel->all();
        }
        
        $data = [
            'judul'   => 'Kelola Lapangan',
            'lapangan'=> $lapangan,
            'kategori'=> $kategoriModel->all(),
            'filter'  => compact('keyword', 'kategori', 'status'),
        ];
        View::render('admin/lapangan/index', $data);
    }
    public function show($id) {
        Middleware::requireRole('admin');
        $lapanganModel = new Lapangan();
        $lapangan      = $lapanganModel->findById($id);
        if (empty($lapangan)) {
            Flasher::setFlash('Lapangan tidak ditemukan!', 'warning');
            $this->redirect('admin/lapangan');
            return;
        }
        $data = [
            'judul'   => 'Detail Lapangan',
            'lapangan'=> $lapangan,
        ];
        View::render('admin/lapangan/show', $data);
    }
    public function toggleStatus($id) {
        Middleware::requireRole('admin');
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') { $this->redirect('admin/lapangan'); return; }
        $lapanganModel = new Lapangan();
        $lapangan      = $lapanganModel->findById($id);
        if (!$lapangan) {
            Flasher::setFlash('Data lapangan tidak ditemukan.', 'warning');
            $this->redirect('admin/lapangan');
            return;
        }
        $newStatus = $lapangan['status'] === 'aktif' ? 'nonaktif' : 'aktif';
        $lapanganModel->toggleStatus($id, $lapangan['id_pengelola'], $newStatus);
        Flasher::setFlash('Status lapangan berhasil diubah!', 'success');
        $this->redirect('admin/lapangan');
    }
}
