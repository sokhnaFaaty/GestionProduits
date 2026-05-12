<?php
require_once (ROOT ."db/config.php");


function addProduit($libelle,$prix,$quantite){
    $db=getDB();
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