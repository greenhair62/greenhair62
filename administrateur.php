<?php

$pdo = require_once './is_loggin.php';

$user = isLoggedIn();
if (!$user) {
    header ('location: /connexion.php');
}




?>


<!DOCTYPE html>
<html lang="en">

<head>

    <?php require_once 'includes/head.php' ?>
    <link rel="stylesheet" href="/public/CSS/administrateur.css">

    <title>administrateur</title>
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
        <div class="content">
            <div class="main-category-container">

                <h2>ADMINISTRATEUR</h2>

                <div class="category-content">
                    <div class="articles-container">
                        <h3>MODIFIER / SUPPRIMER UN CHANTIER</h3>
                        <a href="/admin_chantiers.php">GERER LES CHANTIERS</a>
                    </div>
                    <div class="articles-container">
                        <h3>AJOUTER UN CHANTIER</h3>
                        <a href="/admin_ajouter_chantiers.php">AJOUT CHANTIER</a>
                    </div>
                    <div class="articles-container">
                        <h3>AJOUTER OU MODIFIER UN AVIS</h3>
                        <a href="/admin_avis.php">GERER LES AVIS</a>
                    </div>
                    <div class="articles-container">
                        <h3>DEMANDE DE DEVIS</h3>
                        <a href="/admin_devis.php">VOIR LES DEVIS</a>
                    </div>

                    <div class="articles-container">
                        <h3>DEMANDE DE CONTACT</h3>
                        <a href="/admin_contact.php">VOIR LES DEMANDES</a>
                    </div>

                </div>
            </div>
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