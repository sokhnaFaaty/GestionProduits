<?php
require_once(ROOT."db/config.php");

// function getAllCommande(){
//     $sql = "SELECT * FROM commande";
//    return executeSelect($sql);
// }

function getAllCommande(){
    $sql = "SELECT c.*, cl.nom as nom_client, cl.prenom as prenom_client
            FROM commande c
            JOIN client cl ON c.id_client = cl.id";
    return executeSelect($sql);
}

function getCommandeById(int $id): array|false {
    return executeSelect(
        "SELECT c.*, cl.nom, cl.prenom
         FROM commande c
         JOIN client cl ON cl.id = c.id_client
         WHERE c.id_commande = :id
         LIMIT 1",
        ['id' => $id],
        true
    );
}


function verifClient($data) {
    $sql = "SELECT * FROM client
              WHERE  telephone = :telephone
            LIMIT 1";
    $res = executeSelect($sql,$data,true);
    return $res;
}
function saveCommande(int $id_client, array $panier, float $montantTotal): void {
    $stmt = getDb()->prepare(
        "INSERT INTO commande (id_client, date_commande, statut, montant_total)
         VALUES (:id_client, NOW(), 'en attente', :montant_total)
         RETURNING id_commande"
    );
    $stmt->execute(['id_client' => $id_client, 'montant_total' => $montantTotal]);
    $id_commande = (int) $stmt->fetchColumn();

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