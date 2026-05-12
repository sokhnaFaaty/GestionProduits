<?php
<<<<<<< HEAD

require_once(ROOT . "models/produitModel.php");

// Pages disponibles dans ce controller
$pages = ["ajoutProduit", "enregistrerProduit"];

function ajoutProduit(){
=======
function modifierProduit(){
    $id      = $_GET['id'] ?? null;
    $produit = getProduitById($id);
>>>>>>> 173f4262a8bbb3dc2282442af1d1cf38c9cedc7f
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


$pages = ["ajoutProduit", "enregistrerProduit", "modifierProduit", "mettreAJourProduit", "listeProduit"];

function listeProduit(){
    $produits = getAllProduits();
    require_once(ROOT . "views/listeProduit.php");
}
