<?php

session_start();

require_once(ROOT . "models/commandeModel.php");
require_once(ROOT . "models/produitModel.php");

if (!isset($_SESSION['panier'])) {
    $_SESSION['panier'] = [];
}

if (!isset($_SESSION['produit'])) {
    $_SESSION['produit'] = null;
}

if (!isset($_SESSION['client'])) {
    $_SESSION['client'] = null;
}

$pages=["ajoutCommande","listeCommande","detailCommande"];
$ajoutCommande = function () {
 
    $errors            = [];
    $clientIntrouvable = false;
    $action            = $_POST['action'] ?? '';
 
    // ── 1. RECHERCHER UN CLIENT
    if ($action === 'rechercherClient') {
        $tel = trim($_POST['telephone'] ?? '');
        if (empty($tel)) {
            $errors['telephone'] = "Veuillez saisir un numéro de téléphone.";
        } else {
            $found = getClientByTelephone($tel);
            if ($found) {
                $_SESSION['client'] = $found;
            } else {
                $_SESSION['client'] = null;
                $clientIntrouvable  = true;
            }
        }
    }
 
    // ── 2. RECHERCHER UN PRODUIT────────
    if ($action === 'rechercherProduit') {
        $libelle = trim($_POST['libelle_produit'] ?? '');
        if (empty($libelle)) {
            $errors['libelle_produit'] = "Veuillez saisir un libellé.";
        } else {
            $found = getProduitByLibelle($libelle);
            if ($found) {
                $_SESSION['produit'] = $found;
            } else {
                $_SESSION['produit'] = null;
                $errors['produit']   = "Produit introuvable.";
            }
        }
    }
 
    //AJOUTER UN PRODUIT AU PANIER
    if ($action === 'ajouterProduit') {
        $id_produit = (int)($_POST['id_produit'] ?? 0);
        $quantite   = (int)($_POST['quantite']   ?? 1);
        $prix       = (float)($_POST['prix']     ?? 0);
        $libelle    = trim($_POST['libelle']      ?? '');
        $stock      = (int)($_POST['stock']       ?? 0);
 
        // Calculer combien est déjà dans le panier
        $dejaAjoute = 0;
        foreach ($_SESSION['panier'] as $l) {
            if ((int)$l['id_produit'] === $id_produit) {
                $dejaAjoute = $l['quantite'];
                break;
            }
        }
 
        if ($quantite < 1 || ($dejaAjoute + $quantite) > $stock) {
            $errors['ajout'] = "Quantité invalide ou stock insuffisant.";
        } else {
            // Si le produit est déjà dans le panier → augmenter la quantité
            $trouve = false;
            foreach ($_SESSION['panier'] as &$ligne) {
                if ((int)$ligne['id_produit'] === $id_produit) {
                    $ligne['quantite']  += $quantite;
                    $ligne['sous_total'] = $ligne['quantite'] * $ligne['prix'];
                    $trouve = true;
                    break;
                }
            }
            unset($ligne); // important après foreach par référence
 
            // Sinon → nouvelle ligne
            if (!$trouve) {
                $_SESSION['panier'][] = [
                    'id_produit' => $id_produit,
                    'libelle'    => $libelle,
                    'prix'       => $prix,
                    'quantite'   => $quantite,
                    'sous_total' => $prix * $quantite,
                ];
            }
        }
    }
 
   
    // if ($action === 'retirerProduit') {
    //     $id_retirer = (int)($_POST['id_retirer'] ?? 0);
    //     $_SESSION['panier'] = array_values(
    //         array_filter(
    //             $_SESSION['panier'],
    //             fn($l) => (int)$l['id_produit'] !== $id_retirer
    //         )
    //     );
    // }
 
    // VALIDER LA COMMANDE 
    if ($action === 'validerCommande') {
        if (!$_SESSION['client']) {
            $errors['client'] = "Aucun client sélectionné.";
        }
        if (empty($_SESSION['panier'])) {
            $errors['panier'] = "Le panier est vide.";
        }
 
        if (empty($errors)) {
            $montantTotal = array_sum(array_column($_SESSION['panier'], 'sous_total'));
            $code         = 'CMD-' . strtoupper(substr(uniqid(), -6));
            $date         = date('Y-m-d');
 
            $id_commande = addCommande(
                $code,
                $date,
                $montantTotal,
                $_SESSION['client']['id']
            );
 
            foreach ($_SESSION['panier'] as $ligne) {
                addLigneCommande(
                    $id_commande,
                    (int)$ligne['id_produit'],
                    (int)$ligne['quantite'],
                    (float)$ligne['prix']
                );
            }
 
            // Vider la session 
            $_SESSION['panier']  = [];
            $_SESSION['produit'] = null;
            $_SESSION['client']  = null;
 
            header("Location: " . WEBROOT . "?controller=commandes&page=detailCommande&id=" . $id_commande);
            exit();
        }
    }
 
    // ── Variables pour la vue 
    $client        = $_SESSION['client'];
    $produitTrouve = $_SESSION['produit'];
    $panier        = $_SESSION['panier'];
    $montantTotal  = array_sum(array_column($panier, 'sous_total'));
 
    require_once(ROOT . "views/commandes/ajoutCommande.php");
};