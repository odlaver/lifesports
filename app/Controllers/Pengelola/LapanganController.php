<?php
namespace App\Controllers\Pengelola;

use App\Core\Controller;
use App\Core\Middleware;
use App\Core\View;
use App\Core\Flasher;
use App\Model\Lapangan;

class LapanganController extends Controller {
    public function index() {
        Middleware::requireRole('pengelola');
        $id = $_SESSION['user_id'];
        $keyword  = $_GET['search'] ?? '';
        $status   = $_GET['status'] ?? '';
        $kategori = $_GET['sport'] ?? '';
        $lapanganModel = new Lapangan();
        if (!empty($keyword) || (!empty($status) && $status !== 'Semua Status') || (!empty($kategori) && $kategori !== 'Semua Kategori')) {
            $lapangan = $lapanganModel->searchByPengelola($id, $keyword, $status, $kategori);
        } else {
            $lapangan = $lapanganModel->findByPengelola($id);
        }
        $data = [
            'judul'   => 'Lapangan Saya',
            'lapangan'=> $lapangan,
            'kategori'=> $lapanganModel->getCategories(),
            'filter'  => [
                'search' => $keyword,
                'status' => $status,
                'sport'  => $kategori
            ],
        ];
        View::render('pengelola/lapangan/index', $data);
    }
    public function create() {
        Middleware::requireRole('pengelola');
        $lapanganModel = new Lapangan();
        $data = [
            'judul'   => 'Tambah Lapangan',
            'lapangan'=> [],
            'kategori'=> $lapanganModel->getCategories(),
        ];
        View::render('pengelola/lapangan/form', $data);
    }
    public function store() {
        Middleware::requireRole('pengelola');
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') { $this->redirect('pengelola/lapangan'); return; }
        $nama_lapangan = htmlspecialchars(trim($_POST['nama_lapangan'] ?? ''));
        $id_kategori   = intval($_POST['id_kategori'] ?? 0);
        $harga_per_jam = intval($_POST['harga_per_jam'] ?? 0);
        $status        = htmlspecialchars(trim($_POST['status'] ?? ''));
        $fasilitas     = htmlspecialchars(trim($_POST['fasilitas'] ?? ''));
        $deskripsi     = htmlspecialchars(trim($_POST['deskripsi'] ?? ''));
        $lokasi        = htmlspecialchars(trim($_POST['lokasi'] ?? 'Bandar Lampung'));
        $id_pengelola  = $_SESSION['user_id'];
        if (empty($nama_lapangan) || empty($id_kategori) || empty($harga_per_jam) || empty($status)) {
            Flasher::setFlash('Nama, kategori, harga, dan status wajib diisi!', 'warning');
            $this->redirect('pengelola/lapangan');
            return;
        }
        $foto_utama = 'default_lapangan.jpg';
        if (isset($_FILES['foto_utama']) && $_FILES['foto_utama']['error'] === 0) {
            $ext     = pathinfo($_FILES['foto_utama']['name'], PATHINFO_EXTENSION);
            $allowed = ['jpg', 'jpeg', 'png', 'webp'];
            if (in_array(strtolower($ext), $allowed)) {
                $foto_utama = 'LAP_' . time() . '_' . rand(100, 999) . '.' . $ext;
                $target     = dirname(__DIR__, 3) . '/public/assets/uploads/lapangan/' . $foto_utama;
                if (!is_dir(dirname($target))) { mkdir(dirname($target), 0777, true); }
                move_uploaded_file($_FILES['foto_utama']['tmp_name'], $target);
            }
        }
        try {
            $lapanganModel = new Lapangan();
            $lapanganModel->create($id_pengelola, $id_kategori, $nama_lapangan, $deskripsi, $harga_per_jam, $fasilitas, $foto_utama, $status, $lokasi);
            Flasher::setFlash('Data lapangan berhasil disimpan!', 'success');
        } catch (\PDOException $e) { Flasher::setFlash('Gagal menyimpan data.', 'warning'); }
        $this->redirect('pengelola/lapangan');
    }
    public function save() {
        Middleware::requireRole('pengelola');
        $id = $_POST['id'] ?? null;
        if ($id) {
            $this->update($id);
            return;
        }
        $this->store();
    }
    public function edit($id) {
        Middleware::requireRole('pengelola');
        $lapanganModel = new Lapangan();
        $lapangan      = $lapanganModel->findById($id);
        if (empty($lapangan) || $lapangan['id_pengelola'] != $_SESSION['user_id']) {
            Flasher::setFlash('Lapangan tidak ditemukan!', 'warning');
            $this->redirect('pengelola/lapangan');
            return;
        }
        $data = [
            'judul'   => 'Edit Lapangan',
            'lapangan'=> $lapangan,
            'kategori'=> $lapanganModel->getCategories(),
        ];
        View::render('pengelola/lapangan/form', $data);
    }
    public function update($id = null) {
        Middleware::requireRole('pengelola');
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') { $this->redirect('pengelola/lapangan'); return; }
        $id = $id ?? ($_POST['id'] ?? null);
        if (empty($id)) { $this->redirect('pengelola/lapangan'); return; }
        $id_pengelola  = $_SESSION['user_id'];
        $nama_lapangan = htmlspecialchars(trim($_POST['nama_lapangan'] ?? ''));
        $id_kategori   = intval($_POST['id_kategori'] ?? 0);
        $harga_per_jam = intval($_POST['harga_per_jam'] ?? 0);
        $status        = htmlspecialchars(trim($_POST['status'] ?? ''));
        $fasilitas     = htmlspecialchars(trim($_POST['fasilitas'] ?? ''));
        $deskripsi     = htmlspecialchars(trim($_POST['deskripsi'] ?? ''));
        $lokasi        = htmlspecialchars(trim($_POST['lokasi'] ?? 'Bandar Lampung'));
        if (empty($nama_lapangan) || empty($id_kategori) || empty($harga_per_jam) || empty($status)) {
            Flasher::setFlash('Nama, kategori, harga, dan status wajib diisi!', 'warning');
            $this->redirect('pengelola/lapangan');
            return;
        }
        $lapanganModel = new Lapangan();
        $old           = $lapanganModel->findById($id);
        $foto_utama    = $old ? $old['foto_utama'] : 'default_lapangan.jpg';
        if (isset($_FILES['foto_utama']) && $_FILES['foto_utama']['error'] === 0) {
            $ext     = pathinfo($_FILES['foto_utama']['name'], PATHINFO_EXTENSION);
            $allowed = ['jpg', 'jpeg', 'png', 'webp'];
            if (in_array(strtolower($ext), $allowed)) {
                $foto_utama = 'LAP_' . time() . '_' . rand(100, 999) . '.' . $ext;
                $target     = dirname(__DIR__, 3) . '/public/assets/uploads/lapangan/' . $foto_utama;
                if (!is_dir(dirname($target))) { mkdir(dirname($target), 0777, true); }
                move_uploaded_file($_FILES['foto_utama']['tmp_name'], $target);
            }
        }
        try {
            $lapanganModel->update($id, $id_pengelola, $id_kategori, $nama_lapangan, $deskripsi, $harga_per_jam, $fasilitas, $foto_utama, $status, $lokasi);
            Flasher::setFlash('Data lapangan berhasil diperbarui!', 'success');
        } catch (\PDOException $e) { Flasher::setFlash('Gagal memperbarui data.', 'warning'); }
        $this->redirect('pengelola/lapangan');
    }
    public function delete($id) {
        Middleware::requireRole('pengelola');
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') { $this->redirect('pengelola/lapangan'); return; }
        $id_pengelola  = $_SESSION['user_id'];
        $lapanganModel = new Lapangan();
        $lapangan      = $lapanganModel->findById($id);
        if (!$lapangan || $lapangan['id_pengelola'] != $id_pengelola) {
            Flasher::setFlash('Data lapangan tidak ditemukan atau akses ditolak.', 'warning');
            $this->redirect('pengelola/lapangan');
            return;
        }
        $bookingCount = $lapanganModel->getBookingCount($id);
        if ($bookingCount > 0) {
            Flasher::setFlash('Lapangan tidak dapat dihapus karena memiliki riwayat pemesanan. Silakan ubah statusnya menjadi Nonaktif.', 'warning');
            $this->redirect('pengelola/lapangan');
            return;
        }
        $fotoPath = dirname(__DIR__, 3) . '/public/assets/uploads/lapangan/' . $lapangan['foto_utama'];
        if ($lapangan['foto_utama'] !== 'default_lapangan.jpg' && file_exists($fotoPath)) { unlink($fotoPath); }
        try {
            $lapanganModel->delete($id, $id_pengelola);
            Flasher::setFlash('Data lapangan berhasil dihapus!', 'success');
        } catch (\PDOException $e) { Flasher::setFlash('Gagal menghapus data lapangan.', 'danger'); }
        $this->redirect('pengelola/lapangan');
    }
    public function toggleStatus($id) {
        Middleware::requireRole('pengelola');
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') { $this->redirect('pengelola/lapangan'); return; }
        $id_pengelola  = $_SESSION['user_id'];
        $lapanganModel = new Lapangan();
        $lapangan      = $lapanganModel->findById($id);
        if (!$lapangan || $lapangan['id_pengelola'] != $id_pengelola) {
            Flasher::setFlash('Data lapangan tidak ditemukan.', 'warning');
            $this->redirect('pengelola/lapangan');
            return;
        }
        $newStatus = $lapangan['status'] === 'aktif' ? 'nonaktif' : 'aktif';
        $lapanganModel->toggleStatus($id, $id_pengelola, $newStatus);
        Flasher::setFlash('Status lapangan berhasil diubah!', 'success');
        $this->redirect('pengelola/lapangan');
    }
}
