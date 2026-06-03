<?php
require_once 'app/config/config.php';

try {
    $dbh = new PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME, DB_USER, DB_PASS);
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // Check if column exists
    $result = $dbh->query("SHOW COLUMNS FROM users LIKE 'info_pembayaran'");
    if ($result->rowCount() == 0) {
        $dbh->exec("ALTER TABLE users ADD COLUMN info_pembayaran VARCHAR(255) DEFAULT NULL AFTER no_telp");
        echo "Column info_pembayaran added successfully.\n";
    } else {
        echo "Column info_pembayaran already exists.\n";
    }

    // Process views
    $dir = 'app/views/pengelola/';
    $files = glob($dir . '*.php');
    foreach ($files as $file) {
        $content = file_get_contents($file);
        if (strpos($content, 'pengelola/profile') === false) {
            $search = '<li><a href="<?= BASEURL; ?>/auth/logout"';
            $replace = '<li><a href="<?= BASEURL; ?>/pengelola/profile"><i class="fas fa-user-cog"></i> Profil & Pembayaran</a></li>' . "\n" . '                ' . $search;
            $content = str_replace($search, $replace, $content);
            file_put_contents($file, $content);
            echo "Updated $file\n";
        } else {
            echo "Already updated $file\n";
        }
    }
} catch (PDOException $e) {
    die("DB Error: " . $e->getMessage());
}
