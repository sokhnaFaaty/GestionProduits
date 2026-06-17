<?php

function router(): array {
    return [
        'auth'      => ROOT . 'controllers/authController.php',
        'clients'   => ROOT . 'controllers/clientController.php',
        'produits'  => ROOT . 'controllers/produitController.php',
        'commandes' => ROOT . 'controllers/commandeController.php',
    ];
}

function gestionControllerPage(): void {
    if (session_status() === PHP_SESSION_NONE) session_start();

    // Déconnexion
    if (($_REQUEST['action'] ?? '') === 'logout') {
        session_destroy();
        header('Location: ' . APP_URL);
        exit();
    }

    $routes     = router();
    $controller = $_REQUEST['controller'] ?? array_key_first($routes);

    if (!array_key_exists($controller, $routes)) {
        http_response_code(404);
        echo "Contrôleur introuvable.";
        return;
    }

    require_once $routes[$controller];
}