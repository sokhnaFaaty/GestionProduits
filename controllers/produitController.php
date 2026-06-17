<?php
require_once(ROOT . "models/produitModel.php");

$ajoutProduit = function() {
    $errors = [];
    $save   = [];

    if(isset($_REQUEST["envoie"])){
        $save = $_POST;
        $data = [
            "libelle"  => trim($_REQUEST["libelle"]),
            "prix"     => trim($_REQUEST["prix"]),
            "quantite" => trim($_REQUEST["quantite"])
        ];

        $errors = validDataProduit($data);

        if(empty($errors)){
            addProduit($data);
            header("Location: " . path("produits","listeProduit"));
            exit();
        }
    }
    loadView("produits/ajoutProduit",[
        "errors" => $errors,
        "save"   => $save
    ],"base");
};

$supprimerProduit = function(){
    $id = (int)($_GET['id'] ?? 0);
    if ($id) deleteProduit($id);
    header("Location: " . path("produits","listeProduit"));
    exit;
};

$listeProduit = function(){
    $produits = getAllProduits();
    loadView("produits/listeProduit",["produits" => $produits],"side");
};

$modifierProduit = function(){
    $errors     = [];
    $save       = [];
    $id_produit = (int)($_REQUEST["id"] ?? 0);

    if(isset($_REQUEST["envoie"])){
        $save = $_POST;
        $data = [
            "libelle"  => trim($_REQUEST["libelle"]),
            "prix"     => trim($_REQUEST["prix"]),
            "quantite" => trim($_REQUEST["quantite"])
        ];

        $errors = validDataProduit($data);

        if(empty($errors)){
            updateProduit($id_produit, $data);
            header("Location: " . path("produits","listeProduit"));
            exit();
        }
    }

    $produit = getProduitById($id_produit);
    loadView("produits/ajoutProduit",[
        "errors"  => $errors,
        "save"    => $save,
        "id"      => $id_produit,
        "produit" => $produit,
    ],"base");
};

$pages = [
    "listeProduit"    => $listeProduit,
    "ajoutProduit"    => $ajoutProduit,
    "modifierProduit" => $modifierProduit,
    "supprimerProduit"=> $supprimerProduit
];

$page = $_REQUEST["page"] ?? "listeProduit";
if(array_key_exists($page, $pages)){
    $pages[$page]();
} else {
    echo "page introuvable";
    exit();
}
