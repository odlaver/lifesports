<?php

class Flasher {
    public static function setFlash($pesan, $tipe)
    {
        $_SESSION['flash'] = [
            'pesan' => $pesan,
            'tipe' => $tipe
        ];
    }

    public static function flash()
    {
        if (isset($_SESSION['flash'])) {
            echo '<div class="alert warning">
                    <div>
                        <i class="fas fa-exclamation-triangle"></i> ' . $_SESSION['flash']['pesan'] . '
                    </div>
                  </div>';
            unset($_SESSION['flash']);
        }
    }
}
