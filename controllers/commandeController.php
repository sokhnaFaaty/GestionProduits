<?php
// commandeController.php
require_once(ROOT . "models/commandeModel.php");
require_once(ROOT . "models/clientModel.php");
require_once(ROOT . "models/produitModel.php");

$listeCommande = function () {
    $commandes = getAllCommande();
    loadView("commandes/listeCommande",[
        "commandes" => $commandes
    ]);
    // require_once(ROOT . "views/commandes/listeCommande.php");
};

$detailCommande = function () {
    $id = $_GET['id'] ?? null;
    if (!$id) { echo "Commande introuvable"; return; }
    $commande = getCommandeById($id);
    require_once(ROOT . "views/commandes/detailCommande.php");
};

$ajoutCommande = function () {
    if (session_status() === PHP_SESSION_NONE) session_start();

    $errors         = [];
    $client         = $_SESSION['client']  ?? null;
    $produitTrouve  = $_SESSION['produit'] ?? null;
    $panier         = $_SESSION['panier']  ?? [];
    $clientIntrouvable = false;
    $montantTotal   = array_sum(array_column($panier, 'sous_total'));

    $action = $_POST['action'] ?? null;

    // Rechercher un client ───────
    if ($action === 'rechercherClient') {
        $telephone = trim($_POST['telephone'] ?? '');

        if ($telephone === '') {
            $errors['telephone'] = 'Veuillez saisir un numéro de téléphone.';
        } else {
            $result = verifClient(['telephone' => $telephone]);
            if ($result) {
                $_SESSION['client'] = $result; 
                $client = $_SESSION['client'];
            } else {
                $clientIntrouvable = true;
                $_SESSION['client'] = null;
                $client = null;
            }
        }
    }

    // rercher un produit
    elseif ($action === 'rechercherProduit') {
        $libelle = trim($_POST['libelle_produit'] ?? '');

        if ($libelle === '') {
            $errors['libelle_produit'] = 'Veuillez saisir un libellé.';
        } else {
            $produit = getProduitByLibelle($libelle);
            if ($produit) {
                $_SESSION['produit'] = $produit;
                $produitTrouve = $produit;
            } else {
                $errors['produit'] = 'Aucun produit trouvé avec ce libellé.';
                $_SESSION['produit'] = null;
                $produitTrouve = null;
            }
        }
    }

    //jouter un produit au panier 
    elseif ($action === 'ajouterProduit') {
        $id_produit = (int)($_POST['id_produit'] ?? 0);
        $quantite   = (int)($_POST['quantite']   ?? 1);
        $prix       = (float)($_POST['prix']     ?? 0);
        $libelle    = $_POST['libelle']           ?? '';
        $stock      = (int)($_POST['stock']       ?? 0);

        // Calcul du déjà ajouté
        $dejaAjoute = 0;
        foreach ($panier as $l) {
            if ((int)$l['id_produit'] === $id_produit) {
                $dejaAjoute = $l['quantite'];
                break;
            }
        }
        $stockRestant = $stock - $dejaAjoute;

        if ($quantite < 1 || $quantite > $stockRestant) {
            $errors['ajout'] = 'Quantité invalide ou stock insuffisant.';
        } else {
            // Mise à jour ou ajout dans le panier
            $found = false;
            foreach ($panier as &$ligne) {
                if ((int)$ligne['id_produit'] === $id_produit) {
                    $ligne['quantite']   += $quantite;
                    $ligne['sous_total']  = $ligne['quantite'] * $ligne['prix'];
                    $found = true;
                    break;
                }
            }
            unset($ligne);

            if (!$found) {
                $panier[] = [
                    'id_produit' => $id_produit,
                    'libelle'    => $libelle,
                    'prix'       => $prix,
                    'quantite'   => $quantite,
                    'sous_total' => $prix * $quantite,
                ];
            }
            $_SESSION['panier'] = $panier;
        }

        $produitTrouve = $_SESSION['produit'] ?? null; // on garde le produit affiché
    }

    //Retirer un produit du panier 
    elseif ($action === 'retirerProduit') {
        $id_retirer = (int)($_POST['id_retirer'] ?? 0);
        $panier = array_values(array_filter($panier, fn($l) => (int)$l['id_produit'] !== $id_retirer));
        $_SESSION['panier'] = $panier;
    }

    //  Valider la commande
    elseif ($action === 'validerCommande') {
        if (!$client) {
            $errors['client'] = 'Veuillez sélectionner un client.';
        }
        if (empty($panier)) {
            $errors['panier'] = 'Le panier est vide.';
        }

        if (empty($errors)) {
            // Enregistrement en base
            saveCommande($client['id'], $panier, $montantTotal);

            // Nettoyage session
            unset($_SESSION['client'], $_SESSION['panier'], $_SESSION['produit']);

            // Redirection vers la liste
            header("Location: " . WEBROOT . "?controller=commandes&page=listeCommande");
            exit;
        }
    }

    // Recalcul du total après modification du panier
    $montantTotal = array_sum(array_column($panier, 'sous_total'));
    loadView("commandes/ajoutCommande",[
        "errors" =>$errors,        
        "client" =>$client,       
        "produitTrouve" =>$produitTrouve , 
        "panier" =>$panier,
        "clientIntrouvable" => $clientIntrouvable,   
        "montantTotal" =>$montantTotal  
        
    ],"base");
    // require_once(ROOT . "views/commandes/ajoutCommande.php");
};

$pages = [
    "listeCommande" => $listeCommande ,
    "ajoutCommande" => $ajoutCommande, 
    ];

    $page = $_REQUEST["page"] ?? "listeCommande";
    if(array_key_exists($page,$pages)){
        $pages[$page]();
    }else {
        echo "page introuvable";
        exit();
    }