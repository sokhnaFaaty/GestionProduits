<?php


function router(){
    return [
        "clients" => ROOT."controllers/clientController.php",
        "produits"=>ROOT."controllers/produitController.php",
        "commandes" => ROOT."controllers/commandeController.php",
    ];
}

function gestionControllerPage(){
    $routes = router();
    $controller = $_REQUEST["controller"] ?? array_key_first($routes);

    if(!array_key_exists($controller, $routes)){
        echo "controleur introuvable";
        return;
    }


    $page = $_REQUEST["page"] ?? "listeCommande";

    if(isset($GLOBALS[$page]) && is_callable($GLOBALS[$page])){
        $GLOBALS[$page]();
    } else {
        echo "page introuvable";
    }
}

$routes = router();
$controller = $_REQUEST["controller"] ?? array_key_first($routes);
if(array_key_exists($controller, $routes)){
    require_once($routes[$controller]);
}

gestionControllerPage();