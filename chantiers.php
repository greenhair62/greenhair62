<?php


$pdo = require_once './maison_france_remi.php';


// $id = $_COOKIE['session'] ?? '';
// $stateUser = $pdo->prepare('SELECT id FROM session WHERE id_session=:id');
// $stateUser->bindValue(':id', $id);
// $stateUser->execute();
// $userid = $stateUser->fetch();


$statement = $pdo->prepare('SELECT * FROM chantiers ');
$statement->execute();
$articles = $statement->fetchAll();
$categories = [];

$selectedCat = '';

$_GET = filter_input_array(INPUT_GET, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
$selectedCat = $_GET['cat'] ?? '';

if (count($articles)) {
    $categories = array_map(fn ($i) => $i['category'], $articles);

    $cat = array_reduce($categories, function ($acc, $c) { // doublon 
        if (isset($acc[$c])) {
            $acc[$c]++;
        } else {
            $acc[$c] = 1;
        }
        return $acc;
    }, []);

    // echo "<pre>";
    // print_r($cat);
    // echo "</pre>";

    $artPerCat = array_reduce($articles, function ($acc, $art) {
        if (isset($acc[$art['category']])) {
            $acc[$art['category']] = [...$acc[$art['category']], $art];
        } else {
            $acc[$art['category']] = [$art];
        }
        return $acc;
    }, []);

    // echo "<pre>";
    // print_r($artPerCat);
    // echo "</pre>";
}
// echo count($articles);



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
        <div class="main-category-container">
            <ul class="category-container">
                <div class="content">
                    <li class="fz"><a href="/chantiers.php">TOUS NOS CHANTIERS<span class="small">(<?= count($articles) ?>)</span></a></li>
                    <?php foreach ($cat as $cKey => $cNum) :  ?>
                        <li class="fz"><a href="displayCat.php/?cat=<?= $cKey ?>"><?= $cKey ?><span class="small">(<?= $cNum ?>)</span></a></li>
                    <?php endforeach; ?>
                </div>
            </ul>
            <?php foreach ($cat as $c => $num) : ?>
                <?php foreach ($artPerCat[$c] as $a) : ?>

                    <div class="category-content_a">

                        <h2><?= $a['title'] ?></h2>
                        <div class="chantiers_details">
                            <a href="/chantiers_details.php?id=<?= $a['id'] ?>" class="article block">
                                <img src="<?= $a['image'] ?>" alt="" class="img-container">
                            </a>
                            <p maxlength="3"><?= $a['content'] ?></p>
                        </div>
                        <br>

                    </div>

                <?php endforeach; ?>
            <?php endforeach; ?>


        </div>
    </div>
</body>
<?php require_once 'includes/footer.php' ?>

</html>