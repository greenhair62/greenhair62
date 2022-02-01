<?php


// echo $cat;

$pdo = require_once './maison_france_remi.php';

$cat = $_GET['cat'];
$_GET = filter_input_array(INPUT_GET, FILTER_SANITIZE_FULL_SPECIAL_CHARS);

if (!$cat) {
    header('location: /');
} else {
    $statement = $pdo->prepare('SELECT * FROM avis WHERE category=:category');
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

                <!-- <?php foreach ($articles as $i) : ?>
                    <h3><?= $i['date'] ?></h3>
                    <img src="<?= $i['image'] ?>" alt="" class="img-container">
                    <h2><?= $i['title'] ?></h2>
                    <h3><?= $i['content'] ?></h3>
                <?php endforeach; ?> -->

                <?php foreach ($articles as $a) : ?>

                    <div class="category-content_a">
                        <h3><?= $a['date'] ?></h3>
                        <h2><?= $a['title'] ?></h2>

                        <div class="chantiers_details">
                            <p maxlength="3"><?= $a['content'] ?></p>
                        </div>
                        <div class="action">
                            <a class="btn btn-secondary" href="/delete.php?id=<?= $a['id'] ?>">Supprimer</a>

                            <a class="btn btn-primary" href="/admin_ajouter_chantiers.php?id=<?= $a['id'] ?>">Ajouter</a>
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