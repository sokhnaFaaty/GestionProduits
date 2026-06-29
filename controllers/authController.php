<?php
require_once ROOT . 'models/clientModel.php';

$login = function () {
    if (isConnected()) {
        if (hasRole('admin')) {
            redirectTo('clients', 'listeClient');
        } else {
            redirectTo('client', 'mesCommandes');
        }
    }

    $error = '';

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $email    = trim($_POST['email']    ?? '');
        $password = trim($_POST['password'] ?? '');

        if (empty($email) || empty($password)) {
            $error = 'Veuillez remplir tous les champs.';
        } else {
            // Vérifier admin
            if ($email === 'admin@gestionapp.com' && $password === 'admin123') {
                $_SESSION['user'] = ['role' => 'admin', 'nom' => 'Admin'];
                redirectTo('clients', 'listeClient');
            }

            // Vérifier client
            $client = getClientByEmail($email);
            if ($client && password_verify($password, $client['password'])) {
                $_SESSION['user'] = [
                    'role' => 'client',
                    'id'   => $client['id'],
                    'nom'  => $client['prenom'] . ' ' . $client['nom'],
                ];
                redirectTo('client', 'mesCommandes');
            }

            $error = 'Email ou mot de passe incorrect.';
        }
    }

    loadView('auth/login', ['error' => $error], 'auth');
};

$logout = function () {
    session_unset();
    session_destroy();
    redirectTo('auth', 'login');
};
$register = function () {
    if (isConnected()) {
        redirectTo('client', 'mesCommandes');
    }

    $errors = [];
    $save   = [];

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $save = $_POST;
        $errors = validDataClient($save);

        if (empty($errors)) {
    $clientEmail = getClientByEmail($save['email']);
    if ($clientEmail) {
        $errors['email'] = 'Cet email est déjà utilisé.';
    }

    $clientTel = getClientByTelephone($save['telephone']);
    if ($clientTel) {
        $errors['telephoneVide'] = 'Ce numéro de téléphone est déjà utilisé.';
    }

    if (empty($errors)) {
        saveClient([
            'nom'       => $save['nom'],
            'prenom'    => $save['prenom'],
            'telephone' => $save['telephone'],
            'email'     => $save['email'],
            'password'  => $save['password'],
        ]);
        redirectTo('auth', 'login');
    }
}}

    loadView('auth/register', ['errors' => $errors, 'save' => $save], 'auth');
};

$pages = [
    'login'  => $login,
    'logout' => $logout,
        'register' => $register,

];

$page = $_REQUEST['page'] ?? 'login';
if (array_key_exists($page, $pages)) {
    $pages[$page]();
} else {
    redirectTo('auth', 'login');
}