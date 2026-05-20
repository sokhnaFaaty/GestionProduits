<?php
require_once(ROOT . "models/produitModel.php");

$pages = ["ajoutProduit", "listeProduit", "modifierProduit", "supprimerProduit"];


function ajoutProduit(){
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
}


function supprimerProduit(){
    $id = $_GET['id'] ?? null;
    deleteProduit($id);
    header("Location: " . WEBROOT . "?controller=produits&page=listeProduit");
    exit;
}



function listeProduit(){
    $produits = getAllProduits();
    require_once(ROOT . "views/produits/listeProduit.php");
}

function modifierProduit(){
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
}
