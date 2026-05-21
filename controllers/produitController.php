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
            header("Location: " .path("produits","listeProduit"));
            exit();
        }
    }
    loadView("produits/ajoutProduit",[
        "errors" => $errors,
        "save" => $save
    ],"base");
    // require_once(ROOT . "views/produits/ajoutProduit.php");
};


$supprimerProduit = function (){
    $id = $_GET['id'] ?? null;
    deleteProduit($id);
    header("Location: " . path("produits","listeProduit"));
    exit;
};



$listeProduit = function (){
    $produits = getAllProduits();
    loadView("produits/listeProduit",["produits" => $produits],"side");
    // require_once(ROOT . "views/produits/listeProduit.php");
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
            header("Location: " .path("produits","listeProduit"));
            exit();
        }
    }

    $produit = getProduitById($id);
    // require_once(ROOT . "views/produits/ajoutProduit.php");
    loadView("produits/ajoutProduit",[
           "errors" => $errors ,
            "save" =>$save ,
            "id" =>$id ,
            "produit" => $produit,
    ],"base");
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