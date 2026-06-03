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

    public function user_form($id = null)
{
    $data['judul'] = $id ? 'Edit User' : 'Tambah User';
    $data['user'] = null;

    if ($id !== null) {
        $userModel = $this->model('User_model');
        $data['user'] = $userModel->getUserById($id);

        if (!$data['user']) {
            Flasher::setFlash('User tidak ditemukan!', 'warning');
            header('Location: ' . BASEURL . '/admin/users');
            exit;
        }
    }

    $this->view('admin/admin-user-form', $data);
}

 public function simpan_user()
{
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $id = $_POST['id'] ?? null;
        $nama = htmlspecialchars(trim($_POST['nama'] ?? ''));
        $email = htmlspecialchars(trim($_POST['email'] ?? ''));
        $no_telp = htmlspecialchars(trim($_POST['no_telp'] ?? ''));
        $role = htmlspecialchars(trim($_POST['role'] ?? ''));
        $password = trim($_POST['password'] ?? '');

        if (empty($nama) || empty($email) || empty($role)) {
            Flasher::setFlash('Nama, email, dan role wajib diisi!', 'warning');
            header('Location: ' . BASEURL . '/admin/user_form' . ($id ? '/' . $id : ''));
            exit;
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            Flasher::setFlash('Format email tidak valid!', 'warning');
            header('Location: ' . BASEURL . '/admin/user_form' . ($id ? '/' . $id : ''));
            exit;
        }

        $roleValid = ['admin', 'pengelola', 'pelanggan'];
        if (!in_array($role, $roleValid)) {
            Flasher::setFlash('Role tidak valid!', 'warning');
            header('Location: ' . BASEURL . '/admin/user_form' . ($id ? '/' . $id : ''));
            exit;
        }

        $userModel = $this->model('User_model');

        $existingUser = $userModel->checkEmailExists($email);
        if ($existingUser && $existingUser['id'] != $id) {
            Flasher::setFlash('Email sudah digunakan oleh user lain!', 'warning');
            header('Location: ' . BASEURL . '/admin/user_form' . ($id ? '/' . $id : ''));
            exit;
        }

        $data = [
            'id' => $id,
            'nama' => $nama,
            'email' => $email,
            'no_telp' => $no_telp,
            'role' => $role,
            'password' => $password
        ];

        if ($id) {
            $oldUser = $userModel->getUserById($id);
            if ($oldUser && $oldUser['role'] === 'pengelola' && $role !== 'pengelola') {
                $lapanganModel = $this->model('Lapangan_model');
                $totalLapangan = $lapanganModel->countLapanganByPengelola($id);
                if ($totalLapangan > 0) {
                    Flasher::setFlash('Role Pengelola tidak dapat diubah karena pengguna ini masih memiliki data Lapangan!', 'warning');
                    header('Location: ' . BASEURL . '/admin/user_form/' . $id);
                    exit;
                }
            }

            if ($userModel->updateUser($data) >= 0) {
                Flasher::setFlash('User berhasil diperbarui!', 'success');
                header('Location: ' . BASEURL . '/admin/users');
                exit;
            }
        } else {
            if (empty($password)) {
                Flasher::setFlash('Password wajib diisi untuk user baru!', 'warning');
                header('Location: ' . BASEURL . '/admin/user_form');
                exit;
            }

            if (strlen($password) < 6) {
                Flasher::setFlash('Password minimal 6 karakter!', 'warning');
                header('Location: ' . BASEURL . '/admin/user_form');
                exit;
            }

            if ($userModel->tambahUser($data) > 0) {
                Flasher::setFlash('User berhasil ditambahkan!', 'success');
                header('Location: ' . BASEURL . '/admin/users');
                exit;
            }
        }

        Flasher::setFlash('User gagal disimpan!', 'danger');
        header('Location: ' . BASEURL . '/admin/users');
        exit;
    }

    header('Location: ' . BASEURL . '/admin/users');
    exit;
}

public function hapus_user($id)
{
    if (empty($id)) {
        Flasher::setFlash('ID user tidak ditemukan!', 'warning');
        header('Location: ' . BASEURL . '/admin/users');
        exit;
    }

    if ($id == $_SESSION['user_id']) {
        Flasher::setFlash('Akun yang sedang login tidak boleh dihapus!', 'warning');
        header('Location: ' . BASEURL . '/admin/users');
        exit;
    }

    $userModel = $this->model('User_model');

    $user = $userModel->getUserById($id);

    if (!$user) {
        Flasher::setFlash('User tidak ditemukan!', 'warning');
        header('Location: ' . BASEURL . '/admin/users');
        exit;
    }

    if ($userModel->hapusUser($id) > 0) {
        Flasher::setFlash('User berhasil dihapus!', 'success');
    } else {
        Flasher::setFlash('User gagal dihapus!', 'danger');
    }

    header('Location: ' . BASEURL . '/admin/users');
    exit;
}

    public function kategori()
    {
        $data['judul'] = 'Kategori Lapangan';
        $lapanganModel = $this->model('Lapangan_model');
        $data['kategori'] = $lapanganModel->getCategoriesWithCount();

        $this->view('admin/admin-kategori', $data);
    }

    public function tambah_kategori()
{
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $nama_kategori = htmlspecialchars(trim($_POST['nama_kategori'] ?? ''));
        $icon = htmlspecialchars(trim($_POST['icon'] ?? ''));
        $deskripsi = htmlspecialchars(trim($_POST['deskripsi'] ?? ''));

        if (empty($nama_kategori)) {
            Flasher::setFlash('Nama kategori wajib diisi!', 'warning');
            header('Location: ' . BASEURL . '/admin/kategori');
            exit;
        }

        if (empty($icon)) {
            $icon = 'fas fa-futbol';
        }

        $lapanganModel = $this->model('Lapangan_model');

        if ($lapanganModel->tambahKategori($nama_kategori, $icon) > 0) {
            Flasher::setFlash('Kategori berhasil ditambahkan!', 'success');
        } else {
            Flasher::setFlash('Kategori gagal ditambahkan atau sudah ada!', 'danger');
        }

        header('Location: ' . BASEURL . '/admin/kategori');
        exit;
    }

    header('Location: ' . BASEURL . '/admin/kategori');
    exit;
}

