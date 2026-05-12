<?php
require_once(ROOT."db/config.php");

function saveClient(array $data){
    $db = getDb();
    $stmt = $db->prepare("INSERT INTO client (nom, prenom,telephone,email) VALUES (?, ?, ?, ?)");
    $stmt->execute([$data["nom"],$data["prenom"],$data["telephone"],$data["email"]]);
}

function getAllClients() {
    $db = getDb();
    $stmt = $db->prepare("SELECT * FROM client");
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function getClientById(int $id) {
   $db = getDb();
    $stmt = $db->prepare("SELECT * FROM client WHERE id = ?");
    $stmt->execute([$id]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}



function updateClient(int $id, array $data) {
    $db = getDb();
    $stmt = $db->prepare("UPDATE client SET nom = ?, prenom = ?, telephone = ?, email = ? WHERE id = ?");
    $stmt->execute([$data['nom'], $data['prenom'], $data['telephone'], $data['email'], $id]);
    return $stmt->rowCount();
}

function deleteClient(int $id) {
    $db = getDb();
    $stmt = $db->prepare("DELETE FROM client WHERE id = ?");
    $stmt->execute([$id]);
    return $stmt->rowCount();
}
