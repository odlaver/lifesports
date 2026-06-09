<?php
namespace App\Core;

class Flasher {
    public static function setFlash($pesan, $tipe = 'warning') {
        $_SESSION['flash'] = ['pesan' => $pesan, 'tipe' => $tipe];
    }
    public static function flash() {
        if (isset($_SESSION['flash'])) {
            $tipe = htmlspecialchars($_SESSION['flash']['tipe']);
            $pesan = $_SESSION['flash']['pesan'];
            
            $icon = 'fa-info-circle';
            if ($tipe === 'success') {
                $icon = 'fa-check-circle';
            } elseif ($tipe === 'danger') {
                $icon = 'fa-times-circle';
            } elseif ($tipe === 'warning') {
                $icon = 'fa-exclamation-triangle';
            }

            echo '<div class="alert ' . $tipe . '"><div><i class="fas ' . $icon . '"></i> ' . $pesan . '</div></div>';
            unset($_SESSION['flash']);
        }
    }
}
