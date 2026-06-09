<?php
namespace App\Controllers\Admin;

use App\Core\Controller;
use App\Core\Middleware;
use App\Core\View;
use App\Core\Flasher;
use App\Model\Kategori;

class KategoriController extends Controller {
    public function index() {
        Middleware::requireRole('admin');
        $kategoriModel = new Kategori();
        $data = [
            'judul'   => 'Kelola Kategori',
            'kategori'=> $kategoriModel->allWithCount(),
        ];
        View::render('admin/kategori/index', $data);
    }
    public function store() {
        Middleware::requireRole('admin');
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') { $this->redirect('admin/kategori'); return; }
        $nama_kategori = htmlspecialchars(trim($_POST['nama_kategori'] ?? ''));
        $icon          = htmlspecialchars(trim($_POST['icon'] ?? 'fas fa-futbol'));
        if (empty($nama_kategori)) {
            Flasher::setFlash('Nama kategori wajib diisi!', 'warning');
            $this->redirect('admin/kategori');
            return;
        }
        $kategoriModel = new Kategori();
        try {
            $kategoriModel->create($nama_kategori, $icon);
            Flasher::setFlash('Kategori berhasil ditambahkan!', 'success');
        } catch (\PDOException $e) { Flasher::setFlash('Gagal menambahkan kategori.', 'warning'); }
        $this->redirect('admin/kategori');
    }
    public function edit($id) {
        Middleware::requireRole('admin');
        $kategoriModel = new Kategori();
        $kategori      = $kategoriModel->findById($id);
        if (empty($kategori)) {
            Flasher::setFlash('Kategori tidak ditemukan!', 'warning');
            $this->redirect('admin/kategori');
            return;
        }
        $data = [
            'judul'   => 'Edit Kategori',
            'kategori'=> $kategori,
        ];
        View::render('admin/kategori/form', $data);
    }
    public function update($id) {
        Middleware::requireRole('admin');
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') { $this->redirect('admin/kategori'); return; }
        $nama_kategori = htmlspecialchars(trim($_POST['nama_kategori'] ?? ''));
        $icon          = htmlspecialchars(trim($_POST['icon'] ?? 'fas fa-futbol'));
        if (empty($nama_kategori)) {
            Flasher::setFlash('Nama kategori wajib diisi!', 'warning');
            $this->redirect('admin/kategori');
            return;
        }
        $kategoriModel = new Kategori();
        try {
            $kategoriModel->update($id, $nama_kategori, $icon);
            Flasher::setFlash('Kategori berhasil diperbarui!', 'success');
        } catch (\PDOException $e) { Flasher::setFlash('Gagal memperbarui kategori.', 'warning'); }
        $this->redirect('admin/kategori');
    }
    public function delete($id) {
        Middleware::requireRole('admin');
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') { $this->redirect('admin/kategori'); return; }
        $kategoriModel = new Kategori();
        $totalLapangan = $kategoriModel->getTotalLapangan($id);
        if ($totalLapangan > 0) {
            Flasher::setFlash('Kategori tidak dapat dihapus karena masih digunakan oleh lapangan!', 'danger');
            $this->redirect('admin/kategori');
            return;
        }
        try {
            $kategoriModel->delete($id);
            Flasher::setFlash('Kategori berhasil dihapus!', 'success');
        } catch (\PDOException $e) { Flasher::setFlash('Gagal menghapus kategori.', 'danger'); }
        $this->redirect('admin/kategori');
    }
}
