<?php

$protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 'https://' : 'http://';
$host = $_SERVER['HTTP_HOST'];
$script = str_replace('\\', '/', dirname($_SERVER['SCRIPT_NAME']));
if ($script === '/' || $script === '.') $script = '';
define('BASEURL', $protocol . $host . $script);

define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'lifesports');
