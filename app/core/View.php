<?php
namespace App\Core;

class View {
    public static function render($view, $data = [], $layout = null) {
        $viewFile = dirname(__DIR__) . '/View/' . str_replace('.', '/', $view) . '.php';
        if (file_exists($viewFile)) {
            ob_start();
            extract($data);
            require $viewFile;
            $content = ob_get_clean();
            
            if ($layout === null) {
                if (strpos($view, 'admin/') === 0) $layout = 'admin';
                elseif (strpos($view, 'pengelola/') === 0) $layout = 'pengelola';
                elseif (strpos($view, 'pelanggan/') === 0) $layout = 'pelanggan';
                elseif (strpos($view, 'auth/') === 0) $layout = 'auth';
                else $layout = 'public';
            }
            
            $layoutFile = dirname(__DIR__) . '/View/layout/' . $layout . '.php';
            if (file_exists($layoutFile)) {
                require $layoutFile;
            } else {
                echo $content;
            }
        } else {
            echo "View file not found: " . $viewFile;
        }
    }
}
