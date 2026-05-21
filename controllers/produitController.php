<?php
require_once(ROOT . "models/produitModel.php");

$ajoutProduit = function() {
    $errors = [];
    $save   = [];

    if(isset($_REQUEST["envoie"])){
        $save     = $_POST;
         $data = [
            "libelle"  => trim($_REQUEST["libelle"]),
            "prix"     => trim($_REQUEST["prix"]),
            "quantite" => trim($_REQUEST["quantite"])
        ];

    $errors=validDataProduit($data);

        if(empty($errors)){
            addProduit(
                $data["libelle"],        
                $data["prix"],    
                $data["quantite"]
                );   
            header("Location: " . WEBROOT . "?controller=produits&page=listeProduit");
            exit();
        }
    }

    require_once(ROOT . "views/produits/ajoutProduit.php");
};


$supprimerProduit = function (){
    $id_produit = $_GET['id'] ?? null;
    deleteProduit($id_produit);
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
    $id_produit     = $_REQUEST["id"];

    if(isset($_REQUEST["envoie"])){
        $save     = $_POST;
          $data = [
            "libelle"  => trim($_REQUEST["libelle"]),
            "prix"     => trim($_REQUEST["prix"]),
            "quantite" => trim($_REQUEST["quantite"])
        ];

       $errors=validDataProduit($data);

        if(empty($errors)){
            updateProduit(
                $id_produit,
                $data["libelle"],
                $data["prix"],
                $data["quantite"]

            );
            header("Location: " . WEBROOT . "?controller=produits&page=listeProduit");
            exit();
        }
    }

    $produit = getProduitById($id_produit);
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