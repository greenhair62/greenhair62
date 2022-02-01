<?php

$pdo = require_once './maison_france_remi.php';

$_GET = filter_input_array(INPUT_GET,FILTER_SANITIZE_FULL_SPECIAL_CHARS);
$id = $_GET['id'] ?? '';

if($id) {
$statement = $pdo->prepare('DELETE FROM chantiers where id=:id ');
    $statement->bindValue(':id', $id);
    $statement->execute();
  
}
if($id) {
$statement = $pdo->prepare('DELETE FROM chantiers where id=:id ');
    $statement->bindValue(':id', $id);
    $statement->execute();
  
}

  header('location: /admin_chantiers.php');

?>