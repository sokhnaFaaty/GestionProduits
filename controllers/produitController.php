<?php
require_once(ROOT . "models/produitModel.php");

// Pages disponibles dans ce controller
$pages = ["ajoutProduit", "enregistrerProduit"];

function ajoutProduit(){
    $errors  = [];
    $success = false;
    require_once(ROOT . "views/ajoutProduit.php");
}

function enregistrerProduit(){
    $errors  = [];
    $success = false;

    $libelle  = trim($_POST['libelle']  ?? '');
    $prix     = $_POST['prix']          ?? '';
    $quantite = $_POST['quantite']      ?? '';

    if($libelle  === '') $errors[] = "Le libellé est obligatoire.";
    if($prix     === '') $errors[] = "Le prix est obligatoire.";
    if($quantite === '') $errors[] = "La quantité est obligatoire.";

    if(empty($errors)){
        addProduit($libelle, (float)$prix, (int)$quantite);
        $success = true;
        $libelle = $prix = $quantite = '';
    }

    require_once(ROOT . "views/ajoutProduit.php");
}