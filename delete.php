<?php

$pdo = require_once './maison_france_remi.php';

$_GET = filter_input_array(INPUT_GET,FILTER_SANITIZE_FULL_SPECIAL_CHARS);
$id = $_GET['id'] ?? '';

if($id) {
$statement_chantiers = $pdo->prepare('DELETE FROM chantiers where id=:id ');
    $statement_chantiers->bindValue(':id', $id);
    $statement_chantiers->execute();
    header('location: /admin_chantiers.php');
}
if($id) {
$statement_Avis = $pdo->prepare('DELETE FROM avis where id=:id ');
    $statement_Avis->bindValue(':id', $id);
    $statement_Avis->execute();
    header('location: /admin_avis.php');
}
if($id) {
$statement_contact = $pdo->prepare('DELETE FROM contact where id=:id ');
    $statement_contact->bindValue(':id', $id);
    $statement_contact->execute();
    header('location: /admin_contact.php');
}
if($id) {
$statement_devis = $pdo->prepare('DELETE FROM devis where id=:id ');
    $statement_devis->bindValue(':id', $id);
    $statement_devis->execute();
    header('location: /admin_devis.php');
}

 

?>