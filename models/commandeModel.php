<?php
require_once(ROOT."db/config.php");

// function getAllCommande(){
//     $sql = "SELECT * FROM commande";
//    return executeSelect($sql);
// }

function getAllCommande(){
    $sql = "SELECT c.*, cl.nom as nomClient, cl.prenom as prenomClient
            FROM commande c 
            JOIN client cl ON c.id_client = cl.id";
    return executeSelect($sql);
}

function verifClient($data) {
    $sql = "SELECT * FROM client
            WHERE email  = :email
              AND nom  = :nom
              AND prenom = :prenom
              AND telephone = :telephone
            LIMIT 1";
    $res = executeSelect($sql,$data,false);
    return $res;
}
