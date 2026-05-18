<?php
require_once(ROOT . "db/config.php");

function getAllCommandes() {
    $stmt = getDb()->query(
        "SELECT c.id_commande, c.code, c.date, c.montantTotal,
                cl.nom, cl.prenom
         FROM commande c
         JOIN client cl ON cl.id = c.id_client
         ORDER BY c.date DESC"
    );
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function getCommandeById($id_commande) {
    $stmt = getDb()->prepare(
        "SELECT c.id_commande, c.code, c.date, c.montantTotal,
                cl.nom, cl.prenom, cl.telephone
         FROM commande c
         JOIN client cl ON cl.id = c.id_client
         WHERE c.id_commande = :id"
    );
    $stmt->execute([":id" => $id_commande]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

function addCommande($code, $date, $montantTotal, $id_client) {
    $stmt = getDb()->prepare(
        "INSERT INTO commande (code, date, montantTotal, id_client)
         VALUES (:code, :date, :montantTotal, :id_client)"
    );
    $stmt->execute([
        ":code"         => $code,
        ":date"         => $date,
        ":montantTotal" => $montantTotal,
        ":id_client"    => $id_client
    ]);
    return getDb()->lastInsertId(); //id de la commande cree
}