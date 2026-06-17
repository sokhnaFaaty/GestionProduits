<?php
if (session_status() === PHP_SESSION_NONE) session_start();

$login = function () {
    if ($_SESSION['admin'] ?? false) {
        header('Location: ' . path('clients', 'listeClient'));
        exit();
    }

    $error = '';

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $email    = trim($_POST['email']    ?? '');
        $password = trim($_POST['password'] ?? '');

        // Modifie ces valeurs selon tes identifiants
        if ($email === 'admin@gestionapp.com' && $password === 'admin123') {
            $_SESSION['admin'] = true;
            header('Location: ' . path('clients', 'listeClient'));
            exit();
        }

        $error = 'Email ou mot de passe incorrect.';
    }

    loadView('auth/login', ['error' => $error], 'auth');
};

$logout = function () {
    session_destroy();
    header('Location: ' . path('auth', 'login'));
    exit();
};

$pages = [
    'login'  => $login,
    'logout' => $logout,
];

$page = $_REQUEST['page'] ?? 'login';
if (array_key_exists($page, $pages)) {
    $pages[$page]();
} else {
    header('Location: ' . path('auth', 'login'));
    exit();
}