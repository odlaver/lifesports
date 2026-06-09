<?php
namespace App\Core;

class Controller {
    protected function redirect($url) {
        header('Location: ' . BASEURL . '/' . ltrim($url, '/'));
        exit;
    }
}
