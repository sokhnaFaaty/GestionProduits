<?php
require_once(ROOT . "db/config.php");

function addProduit(array $data): void {
    executeUpdate(
        "INSERT INTO produit(reference, libelle, prix, quantite_stock, image) VALUES (:reference, :libelle, :prix, :quantite, :image)",
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

function getProduitByReference(string $reference): array|false {
    return executeSelect(
        "SELECT * FROM produit WHERE reference = :reference",
        ["reference" => $reference],
        true
    );
}

function updateProduit(int $id_produit, array $data): void {
    $data["id_produit"] = $id_produit;
    executeUpdate(
        "UPDATE produit SET reference = :reference, libelle = :libelle, prix = :prix, quantite_stock = :quantite, image = :image WHERE id_produit = :id_produit",
        $data
    );
}