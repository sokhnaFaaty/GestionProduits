<?php


function router(){
    return [
        "clients" => ROOT."controllers/clientController.php",
        "produits"=>ROOT."controllers/produitController.php",
    ];
}
function gestionControllerPage(){
    $routes = router();
    $controller = $_REQUEST["controller"] ?? array_key_first($routes);

    if(!array_key_exists($controller ,$routes)){
        echo "controleur introuvable";
        return;
    }
    require_once($routes[$controller]);
    

    $page = $_REQUEST["page"] ?? $pages[0];
    if(!in_array($page,$pages)){
        echo "page introuvable";
    }else {

        $page();
    }
}
gestionControllerPage();



