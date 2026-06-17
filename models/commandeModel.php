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

function getCommandeById(int $id): array|false {
    return executeSelect(
        "SELECT c.*, cl.nom, cl.prenom FROM commande c
         JOIN client cl ON cl.id = c.id_client
         WHERE c.id_commande = :id LIMIT 1",
        ['id' => $id],
        true
    );
}

function verifClient(array $data): array|false {
    return executeSelect(
        "SELECT * FROM client WHERE telephone = :telephone LIMIT 1",
        $data,
        true
    );
}

function addCommande(string $code, string $date, float $montantTotal, int $id_client): int {
    executeUpdate(
        "INSERT INTO commande (code, date, montantTotal, id_client)
         VALUES (:code, :date, :montantTotal, :id_client)",
        ['code' => $code, 'date' => $date, 'montantTotal' => $montantTotal, 'id_client' => $id_client]
    );
    return (int) getDb()->lastInsertId();
}

function addLigneCommande(int $id_commande, int $id_produit, int $quantite, float $prix): void {
    executeUpdate(
        "INSERT INTO ligne_commande (id_commande, id_produit, quantite, prix_unitaire)
         VALUES (:id_commande, :id_produit, :quantite, :prix)",
        ['id_commande' => $id_commande, 'id_produit' => $id_produit, 'quantite' => $quantite, 'prix' => $prix]
    );
    // Décrémentation du stock
    executeUpdate(
        "UPDATE produit SET quantite_stock = quantite_stock - :quantite WHERE id_produit = :id_produit",
        ['quantite' => $quantite, 'id_produit' => $id_produit]
    );
}
function saveCommande(int $id_client, array $panier, float $montantTotal) {
    // Créer la commande
    executeUpdate(
        "INSERT INTO commande (id_client, date_commande, statut, montant_total)
         VALUES (:id_client, NOW(), 'en attente', :montant_total)",
        ['id_client' => $id_client, 'montant_total' => $montantTotal] );

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