<?php
require_once(ROOT."db/config.php");

// function saveClient(array $data){
//     $db = getDb();
//     // $stmt = $db->prepare("INSERT INTO client (nom, prenom,telephone,email) VALUES (?, ?, ?, ?)");
//     // $stmt->execute([$data["nom"],$data["prenom"],$data["telephone"],$data["email"]]);

//     executeUpdate("INSERT INTO client (nom, prenom,telephone,email) VALUES (:nom, :prenom, :telephone, :email)",$data);
// }

// function getAllClients() {
//     $db = getDb();
//     $stmt = $db->prepare("SELECT * FROM client");
//     $stmt->execute();
//     return $stmt->fetchAll(PDO::FETCH_ASSOC);
// }

// function getClientById(int $id) {
//    $db = getDb();
//     $stmt = $db->prepare("SELECT * FROM client WHERE id = ?");
//     $stmt->execute([$id]);
//     return $stmt->fetch(PDO::FETCH_ASSOC);
// }



// function updateClient(int $id, array $data) {
//     $db = getDb();
//     $stmt = $db->prepare("UPDATE client SET nom = ?, prenom = ?, telephone = ?, email = ? WHERE id = ?");
//     $stmt->execute([$data['nom'], $data['prenom'], $data['telephone'], $data['email'], $id]);
//     return $stmt->rowCount();
// }

// function deleteClient(int $id) {
//     $db = getDb();
//     $stmt = $db->prepare("DELETE FROM client WHERE id = ?");
//     $stmt->execute([$id]);
//     return $stmt->rowCount();
// }





function saveClient(array $data){
    $db = getDb();
    $stmt = $db->prepare("INSERT INTO client (nom, prenom,telephone,email) VALUES (:nom, :prenom, :telephone, :email)");
    $stmt->execute($data);
}

function getAllClients() {
   return executeSelect("SELECT * FROM client");
}

function getClientById(int $id) {
   return executeSelect("SELECT * FROM client WHERE id = :id",["id" => $id],true);
}

function updateClient(int $id, array $data) {
    // var_dump($data);
    // var_dump($id);
    $data["id"] = $id;
    executeUpdate("UPDATE client SET nom = :nom, prenom = :prenom, telephone = :telephone , email = :email WHERE id = :id",$data);
}

function deleteClient(int $id) {
    executeUpdate("DELETE FROM client WHERE id = :id",["id" => $id],true);
}
