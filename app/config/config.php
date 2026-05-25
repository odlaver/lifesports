<?php

// Deteksi otomatis BASEURL
$protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 'https://' : 'http://';
$host = $_SERVER['HTTP_HOST'];
$script = rtrim(dirname($_SERVER['SCRIPT_NAME']), '/\\');
define('BASEURL', $protocol . $host . $script);

// DB Constants
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'lifesports');
