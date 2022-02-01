<?php


// echo $cat;

$pdo = require_once './maison_france_remi.php';

$cat = $_GET['cat'];
$_GET = filter_input_array(INPUT_GET, FILTER_SANITIZE_FULL_SPECIAL_CHARS);

if (!$cat) {
    header('location: /');
} else {
    $statement = $pdo->prepare('SELECT * FROM chantiers WHERE category=:category');
    $statement->bindValue(':category', $cat);
    $statement->execute();
    $articles = $statement->fetchall();

    // echo "<pre>";
    // print_r($articles);
    // echo "</pre>";
    // die();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php require_once 'includes/head.php' ?>
    <link rel="stylesheet" href="/public/CSS/displayCat.css">
    <title>Chantiers</title>
</head>


<!-- <?php require_once 'includes/header.php' ?> -->

<body>
    <div class="container">
        <h1>CHANTIER DE :</h1>


        <div class="content">
            <div class="category-content">

                <?php foreach ($articles as $a) : ?>

                    <div class="category-content_a">
                        <h3><?= $a['date'] ?></h3>
                        <h2><?= $a['title'] ?></h2>

                        <img src="<?= $a['image'] ?>" alt="" class="img-container">
                        <img src="<?= $a['image1'] ?>" alt="" class="img-container">
                        <img src="<?= $a['image2'] ?>" alt="" class="img-container">
                        <img src="<?= $a['image3'] ?>" alt="" class="img-container">
                        <img src="<?= $a['image4'] ?>" alt="" class="img-container">

                        <div class="chantiers_details">
                            <p maxlength="3"><?= $a['content'] ?></p>
                        </div>
                        <div class="action">
                            <a class="btn btn-secondary" href="/delete.php?id=<?= $a['id'] ?>">Supprimer</a>

                            <a class="btn btn-primary" href="/admin_ajouter_chantiers.php?id=<?= $a['id'] ?>">Modifier</a>
                            <a class="btn btn-primary" href="/admin_ajouter_chantiers.php?id=<?= $a['id'] ?>">Archiver</a>
                        </div>
                    </div>

                <?php endforeach; ?>

            </div>
            <div class="content_h2">
                <!-- <h2>Description: -->

            </div>
        </div>

    </div>
</body>
<!-- <?php require_once 'includes/footer.php' ?> -->

</html>