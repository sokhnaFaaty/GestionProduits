<?php

function getDB(){
$host = '127.0.0.1';
$dbname = 'gestionproduits';
$user = 'root';
$password = '';

try {
    $db = new PDO(
        "mysql:host=$host;dbname=$dbname;charset=utf8",
         $user, 
         $password);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    return $db;//je return la connexion
    //echo"Connexion reussie";
} catch (PDOException $e) {
    die("Erreur de connexion : " . $e->getMessage());
}
}
?>
