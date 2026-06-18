<?php
require_once ROOT . 'models/commandeModel.php';
require_once ROOT . 'models/produitModel.php';
require_once ROOT . 'models/clientModel.php';

if (!isset($_SESSION['panier']))  $_SESSION['panier']  = [];
if (!isset($_SESSION['produit'])) $_SESSION['produit'] = null;
if (!isset($_SESSION['client']))  $_SESSION['client']  = null;

// ── Liste des commandes 
$listeCommande = function () {
    $commandes = getAllCommande();
    loadView('commandes/listeCommande', ['commandes' => $commandes], 'side');
};

// ── Détail d'une commande ────────────────────────────────────────────────────
$detailCommande = function () {
    $id = (int)($_GET['id'] ?? 0);
    if (!$id) { header('Location: ' . path('commandes', 'listeCommande')); exit(); }
    $commande = getCommandeById($id);
    if (!$commande) { header('Location: ' . path('commandes', 'listeCommande')); exit(); }
    $lignes = getLignesCommande($id);
    loadView('commandes/detailCommande', ['commande' => $commande, 'lignes' => $lignes], 'side');
};

// ── Ajout d'une commande ─────────────────────────────────────────────────────
$ajoutCommande = function () {

    $errors            = [];
    $clientIntrouvable = false;
    $action            = $_POST['action'] ?? '';

    // 1. RECHERCHER UN CLIENT
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

    // 2. RECHERCHER UN PRODUIT PAR RÉFÉRENCE
    if ($action === 'rechercherProduit') {
        $ref = trim($_POST['ref_produit'] ?? '');
        if (empty($ref)) {
            $errors['produit'] = "Veuillez saisir une référence.";
        } else {
            $found = getProduitByReference($ref);
            if ($found) {
                $_SESSION['produit'] = $found;
            } else {
                $_SESSION['produit'] = null;
                $errors['produit']   = "Aucun produit avec la référence « $ref ».";
            }
        }
    }

    // 3. AJOUTER UN PRODUIT AU PANIER
    if ($action === 'ajouterProduit') {
        $id_produit = (int)($_POST['id_produit'] ?? 0);
        $quantite   = (int)($_POST['quantite']   ?? 1);

        // Recharge depuis la BDD — prix/libelle/stock ne peuvent pas être falsifiés via les champs hidden
        $produit = getProduitById($id_produit);
        if (!$produit) {
            $errors['ajout'] = "Produit introuvable.";
        } else {
            $prix    = (float)$produit['prix'];
            $libelle = $produit['libelle'];
            $stock   = (int)$produit['quantite_stock'];

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
                $trouve = false;
                foreach ($_SESSION['panier'] as &$ligne) {
                    if ((int)$ligne['id_produit'] === $id_produit) {
                        $ligne['quantite']  += $quantite;
                        $ligne['sous_total'] = $ligne['quantite'] * $ligne['prix'];
                        $trouve = true;
                        break;
                    }
                }
                unset($ligne);

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
    }

    // 4. RETIRER UN PRODUIT DU PANIER
    if ($action === 'retirerProduit') {
        $id_retirer = (int)($_POST['id_retirer'] ?? 0);
        $_SESSION['panier'] = array_values(
            array_filter(
                $_SESSION['panier'],
                fn($l) => (int)$l['id_produit'] !== $id_retirer
            )
        );
    }

    // 5. VALIDER LA COMMANDE
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

            $id_commande = addCommande($code, $date, $montantTotal, (int)$_SESSION['client']['id']);

            foreach ($_SESSION['panier'] as $ligne) {
                addLigneCommande(
                    $id_commande,
                    (int)$ligne['id_produit'],
                    (int)$ligne['quantite'],
                    (float)$ligne['prix']
                );
            }

            $_SESSION['panier']  = [];
            $_SESSION['produit'] = null;
            $_SESSION['client']  = null;

            header("Location: " . path("commandes", "detailCommande", ["id" => $id_commande]));
            exit();
        }
    }

    $client        = $_SESSION['client'];
    $produitTrouve = $_SESSION['produit'];
    $panier        = $_SESSION['panier'];
    $montantTotal  = array_sum(array_column($panier, 'sous_total'));

    loadView('commandes/ajoutCommande', [
        'errors'           => $errors,
        'client'           => $client,
        'produitTrouve'    => $produitTrouve,
        'panier'           => $panier,
        'clientIntrouvable'=> $clientIntrouvable,
        'montantTotal'     => $montantTotal,
    ], 'base');
};

$factureCommande = function () {
    $id = (int)($_GET['id'] ?? 0);
    if (!$id) { header('Location: ' . path('commandes', 'listeCommande')); exit(); }
    $commande = getCommandeById($id);
    if (!$commande) { header('Location: ' . path('commandes', 'listeCommande')); exit(); }
    $lignes = getLignesCommande($id);
    loadView('commandes/facture', ['commande' => $commande, 'lignes' => $lignes], 'facture');
};

// ── Dispatch ───────────
$pages = [
    'listeCommande'  => $listeCommande,
    'ajoutCommande'  => $ajoutCommande,
    'detailCommande' => $detailCommande,
    'factureCommande'=> $factureCommande,
];

$page = $_REQUEST['page'] ?? 'listeCommande';

if (array_key_exists($page, $pages)) {
    $pages[$page]();
} else {
    echo "Page introuvable.";
    exit();
}
