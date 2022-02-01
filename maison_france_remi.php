<?php



try {
    $pdo = new PDO('mysql:host=localhost;dbname=maison_france_remi', 'root', '', [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
    ]);
} catch (PDOException $e) {
    echo "error :" . $e->getMessage();
}

return $pdo;

