function getProduitById($id){
    $db   = getDB();
    $stmt = $db->prepare("SELECT * FROM produit WHERE id = :id");
    $stmt->execute(["id" => $id]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

function updateProduit($id, $libelle, $prix, $quantite){
    $db   = getDB();
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