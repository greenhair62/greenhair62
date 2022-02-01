<?php

$pdo = require_once './maison_france_remi.php';

$id = $_COOKIE['session'] ?? '';
$stateUser = $pdo->prepare('SELECT id FROM session WHERE id_session=:id');
$stateUser->bindValue(':id', $id);
$stateUser->execute();
$userid = $stateUser->fetch();

?>

<!DOCTYPE html>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="public/css/style_history.css">
    <link rel="stylesheet" href="public/css/icone.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Oswald&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@1,300&display=swap" rel="stylesheet">
    <!-- carousel -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>

    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <title>history</title>
</head>

<body>
    <header class="logo">
        <nav>
            <ul>
                <div class="logo_logo">
                    <a href="Index.php" alt="Maison france remi" class="active"><img src="img/photos_principales/logo_blanc2.svg"></a>
                </div>
                <li> <a href="history.php">HISTOIRE</a></li>
                <li><a href="realisations.php">REALISATIONS </a></li>
                <li> <a href="contacts.php">NOUS CONTACTER</a></li>
            </ul>
        </nav>
        <div class="index_header_tittle">
            <div class="index_header_tittle_h1">
                <h1> maison france remi </h1>
            </div>
            <div class="index_header_tittle_h2">
                <h2>Constructeur de Maisons Individuelles</h2>
            </div>
        </div>
        <div class="rotation3d">
            <div class="run-rotation">
                <a href="/formulaire_devis.php" class="cercle-1">FAIRE UN
                    <br> DEVIS
                </a>
            </div>
        </div>
    </header>

    <div class="container_history">
        <div class="history_tittle_h3">
            <h3>MAISON FRANCE REMI: 0615332687</h3>
        </div>

        <div class="history">
            <H4 class="tittle_history"> Notre Histoire</H4>
            <p>
                Bienvenue sur le site de Maison France Remi (Entreprise Générale de Batiment). Maison france remi est situé à Annay-sous-Lens,
                dans la région des Hauts de France, plus particulièrement dans le Pas de Calais. Maison France Remi est une entreprise générale
                de Batiment spécialisée dans la réalisation de clos couvert, travaux de VRD, gros oeuvre, maçonnerie charpente & couverture.
                Travaillant exclusivement avec des fournisseurs proposant des matériaux de qualité en respect aux nouvelles normes en vigueur
                (BBC, RT 2012 ...) Vous bénéficierez d'une expertise certaine pour la réussite de vos travaux quelque soit le style (classique,
                comtemporain), votre maison sera toujours construite de façon traditionnelle (en porotherme recouvert d'enduit, en brique moulée
                main posée "à la Française", charpente industrielle et traditionnelle, toit plat ...)
                Toute réalisation sera effectuée dans le plus grand respect des régles de l'art, qui techniquement ont fait leur preuve.
            </p>
            <p1>
                Vous cherchez un expert pour concrétiser vos projets ? Depuis plus de 10 années d'expérience Rémi maitrise l'ensemble des techniques, il sera être
                à l'écoute pour élaborer votre maison sur mesure, vous bâtir toutes vos envies à petits prix.
                N'hésitez pas à prendre contact pour plus de renseignements. (Devis gratuit).
            </p1>
        </div>
    </div>
    <section>
        <div class="historyTenYears_container">
            <div class="historyTenYears_container_left">
                <div class="historyTenYears_container_item_left">
                    <p>
                        Nous Construisons Depuis Plus De 10 ans
                    </p>

                </div>
                <div class="historyTenYears_container_item_left_two">
                    <p>
                        Maison France Remi construit depuis maintenant plus de 10 ans dans la région des Hauts de France,
                        particulièrement dans le Pas-de-Calais. Spécialiste de la construction gros-oeuvre,
                        Maison France Remi sera vous écouter et vous conseiller afin de trouver la solution idéale à votre
                        prochain projet. Notre devis est gratuit sous 48h, n'attendez-plus
                    </p>
                </div>
                <div class="submit">
                    <a href="/devis_part1.php">DEVIS</a>
                </div>
            </div>

            <div class="historyTenYears_container_right">

                <div class="historyTenYears_container_item_right">
                    <div class="historyTenYears_container_item_right_img">


                        <div id="carouselExemple" class="carousel slide" data-ride="carousel" data-interval="6000">

                            <ol class="carousel-indicators">
                                <li data-target="#carouselExemple" data-slide-to="0" class="active"></li>
                                <li data-target="#carouselExemple" data-slide-to="1"></li>
                                <li data-target="#carouselExemple" data-slide-to="2"></li>
                            </ol>


                            <div class="carousel-inner">

                                <div class="carousel-item active">
                                    <img src="/img/photos_principales/revet1.JPEG" class="d-block">
                                </div>

                                <div class="carousel-item">
                                    <img src="/img/photos_principales/revet2.JPEG" class="d-block">
                                </div>

                                <div class="carousel-item">
                                    <img src="/img/photos_principales/revet3.JPEG" class="d-block">
                                </div>
                                <div class="carousel-item">
                                    <img src="/img/photos_principales/revet4.jpg" class="d-block">
                                </div>
                            </div>

                            <a href="#carouselExemple" class="carousel-control-prev" role="button" data-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="ture"></span>
                                <span class="sr-only">Previous</span>
                            </a>
                            <a href="#carouselExemple" class="carousel-control-next" role="button" data-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="sr-only">Next</span>
                            </a>

                        </div>
                    </div>


                </div>
                <div class="historyTenYears_container_item_right_bottom">
                    <div class="historyTenYears_container_item_right_bottom_left">
                        <div class="historyTenYears_container_item_right_bottom_left_number">
                            <p>0615332687</p>
                        </div>
                    </div>
                    <div class="historyTenYears_container_item_right_bottom_right">
                        <div class="historyTenYears_submit">
                            <a href="/chantiers.php">REALISATIONS</a>

                        </div>

                    </div>
                </div>
            </div>

    </section>

    <main>
        <div class="history_main_letsbuild">
            <div class="history_main_letsbuild_left">

                <div class="history_main_letsbuild_left_container">
                    <p>
                        Elaborons Un <br> Projet Ensemble
                    </p>
                </div>
                <div class="history_main_letsbuild_left_container2">
                    <p>
                        Maison France remi vous accompagne en amont de votre projet en faisant le pont entre votre architecte et votre terrain
                    </p>
                </div>
                <div class="history_main_letsbuild_left_container_submit">
                    <a href="/contacts.php">CONTACT</a>
                </div>
            </div>

            <div class="history_main_letsbuild_right">
                <div class="history_main_letsbuild_right_container">
                    <div class="history_main_letsbuild_right_container_p1">
                        <p>
                            NOS ACTIVITES
                        </p>
                        <div class="history_main_letsbuild_right_container_p1_title">
                            Maison France Remi (Entreprise Générale de Batiment) est situé à Annay-sous-Lens, dans la région des Hauts de France,
                            plus particulièrement dans le Pas de Calais. <br> MAISON FRANCE REMI est une entreprise générale
                            de Batiment spécialisée dans la réalisation de clos couvert, travaux de VRD, gros oeuvre, maçonnerie charpente & couverture.
                            <br> Travaillant exclusivement avec des fournisseurs proposant des matériaux de qualité en respect aux nouvelles normes en vigueur
                            (BBC - RT 2012 - RD 2020 - NF ...)
                        </div>
                    </div>
                    <div class="history_main_letsbuild_right_container_p2">
                        <p>
                            MACONNERIE GENERALE: Fondations - Dalles - Murs-porteurs
                        </p>
                    </div>
                    <div class="history_main_letsbuild_right_container_p3">
                        <p>
                            VRD (Voirie et réseaux divers): Raccordement & Viabilisation
                        </p>
                    </div>
                    <div class="history_main_letsbuild_right_container_p4">
                        <p>
                            CHARPENTE & COUVERTURE: Toiture En Pente - Plate où Arrondie
                        </p>
                    </div>
                </div>
            </div>

        </div>
    </main>

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

</body>

</html>