<?php

$filename = __DIR__ . '/data/avis.json';
$articles = [];

$_GET = filter_input_array(INPUT_GET, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
$id = $_GET['id'] ?? '';

if (file_exists($filename)) {
    $articles = json_decode(file_get_contents($filename), true) ?? [];
    $articleIndex = array_search($id, array_column($articles, 'id'));
    $article = $articles[$articleIndex];
    // echo "<pre>";
    // print_r($article);
    // echo "</pre>";
}

?>


<!DOCTYPE html>
<html lang="fr">

<head>
    <?php require_once 'includes/head.php' ?>
    <link rel="stylesheet" href="/public/css/detailArticle.css">
    <title>Détail Avis</title>
</head>

<body>
    <div class="container">
        <?php require_once 'includes/header.php' ?>
        <div class="content">
            <div class="article-cover-img" style="background-image: url(<?= $article['image'] ?>);"></div>
            <div class="article-container">
                <a class="article-back" href="/">Page d'accueil</a>
                <h1 class="article-title"><?= $article['title'] ?></h1>
                <div class="article-content"><?= $article['content'] ?></div>
                <div class="action">
                    <a class="btn btn-secondary" href="/supprimer_avis.php?id=<?= $article['id'] ?>">Delete</a>

                    <a class="btn btn-primary" href="/ajouter_avis.php?id=<?= $article['id'] ?>">Edit</a>
                </div>
            </div>
        </div>
        <?php require_once 'includes/footer.php' ?>
    </div>
</body>

</html>