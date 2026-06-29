<?php
require_once ROOT . 'models/commandeModel.php';
require_once ROOT . 'models/clientModel.php';
// Protection : seul un client connecté accède ici
if (!hasRole('client')) {
    redirectTo('auth', 'login');
}

$mesCommandes = function () {
    $id_client = $_SESSION['user']['id'];
    $commandes = getCommandesByClient($id_client);
    loadView('client/mesCommandes', ['commandes' => $commandes], 'client');
};

$monProfil = function () {
    $id_client = $_SESSION['user']['id'];
    $client    = getClientById($id_client);
    loadView('client/monProfil', ['client' => $client], 'client');
};

$pages = [
    'mesCommandes' => $mesCommandes,
    'monProfil'    => $monProfil,
];

$page = $_REQUEST['page'] ?? 'mesCommandes';
if (array_key_exists($page, $pages)) {
    $pages[$page]();
} else {
    redirectTo('client', 'mesCommandes');
}

$detailCommande = function () {
    $id = (int)($_GET['id'] ?? 0);
    if (!$id) { redirectTo('client', 'mesCommandes'); }
    $commande = getCommandeById($id);
    // Vérifier que la commande appartient bien au client connecté
    if (!$commande || (int)$commande['id_client'] !== (int)$_SESSION['user']['id']) {
        redirectTo('client', 'mesCommandes');
    }
    $lignes = getLignesCommande($id);
    loadView('client/detailCommande', ['commande' => $commande, 'lignes' => $lignes], 'client');
};

// Et dans $pages :
$pages = [
    'mesCommandes'   => $mesCommandes,
    'monProfil'      => $monProfil,
    'detailCommande' => $detailCommande,
];