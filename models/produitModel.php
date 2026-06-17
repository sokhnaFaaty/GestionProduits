<?php
require_once(ROOT . "db/config.php");

function addProduit(array $data): void {
    executeUpdate(
        "INSERT INTO produit(libelle, prix, quantite_stock) VALUES (:libelle, :prix, :quantite)",
        $data
    );
}

function deleteProduit(int $id_produit): void {
    executeUpdate(
        "DELETE FROM produit WHERE id_produit = :id_produit",
        ["id_produit" => $id_produit]
    );
}

function getProduitById(int $id_produit): array|false {
    return executeSelect(
        "SELECT * FROM produit WHERE id_produit = :id_produit",
        ["id_produit" => $id_produit],
        true
    );
}

function getProduitByLibelle(string $libelle): array|false {
    return executeSelect(
        "SELECT * FROM produit WHERE libelle = :libelle",
        ["libelle" => $libelle],
        true
    );
}

function getAllProduits(): array {
    return executeSelect("SELECT * FROM produit ORDER BY id_produit ASC");
}

function updateProduit(int $id_produit, array $data): void {
    $data["id_produit"] = $id_produit;
    executeUpdate(
        "UPDATE produit SET libelle = :libelle, prix = :prix, quantite_stock = :quantite WHERE id_produit = :id_produit",
        $data
    );
}