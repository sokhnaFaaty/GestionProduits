<?php
$path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
if ($path !== '/' && file_exists(__DIR__ . $path)) {
    return false; // fichiers statiques servis directement
}
require __DIR__ . '/index.php';
