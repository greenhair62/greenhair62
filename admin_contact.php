<?php


$pdo = require_once './maison_france_remi.php';


$id = $_COOKIE['session'] ?? '';
$stateUser = $pdo->prepare('SELECT id FROM session WHERE id_session=:id');
$stateUser->bindValue(':id', $id);
$stateUser->execute();
$userid = $stateUser->fetch();


$statement_contact = $pdo->prepare('SELECT * FROM contact ');
$statement_contact->execute();
$articles = $statement_contact->fetchAll();
$categories = [];

$selectedCat = '';

$_GET = filter_input_array(INPUT_GET, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
$selectedCat = $_GET['cat'] ?? '';

if (count($articles)) {

    // $cat = array_reduce($categories, function ($acc, $c) { // doublon 
    //     if (isset($acc[$c])) {
    //         $acc[$c]++;
    //     } else {
    //         $acc[$c] = 1;
    //     }
    //     return $acc;
    // }, []);

    //     echo "<pre>";
    // print_r($cat);
    // echo "</pre>";

    $artPerCat = array_reduce($articles, function ($acc, $art) {
        if (isset($acc[$art['content']])) {
            $acc[$art['content']] = [...$acc[$art['content']], $art];
        } else {
            $acc[$art['content']] = [$art];
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
    <link rel="stylesheet" href="/public/CSS/admin_contacts.css">
    <title>admin_devis_contact</title>
</head>

<header class="logo">
    <nav>
        <ul>
            <a href="Index.php" alt="Maison france remi" class="active"><img src="img/logo_noir.png" height="120px"></a>
            <li> <a href="history.php">HISTOIRE</a></li>
            <li><a href="realisations.php">REALISATIONS </a></li>
            <li> <a href="contacts.php">NOUS CONTACTER</a></li>
            <li> <a href="administrateur.php">ADMINISTRATEUR </a></li>
        </ul>
    </nav>
    <div class="index_header_tittle_content">
        <div class="index_header_tittle">
            <div class="index_header_tittle_h1">
                <h1> maison france remi </h1>
            </div>
            <div class="index_header_tittle_h2">
                <h2>CONSTRUCTEUR DE MAISONS INDIVIDUELLES</h2>
            </div>
        </div>
    </div>
</header>



<body>
    <div class="container">
        <h1>ADMINISTRATEUR DEMANDE DE CONTACT</h1>
        <div class="main-category-container">
            <ul class="category-container">
                <div class="content">
                    <h2>TOUTES VOS DEMANDES DE CONTACT(<?= count($articles) ?>)</h2>

                </div>
            </ul>
            <?php foreach ($artPerCat as $c => $num) : ?>
                <?php foreach ($artPerCat[$c] as $a) : ?>

                    <div class="category-content_a">
                        <h2><?= $a['date'] ?></h2>
                        <h2><?= $a['name'] ?></h2>
                        <h2><?= $a['sname'] ?></h2>
                        <h2><?= $a['email'] ?></h2>
                        <h2><?= $a['content'] ?></h2>
                        <div class="action">
                            <a class="btn btn-secondary" href="/delete.php?id=<?= $a['id'] ?>">Supprimer</a>
                            <a class="btn btn-primary" href="/admin_ajouter_chantiers.php?id=<?= $a['id'] ?>">Archiver</a>
                        </div>
                    </div>

                <?php endforeach; ?>
            <?php endforeach; ?>
        </div>
    </div>
</body>
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
                    <a href="administrateur.php">Administrateur</a>
                    <a href="admin_devis.php">Devis</a>
                    <a href="admin_contact.php">Demandes de contact</a>
                    <a href="admin_chantiers.php">Gérer les chantiers</a>
                    <a href="admin_ajouter_chantiers.php">Ajouter des chantiers</a>
                    <a href="admin_avis.php">Gérer les avis</a>
                    <a href="apropos.php">Chartes de confidentialité et cookies</a>
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
</html>