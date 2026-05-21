<?php
function getDb() : PDO {
    $host = '127.0.0.1';
    $dbname = 'ProduitGestiongroupeFaty';
    $user = 'root';
    $password = '';

    static $db = null;
    if($db == null){
        try {
            $db = new PDO("mysql:host=$host;port=3306;dbname=$dbname;charset=utf8", $user, $password);
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            // echo "connexion réussi";
        
        } catch (PDOException $e) {
            die("Erreur de connexion : " . $e->getMessage());
        }
        }
    return $db;
    
}

function executeSelect(string $sql,array $data = [], $one = false){
    $db = getDb();
    $stmt = $db ->prepare($sql);
    $stmt ->execute(count($data) === 0 ? [] : $data );
    return $one ? $stmt->fetch() : $stmt -> fetchAll(); 
}

function executeUpdate(string $sql,array $data = []){
    $db = getDb();
    $stmt = $db ->prepare($sql);
    $stmt ->execute($data);
}
?>
