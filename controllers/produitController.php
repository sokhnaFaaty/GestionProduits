<?php

require_once(ROOT . "models/produitModel.php");

$pages = ["ajoutProduit", "enregistrerProduit", "modifierProduit", "mettreAJourProduit", "listeProduit", "supprimerProduit"];

function ajoutProduit(){
    $errors  = [];
    require_once(ROOT . "views/ajoutProduit.php"); // même vue
}

function mettreAJourProduit(){
    $id       = $_POST['id'];
    $libelle  = trim($_POST['libelle']  ?? '');
    $prix     = $_POST['prix']          ?? '';
    $quantite = $_POST['quantite']      ?? '';
    $errors   = [];

    if($libelle  === '') $errors[] = "Le libellé est obligatoire.";
    if($prix     === '') $errors[] = "Le prix est obligatoire.";
    if($quantite === '') $errors[] = "La quantité est obligatoire.";

    if(empty($errors)){
        updateProduit($id, $libelle, (float)$prix, (int)$quantite);
        header("Location: " . WEBROOT . "?controller=produits&page=listeProduit");
        exit;
    }

    $produit = getProduitById($id);
    require_once(ROOT . "views/ajoutProduit.php"); 
}


function supprimerProduit(){
    $id = $_GET['id'] ?? null;
    deleteProduit($id);
    header("Location: " . WEBROOT . "?controller=produits&page=listeProduit");
    exit;
}


function listeProduit(){
    $produits = getAllProduits();
    require_once(ROOT . "views/listeProduit.php");
}
