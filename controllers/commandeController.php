
<?php
require_once(ROOT . "models/commandeModel.php");
require_once(ROOT . "models/ligneCommandeModel.php");
require_once(ROOT . "models/clientModel.php");
require_once(ROOT . "models/produitModel.php");

$pages = ["listeCommande", "detailCommande", "ajoutCommande", "traiterAjoutCommande"];

function listeCommande() {
    $commandes = getAllCommandes();
    require_once(ROOT . "views/commandes/listeCommande.php");
}

function ajoutCommande() {
    $errors   = [];
    $clients  = getAllClients();
    $produits = getAllProduits();

    if (isset($_REQUEST['envoie'])) {
        $code      = $_POST['code'];
        $date      = $_POST['date'];
        $id_client = $_POST['id_client'];
        $id_produits = $_POST['id_produit'] ?? [];
        $quantites   = $_POST['quantite']   ?? [];
        $prix        = $_POST['prix']        ?? [];

        if (empty($code))      $errors['code']      = "Le code est obligatoire";
        if (empty($date))      $errors['date']      = "La date est obligatoire";
        if (empty($id_client)) $errors['id_client'] = "Choisissez un client";
        if (empty($id_produits)) $errors['produits'] = "Ajoutez au moins un produit";

      
    }

    require_once(ROOT . "views/commandes/ajoutCommande.php");
}

0000000