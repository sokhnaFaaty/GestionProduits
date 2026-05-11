<?php
$host = '127.0.0.1';
$dbname = 'ProduitGestiongroupeFaty';
$user = 'root';
$password = '';

try {
    $db = new PDO("mysql:host=$host;port=3306;dbname=$dbname;charset=utf8", $user, $password);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "connexion réussi";
} catch (PDOException $e) {
    die("Erreur de connexion : " . $e->getMessage());
}
?>
