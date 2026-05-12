<?php
require_once(ROOT."db/config.php");

function saveClient(array $data){
    $db = getDb();
    $stmt = $db->prepare("INSERT INTO client (nom, prenom,telephone,email) VALUES (?, ?, ?, ?)");
    $stmt->execute([$data["nom"],$data["prenom"],$data["telephone"],$data["email"]]);
}