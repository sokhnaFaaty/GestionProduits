<?php
require_once (ROOT ."db/config.php");

function addProduit($libelle,$prix,$quantite){
    $db=getDb();
    $stmt=$db->prepare(
        "INSERT INTO produit(libelle, prix, quantite_stock)
        VALUES(:libelle, :prix, :quantite)"
    );
    $stmt->execute([
        ":libelle"=>$libelle,
        ":prix"=>$prix,
        ":quantite"=>$quantite
    ]);
}

function deleteProduit($id){
    $db   = getDB();
    $stmt = $db->prepare("DELETE FROM produit WHERE id = :id");
    $stmt->execute(["id" => $id]);
}
function getProduitById($id){
    $db   = getDb();
    $stmt = $db->prepare("SELECT * FROM produit WHERE id = :id");
    $stmt->execute(["id" => $id]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

function getAllProduits(){
    $db   = getDb();
    $stmt = $db->query("SELECT * FROM produit ORDER BY id ASC");
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

function updateProduit($id, $libelle, $prix, $quantite){
    $db   = getDb();
    $stmt = $db->prepare(
        "UPDATE produit 
         SET libelle = :libelle, prix = :prix, quantite_stock = :quantite
         WHERE id = :id"
    );
    $stmt->execute([
        "id"       => $id,
        "libelle"  => $libelle,
        "prix"     => $prix,
        "quantite" => $quantite
    ]);

}
