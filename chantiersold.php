<?php


$pdo = require_once './maison_france_remi.php';

$stateIndex = $pdo->prepare('SELECT title,image,content FROM chantiers where id=id');
$stateIndex->execute();
$index = $stateIndex->fetchAll();

$id = $_COOKIE['session'] ?? '';
$stateUser = $pdo->prepare('SELECT id FROM session WHERE id_session=:id');
$stateUser->bindValue(':id', $id);
$stateUser->execute();
$userid = $stateUser->fetch();


// if(isset($_GET['id'])) {
//     $id = htmlentities($_GET['id']);
//     echo $id; 
//     vaut 1
// }
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <?php require_once 'includes/head.php' ?>
    <link rel="stylesheet" href="/public/CSS/chantiers.css">
    <title>Chantiers</title>
</head>

<?php require_once 'includes/header.php' ?>



<body>
    <div class="container">
        <h1>NOS CHANTIERS</h1>
        <div class="content"><?php foreach ($index as $i) : ?>

                <div class="main-category-container">
                    <div class="category-content">
                        <br>
                        <h2><?= $i['title'] ?></h2>
                        <br>
                        <div class="category-content_a">
                            <a href="/chantiers_details.php?id=$i['id']" class="article block">
                                <img src="<?= $i['image'] ?>" alt="" class="img-container">
                            </a>
                            <div class="chantiers_details">
                                <!-- <a href="./chantiers_details.php">PLUS DE DETAILS</a> -->
                                <a href="/chantiers_details.php?id=<?= $i['id'] ?>">PLUS DE DETAILS</a>
                            </div>
                        </div>
                        <br>
                        <h2><?= $i['content'] ?></h2>
                    </div>

                </div> <?php endforeach; ?>
        </div>
    </div>
</body>
<?php require_once 'includes/footer.php' ?>

</html>