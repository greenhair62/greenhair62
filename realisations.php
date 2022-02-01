<?php


$pdo = require_once './maison_france_remi.php';

$stateIndex = $pdo->prepare('SELECT * FROM chantiers WHERE id=(SELECT max(id) FROM chantiers);');
$stateIndex->execute();
$index = $stateIndex->fetchAll();

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
    <!-- css -->
    <link rel="stylesheet" href="public/css/style_realisations.css">
    <link rel="stylesheet" href="public/css/icone.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Oswald&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@1,300&display=swap" rel="stylesheet">

    <!-- bootstrap -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <title>realisations</title>
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

    <div class="realisations_tittle_h3">
        <h3>MAISON FRANCE REMI: 0615332687</h3>
    </div>

    <section>
        <div class="historyTenYears_container">
            <div class="historyTenYears_container_left">
                <div class="historyTenYears_container_left_img">
                    <img src="/img/photos_principales/pp1.png" alt="Maison Piscine En Construction">
                </div>
                <div class="historyTenYears_container_left_img2">
                    <img src="/img/photos_principales/pp2.png" alt="Maison Piscine En Construction">
                </div>
            </div>

            <div class="historyTenYears_container_right">
                <div class="historyTenYears_container_item_right">
                    <div class="historyTenYears_container_item_right_content">
                        <div class="historyTenYears_container_item_right_content_tittle">
                            <p class="p">
                                Pas de projet trop grand ou trop petit
                            </p>
                        </div>
                        <div class="historyTenYears_container_item_right_content_p1_p2">
                            <div class="historyTenYears_container_item_right_content_p1">
                                <p>
                                    Maison France Remi (Entreprise Générale de Batiment) est situé à Annay-sous-Lens, dans la région des Hauts de France,
                                    plus particulièrement dans le Pas de Calais.
                                    <br> Maison France Remi est une entreprise générale
                                    de Batiment spécialisée dans la réalisation de clos couvert, travaux de VRD, gros oeuvre, maçonnerie charpente & couverture.
                                    <br>
                                    Travaillant exclusivement avec des fournisseurs proposant des matériaux de qualité en respect aux nouvelles normes en vigueur
                                    (BBC, RT 2012 NF ...)
                                </p>
                            </div>

                            <div class="historyTenYears_container_item_right_content_p2">
                                <p>
                                    Maison France Remi (Entreprise Générale de Batiment) est situé à Annay-sous-Lens, dans la région des Hauts de France,
                                    plus particulièrement dans le Pas de Calais.
                                    <br> Maison France Remi est une entreprise générale
                                    de Batiment spécialisée dans la réalisation de clos couvert, travaux de VRD, gros oeuvre, maçonnerie charpente & couverture.
                                    <br>
                                    Travaillant exclusivement avec des fournisseurs proposant des matériaux de qualité en respect aux nouvelles normes en vigueur
                                    (BBC, RT 2012 NF ...)
                                </p>
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

                                <a href="/contacts.php">CONTACT</a>

                            </div>

                        </div>
                    </div>
                </div>
            </div>
    </section>

    <main>
        <div class="main_realisation_exemple_chantier">
            <div class="main_realisation_exemple_chantier_title">
                <h5>Exemples De Chantier</h5>
                <div class="main_realisation_exemple_chantier_container_right">
                    <div class="main_realisation_exemple_chantier_container_right_title2">
                        <!-- carousel -->
                        <div class="d1"></div>
                    </div>
                </div>
            </div>

            <div class="main_realisation_exemple_chantier_container">
                <!-- <br>
                <br> -->
                <div class="main_realisation_exemple_chantier_container_left">
                    <h2>NOTRE DERNIER CHANTIER</h2>
                    <!-- <br>
                    <br> -->
                    <div class="main_realisation_exemple_chantier_container_left_title">
                        <h3>TITRE</h3>
                        <div class="category-content">
                            <?php foreach ($index as $i) : ?>
                                <h4><?= $i['title'] ?></h4>
                            <?php endforeach; ?>
                        </div>
                    </div>

                    <div class="main_realisation_exemple_chantier_container_left_descr_img">
                        <div class="main_realisation_exemple_chantier_container_left_title2">
                            <h3>DESCRIPTION</h3>
                            <?php foreach ($index as $i) : ?>
                                <div class="category-content">
                                    <h4><?= $i['content'] ?></h4>
                                </div>
                            <?php endforeach; ?>
                        </div>
                        <div class="aside_realisation_aside_pictures_container">
                            <div class="aside_realisation_aside_pictures_container_item">
                                <!-- <div class="category-content"> -->
                                <?php foreach ($index as $i) : ?>
                                    <!-- <h2><?= $i['image'] ?></h2> -->
                                    <img src="<?= $i['image'] ?>" alt="" class="img-container">
                                <?php endforeach; ?>
                                <!-- </div> -->
                            </div>
                        </div>
                    </div>
                </div>

                <div class="aside_realisation_button">
                    <div class="aside_realisation_submit">
                        <a href="chantiers.php">VOIR NOS CHANTIERS</a>
                    </div>
                </div>
            </div>
        </div>
    </main>



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