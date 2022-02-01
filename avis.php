<?php

$pdo = require_once './maison_france_remi.php';

$id = $_COOKIE['session'] ?? '';
$stateUser = $pdo->prepare('SELECT id FROM session WHERE id_session=:id');
$stateUser->bindValue(':id', $id);
$stateUser->execute();
$userid = $stateUser->fetch();


$stateIndex = $pdo->prepare('SELECT date, title, content FROM `avis` WHERE id=id;');
$stateIndex->execute();
$index = $stateIndex->fetchAll();

?>


<!DOCTYPE html>
<html lang="fr">

<head>
    <?php require_once 'includes/head.php' ?>
    <title>Avis</title>
    <link rel="stylesheet" href="/public/css/style_avis.css">
    <?php require_once 'includes/header.php' ?>
</head>

<body>
    <div class="avis_container_donner_avis">
        <ul class="avis_header-menu">
            <h2>VOTRE AVIS COMPTE</h2>
        </ul>
        <div class="avis_content">
            <li class=" = <?= $_SERVER['REQUEST_URI'] === '/ajouter_avis.php' ? 'active' : '' ?>">
                <a href="/connexion.php">Cliquez ici pour laisser un avis</a>
            </li>
            <h3>TOUS NOS AVIS</h3>
        </div>
        <div class="avis_articles-container">

            <?php foreach ($index as $i) : ?>
                <div class="article_block">
                    <h2><?= $i['date'] ?></h2>
                    <br>
                    <h2><?= $i['title'] ?></h2>
                    <br>
                    <div class="article-content"><?= $i['content'] ?></div>
                </div>
            <?php endforeach; ?>
        </div>

    </div>
    <footer>
        <div class="footer_end">
            <div class="index_contact_right_logo_footer_end">
                <div class="index_header_tittle_footer_end">
                    <div class="index_header_tittle_h1_footer_end">
                        <h4> maison france remi </h4>
                    </div>
                    <div class="index_header_tittle_h2_footer_end">
                        <h5>Constructeur de Maisons Individuelles</h5>
                    </div>
                </div>
                <div class="footer_menu">
                    <ul>
                        <a href="index.php">Accueil</a>
                        <a href="history.php">Qui sommes-nous ?</a>
                        <a href="chantiers.php">Nos chantiers </a>
                        <a href="contacts.php">Nous contacter</a>
                        <a href="avis.php">Laisser un avis</a></li>
                        <a href="formulaire_devis.php">Faire un devis</a>
                        <a href="connexion.php">Se connecter</a>
                        <a href="connexion.php">Chartes de confidentialité et cookies</a>
                    </ul>
                </div>
                <div class="copyright">
                    <h1>2021 @ Copyright</h1>
                    <div class="index_contact_right_logo_lien_footer_end">
                        <a href="Index.php" alt="Maison france remi"><img src="img/photos_principales/homemono.png"></a>
                        <a href="https://www.snapchat.com/add/remibati20?share_id=NjE4QjM5&locale=fr_FR" alt="Maison france remi"><img src="/img/photos_principales/Snapchat-.png"></a>
                        <a href="https://www.facebook.com/profile.php?id=100069966685291" alt="Maison france remi"><img src="/img/photos_principales/facebook.png"></a>
                    </div>
                </div>
            </div>
        </div>
    </footer>
</body>

</html>