<?php
namespace App\Core;

class Middleware {
    public static function requireLogin() {
        if (!isset($_SESSION['user_id'])) {
            Flasher::setFlash('Silakan login terlebih dahulu!', 'warning');
            header('Location: ' . BASEURL . '/login');
            exit;
        }
    }
    public static function requireGuest() {
        if (isset($_SESSION['user_id'])) self::redirectByRole();
    }
    public static function requireRole($role) {
        self::requireLogin();
        if ($_SESSION['role'] !== $role) self::redirectByRole();
    }
    public static function redirectByRole() {
        $role = $_SESSION['role'] ?? null;
        if ($role === 'pelanggan') header('Location: ' . BASEURL . '/pelanggan');
        elseif ($role === 'pengelola') header('Location: ' . BASEURL . '/pengelola');
        elseif ($role === 'admin') header('Location: ' . BASEURL . '/admin');
        else header('Location: ' . BASEURL . '/login');
        exit;
    }
}
