<?php

// Charge l'environnement : dev en local, prod sur AlwaysData
if (file_exists(ROOT . 'env.dev.php')) {
    require_once ROOT . 'env.dev.php';
} elseif (file_exists(ROOT . 'env.prod.php')) {
    require_once ROOT . 'env.prod.php';
} else {
    die('Fichier de configuration introuvable. Copiez env.example.php en env.dev.php ou env.prod.php.');
}

function getDb(): PDO
{
    static $db = null;
    if ($db === null) {
        try {
            $dsn = sprintf(
                'mysql:host=%s;port=%s;dbname=%s;charset=utf8',
                DB_HOST, DB_PORT, DB_NAME
            );
            $db = new PDO($dsn, DB_USERNAME, DB_PASSWORD);
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            // Ne jamais exposer les détails de connexion
            error_log('DB connection error: ' . $e->getMessage());
            die('Erreur de connexion à la base de données.');
        }
    }
    return $db;
}

function executeSelect(string $sql, array $data = [], bool $one = false)
{
    $stmt = getDb()->prepare($sql);
    $stmt->execute($data);
    return $one ? $stmt->fetch(PDO::FETCH_ASSOC) : $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function executeUpdate(string $sql, array $data = []): void
{
    $stmt = getDb()->prepare($sql);
    $stmt->execute($data);
}

function executeInsert(string $sql, array $data = []): int
{
    executeUpdate($sql, $data);
    return (int) getDb()->lastInsertId();
}
