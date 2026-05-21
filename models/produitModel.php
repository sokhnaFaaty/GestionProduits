<?php
require_once (ROOT ."db/config.php");

// function addProduit($libelle,$prix,$quantite){
//     $db=getDb();
//     $stmt=$db->prepare(
//         "INSERT INTO produit(libelle, prix, quantite_stock)
//         VALUES(:libelle, :prix, :quantite)"
//     );
//     $stmt->execute([
//         ":libelle"=>$libelle,
//         ":prix"=>$prix,
//         ":quantite"=>$quantite
//     ]);
// }

// function deleteProduit($id){
//     $db   = getDb();
//     $stmt = $db->prepare("DELETE FROM produit WHERE id = :id");
//     $stmt->execute(["id" => $id]);
// }
// function getProduitById($id){
//     $db   = getDb();
//     $stmt = $db->prepare("SELECT * FROM produit WHERE id = :id");
//     $stmt->execute(["id" => $id]);
//     return $stmt->fetch(PDO::FETCH_ASSOC);
// }

// function getAllProduits(){
//     $db   = getDb();
//     $stmt = $db->query("SELECT * FROM produit ORDER BY id_produit ASC");
//     return $stmt->fetchAll(PDO::FETCH_ASSOC);
//     }

// function updateProduit($id, $libelle, $prix, $quantite){
//     $db   = getDb();
//     $stmt = $db->prepare(
//         "UPDATE produit 
//          SET libelle = :libelle, prix = :prix, quantite_stock = :quantite
//          WHERE id = :id"
//     );
//     $stmt->execute([
//         "id"       => $id,
//         "libelle"  => $libelle,
//         "prix"     => $prix,
//         "quantite" => $quantite
//     ]);

// }

function addProduit(array $data){
    executeUpdate("INSERT INTO produit(libelle, prix, quantite_stock) VALUES (:libelle, :prix, :quantite)", $data);
}

function deleteProduit(int $id_produit) {
    executeUpdate("DELETE FROM produit WHERE id_produit = :id_produit", ["id_produit" => $id_produit], true);
}

function getProduitById(int $id_produit) {
   return executeSelect("SELECT * FROM produit WHERE id_produit = :id_produit", ["id_produit" => $id_produit], true);
}

function getProduitByLibelle($libelle){
    return executeSelect("SELECT * FROM produit WHERE libelle = :libelle", ["libelle" => $libelle], true);
} 

function getAllProduits(){
    return executeSelect("SELECT * FROM produit");
} 

function updateProduit(int $id_produit, array $data) {
    $data["id_produit"] = $id_produit;
    executeUpdate("UPDATE produit SET libelle = :libelle, prix = :prix, quantite_stock = :quantite WHERE id_produit = :id_produit", $data);
}
