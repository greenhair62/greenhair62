<?php


// echo $cat;

$pdo = require_once './maison_france_remi.php';

$cat = $_GET['cat'];
$_GET = filter_input_array(INPUT_GET, FILTER_SANITIZE_FULL_SPECIAL_CHARS);

if (!$cat) {
    header('location: /');
} else {
    $statement = $pdo->prepare('SELECT * FROM devis WHERE category=:category');
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
                        <div class="category-content_a_row">

                            <h2>NOM</h2><?= $a['name'] ?>
                            <h2>PRENOM</h2><?= $a['second_name'] ?>
                            <h2>EMAIL</h2><?= $a['email'] ?>
                            <h2>TEL</h2><?= $a['number_phone'] ?>
                            <h2>ADRESSE</h2><?= $a['adress'] ?>
                            <h2>CODE POSTAL</h2><?= $a['cp'] ?>
                            <h2>VILLE</h2><?= $a['city'] ?>
                            <h2>INFORMATIONS COMPLEMENTAIRE</h2><?= $a['content'] ?>
                            <h2>MEME ADRESSE TRAVAUX</h2><?= $a['category_lieu_travaux'] ?>
                            <h2>Décrivez votre projet en quelques mots</h2><?= $a['content2'] ?>
                            <h2>PROPRIETAIRE</h2><?= $a['category'] ?>
                            <h2>TYPE HABITATION</h2><?= $a['category_habitation'] ?>
                            <h2>TYPE DE RESIDENCE</h2><?= $a['category_residence'] ?>

                        </div>
                        <div class="action">
                            <h2><?= $a['date'] ?></h2>
                            <a class="btn btn-secondary" href="/delete.php?id=<?= $a['id'] ?>">Supprimer</a>
                            <a class="btn btn-secondary" href="/delete.php?id=<?= $a['id'] ?>">Archiver</a>
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