public function edit_kategori($id)
{
    $data['judul'] = 'Edit Kategori';

    $lapanganModel = $this->model('Lapangan_model');
    $data['kategori'] = $lapanganModel->getKategoriById($id);

    if (!$data['kategori']) {
        Flasher::setFlash('Kategori tidak ditemukan!', 'warning');
        header('Location: ' . BASEURL . '/admin/kategori');
        exit;
    }

    $this->view('admin/admin-kategori-edit', $data);
}

public function update_kategori()
{
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $id = $_POST['id'] ?? null;
        $nama_kategori = htmlspecialchars(trim($_POST['nama_kategori'] ?? ''));
        $icon = htmlspecialchars(trim($_POST['icon'] ?? ''));

        if (empty($id) || empty($nama_kategori)) {
            Flasher::setFlash('Data kategori tidak lengkap!', 'warning');
            header('Location: ' . BASEURL . '/admin/kategori');
            exit;
        }

        if (empty($icon)) {
            $icon = 'fas fa-futbol';
        }

        $lapanganModel = $this->model('Lapangan_model');

        if ($lapanganModel->updateKategori($id, $nama_kategori, $icon) > 0) {
            Flasher::setFlash('Kategori berhasil diperbarui!', 'success');
        } else {
            Flasher::setFlash('Tidak ada perubahan data kategori.', 'info');
        }

        header('Location: ' . BASEURL . '/admin/kategori');
        exit;
    }

    header('Location: ' . BASEURL . '/admin/kategori');
    exit;
}

public function hapus_kategori($id)
{
    if (empty($id)) {
        Flasher::setFlash('ID kategori tidak ditemukan!', 'warning');
        header('Location: ' . BASEURL . '/admin/kategori');
        exit;
    }

    $lapanganModel = $this->model('Lapangan_model');

    $kategori = $lapanganModel->getKategoriById($id);

    if (!$kategori) {
        Flasher::setFlash('Kategori tidak ditemukan!', 'warning');
        header('Location: ' . BASEURL . '/admin/kategori');
        exit;
    }

    $totalLapangan = $lapanganModel->getTotalLapanganByKategori($id);

    if ($totalLapangan > 0) {
        Flasher::setFlash('Kategori tidak bisa dihapus karena masih digunakan oleh data lapangan!', 'warning');
        header('Location: ' . BASEURL . '/admin/kategori');
        exit;
    }

    if ($lapanganModel->hapusKategori($id) > 0) {
        Flasher::setFlash('Kategori berhasil dihapus!', 'success');
    } else {
        Flasher::setFlash('Kategori gagal dihapus!', 'danger');
    }

    header('Location: ' . BASEURL . '/admin/kategori');
    exit;
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
        $pembayaranModel = $this->model('Pembayaran_model');
        $data['pembayaran'] = $pembayaranModel->getAllPembayaranAdmin();
        $data['payment_stats'] = $pembayaranModel->getPaymentStatsAdmin();
        $data['total_revenue'] = $this->model('Booking_model')->totalAllRevenue();
        $this->view('admin/admin-pembayaran', $data);
    }

    public function laporan()
    {
        $data['judul'] = 'Laporan';
        
        $bookingModel = $this->model('Booking_model');
        $pembayaranModel = $this->model('Pembayaran_model');
        $userModel = $this->model('User_model');
        $lapanganModel = $this->model('Lapangan_model');
        
        $data['total_revenue'] = $bookingModel->totalAllRevenue();
        $data['total_booking'] = $bookingModel->countAllBookings();
        
        $stats = $bookingModel->getBookingStatsAdmin();
        $data['selesai_booking'] = $stats['selesai']['count'] ?? 0;
        
        $data['total_user'] = $userModel->countUsers();
        $data['total_lapangan'] = $lapanganModel->countLapangan();
        
        $data['top_lapangan'] = $bookingModel->getTopLapanganAdmin();
        $data['top_pengelola'] = $bookingModel->getTopPengelolaAdmin();
        
        $data['booking_stats'] = $bookingModel->getBookingStatsAdmin();
        $data['payment_stats'] = $pembayaranModel->getPaymentStatsAdmin();

        $this->view('admin/admin-laporan', $data);
    }
}
