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

function deleteProduit($id_produit){
    $db   = getDb();
    $stmt = $db->prepare("DELETE FROM produit WHERE id_produit = :id_produit");
    $stmt->execute(["id_produit" => $id_produit]);
}
function getProduitById($id_produit){
    $db   = getDb();
    $stmt = $db->prepare("SELECT * FROM produit WHERE id_produit= :id_produit");
    $stmt->execute(["id_produit" => $id_produit]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

function getAllProduits(){
    $db   = getDb();
    $stmt = $db->query("SELECT * FROM produit ORDER BY id_produit ASC");
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

function updateProduit($id_produit, $libelle, $prix, $quantite){
    $db   = getDb();
    $stmt = $db->prepare(
        "UPDATE produit 
         SET libelle = :libelle, prix = :prix, quantite_stock = :quantite
         WHERE id_produit = :id_produit"
    );
    $stmt->execute([
        "id_produit"=> $id_produit,
        "libelle"  => $libelle,
        "prix"     => $prix,
        "quantite" => $quantite
    ]);

}
