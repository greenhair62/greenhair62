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



                <?php foreach ($articles as $i) : ?>
                    <h3><?= $i['date'] ?></h3>
                    <img src="<?= $i['image'] ?>" alt="" class="img-container">


                    <h2><?= $i['title'] ?></h2>
                    <br>
                    <br>
                    <br>
                    <h3><?= $i['content'] ?></h3>

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