<?php
namespace App\Core;

class AutoLoader {
    public static function register() {
        spl_autoload_register(function ($class) {
            $base = dirname(__DIR__, 2) . '/app/';
            $relative = str_replace('App\\', '', $class);
            $relative = str_replace('\\', '/', $relative);
            $file = $base . $relative . '.php';
            if (file_exists($file)) require_once $file;
        });
    }
}
