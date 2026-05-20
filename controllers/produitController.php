<?php
require_once(ROOT . "models/produitModel.php");



$ajoutProduit = function() {
    $errors = [];
    $save   = [];

    if(isset($_REQUEST["envoie"])){
        $save     = $_POST;
        $libelle  = $_REQUEST["libelle"];
        $prix     = $_REQUEST["prix"];
        $quantite = $_REQUEST["quantite"];

        if(empty($libelle))  $errors["libelleVide"]  = "Veuillez remplir le libellé";
        if(empty($prix))     $errors["prixVide"]     = "Veuillez remplir le prix";
        if(empty($quantite)) $errors["quantiteVide"] = "Veuillez remplir la quantité";

        if(empty($errors)){
            addProduit($libelle,$prix,$quantite);
            header("Location: " . WEBROOT . "?controller=produits&page=listeProduit");
            exit();
        }
    }

    require_once(ROOT . "views/produits/ajoutProduit.php");
};


$supprimerProduit = function (){
    $id = $_GET['id'] ?? null;
    deleteProduit($id);
    header("Location: " . WEBROOT . "?controller=produits&page=listeProduit");
    exit;
};



$listeProduit = function (){
    $produits = getAllProduits();
    require_once(ROOT . "views/produits/listeProduit.php");
};

$modifierProduit= function (){
    $errors = [];
    $save   = [];
    $id     = $_REQUEST["id"];

    if(isset($_REQUEST["envoie"])){
        $save     = $_POST;
        $libelle  = $_REQUEST["libelle"];
        $prix     = $_REQUEST["prix"];
        $quantite = $_REQUEST["quantite"];

        if(empty($libelle))  $errors["libelleVide"]  = "Veuillez remplir le libellé";
        if(empty($prix))     $errors["prixVide"]     = "Veuillez remplir le prix";
        if(empty($quantite)) $errors["quantiteVide"] = "Veuillez remplir la quantité";

        if(empty($errors)){
            updateProduit($id, $libelle, $prix, $quantite);
            header("Location: " . WEBROOT . "?controller=produits&page=listeProduit");
            exit();
        }
    }

    $produit = getProduitById($id);
    require_once(ROOT . "views/produits/ajoutProduit.php");
};

$pages = [
    "listeProduit" => $listeProduit ,
    "ajoutProduit" => $ajoutProduit, 
    "modifierProduit" => $modifierProduit,
    "supprimerProduit" => $supprimerProduit
    ];

    $page = $_REQUEST["page"] ?? "listeProduit";
    if(array_key_exists($page,$pages)){
        $pages[$page]();
    }else {
        echo "page introuvable";
        exit();
    }