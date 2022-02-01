<?php


$pdo = require_once './maison_france_remi.php';

$id = $_GET['id'] ?? '';
$_GET = filter_input_array(INPUT_GET, FILTER_SANITIZE_FULL_SPECIAL_CHARS);

if (!$id) {
    header('location: /');
} else {
    $statement = $pdo->prepare('SELECT * FROM chantiers where id=:id ');
    $statement->bindValue(':id', $id);
    $statement->execute();
    $article = $statement->fetch();
    // echo "<pre>";
    // print_r($article);
    // echo "</pre>";
    // die();
}
// $categories = [];

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <?php require_once 'includes/head.php' ?>
    <link rel="stylesheet" href="/public/CSS/chantiers_details.css">
    <title>Chantiers</title>
</head>


<!-- <?php require_once 'includes/header.php' ?> -->

<body>
    <a href="/chantiers.php">REVENIR CHANTIERS</a>
    <div class="container">
        <h1>CHANTIER DE :</h1>

        <div class="content">
            <h2><?= $article['title'] ?></h2>
            <div class="category-content">

                <img src="<?= $article['image'] ?>" alt="" class="img-container">
                <img src="<?= $article['image1'] ?>" alt="" class="img-container">
                <img src="<?= $article['image2'] ?>" alt="" class="img-container">
                <img src="<?= $article['image3'] ?>" alt="" class="img-container">
                <img src="<?= $article['image4'] ?>" alt="" class="img-container">

            </div>
            <div class="content_h2">
                <h2>Description:
                    <br>
                    <br>

                    <?= $article['content'] ?>
                </h2>
            </div>
        </div>

    </div>
</body>


</html>