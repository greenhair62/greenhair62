<?php


$pdo = require_once './maison_france_remi.php';


// $id = $_COOKIE['session'] ?? '';
// $stateUser = $pdo->prepare('SELECT id FROM session WHERE id_session=:id');
// $stateUser->bindValue(':id', $id);
// $stateUser->execute();
// $userid = $stateUser->fetch();

$statement_devis = $pdo->prepare('SELECT * FROM devis ');
$statement_devis->execute();
$articles = $statement_devis->fetchAll();
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

    //     echo "<pre>";
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
    <link rel="stylesheet" href="/public/CSS/admin_devis.css">
    <title>Chantiers</title>
</head>

<header class="logo">
    <nav>
        <ul>
            <a href="Index.php" alt="Maison france remi" class="active"><img src="img/logo_noir.png" height="120px"></a>
            <li> <a href="history.php">HISTOIRE</a></li>
            <li><a href="realisations.php">REALISATIONS </a></li>
            <li> <a href="contacts.php">NOUS CONTACTER</a></li>
            <li> <a href="administrateur.php">ADMINISTRATEUR</a></li>
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
        <h1>ESPACE ADMINISTRATEUR DEVIS </h1>
        <div class="main-category-container">
            <ul class="category-container">
                <div class="content">
                    <li class="fz"><a href="/admin_devis.php">ADMINISTRATEUR VOS DEVIS<span class="small">(<?= count($articles) ?>)</span></a></li>
                    <?php foreach ($cat as $cKey => $cNum) :  ?>
                        <li class="fz">PROPRIETAIRE<a href="admin_displayDevis.php/?cat=<?= $cKey ?>"><?= $cKey ?><span class="small">(<?= $cNum ?>)</span></a></li>
                    <?php endforeach; ?>
                </div>
            </ul>
            <?php foreach ($cat as $c => $num) : ?>
                <?php foreach ($artPerCat[$c] as $a) : ?>

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