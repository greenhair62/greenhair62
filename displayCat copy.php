<?php

$cat = $_GET['cat'];
echo $cat;

$pdo = require_once './maison_france_remi.php';


$statement = $pdo->prepare('SELECT * FROM chantiers WHERE category=:category');
$statement->bindValue(':category', $cat);
$statement->execute();
$articles = $statement->fetchAll();

    echo "<pre>";
    print_r($articles);
    echo "</pre>";
    die();
    
    ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php require_once 'includes/head.php' ?>
    <link rel="stylesheet" href="/public/CSS/displayCat.css">
    <title>Chantiers</title>
</head>

<?php require_once 'includes/header.php' ?>

<body>
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

            <?= $article['content'] ?></h2>
        </div>
    </div>

    </div>
</body>
<?php require_once 'includes/footer.php' ?>

</html>