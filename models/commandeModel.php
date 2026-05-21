<?php
require_once(ROOT."db/config.php");

// function getAllCommande(){
//     $sql = "SELECT * FROM commande";
//    return executeSelect($sql);
// }

function getAllCommande(){
    $sql = "SELECT c.*, cl.nom as nomClient, cl.prenom as prenomClient
            FROM commande c 
            JOIN client cl ON c.id_client = cl.id";
    return executeSelect($sql);
}

function getCommandeById($id){
    return executeSelect("SELECT * FROM commande WHERE id_commande = :id", ["id" => $id], true); 
}


function verifClient($data) {
    $sql = "SELECT * FROM client
              WHERE  telephone = :telephone
            LIMIT 1";
    $res = executeSelect($sql,$data,true);
    return $res;
}
function saveCommande(int $id_client, array $panier, float $montantTotal) {
    // Créer la commande
    executeUpdate(
        "INSERT INTO commande (id_client, date_commande, statut, montant_total)
         VALUES (:id_client, NOW(), 'en attente', :montant_total)",
        ['id_client' => $id_client, 'montant_total' => $montantTotal] // ← corrigé '$id' → 'id_client'
    );

    $db = getDb();
    $id_commande = $db->lastInsertId();

    foreach ($panier as $ligne) {
        executeUpdate(
            "INSERT INTO ligne_commande (id_commande, id_produit, quantite, prix_unitaire)
             VALUES (:id_commande, :id_produit, :quantite, :prix)",
            [
                'id_commande' => $id_commande,
                'id_produit'  => $ligne['id_produit'],
                'quantite'    => $ligne['quantite'],
                'prix'        => $ligne['prix'],
            ]
        );

        executeUpdate(
            "UPDATE produit SET quantite_stock = quantite_stock - :quantite
             WHERE id_produit = :id_produit",
            ['quantite' => $ligne['quantite'], 'id_produit' => $ligne['id_produit']]
        );
    }
}