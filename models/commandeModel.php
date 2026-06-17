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

function verifClient($data) {
    $sql = "SELECT * FROM client WHERE telephone = :telephone LIMIT 1";
    return executeSelect($sql, $data, true);
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
