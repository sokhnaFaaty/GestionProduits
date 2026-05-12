
<?php
function getAllProduits(){
    $db   = getDB();
    $stmt = $db->query("SELECT * FROM produit ORDER BY id ASC");
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}