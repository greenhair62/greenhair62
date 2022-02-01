<?php

$pdo = require_once './maison_france_remi.php';

$id = $_COOKIE['session'] ?? '';
$stateUser = $pdo->prepare('SELECT id FROM session WHERE id_session=:id');
$stateUser->bindValue(':id', $id);
$stateUser->execute();
$userid = $stateUser->fetch();

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $_input = filter_input_array(INPUT_POST, [
        'name' => FILTER_SANITIZE_FULL_SPECIAL_CHARS,
        'sname' => FILTER_SANITIZE_FULL_SPECIAL_CHARS,
        'email' => FILTER_SANITIZE_EMAIL,
        'content' => FILTER_SANITIZE_FULL_SPECIAL_CHARS,
    ]);

    $name = $_input['name'] ?? '';
    $sname = $_input['sname'] ?? '';
    $email = $_input['email'] ?? '';
    $content = $_input['content'] ?? '';

    if (!$name || !$sname || !$email || !$content) {
        $error = "LES CHAMPS DOIVENT ETRE REMPLIS";
    } else {
        $statement = $pdo->prepare('INSERT INTO contact VALUES (
            DEFAULT,
            :name,
            :sname,
            :email,
            :content
            )');
        $statement->bindValue(':name', $name);
        $statement->bindValue(':sname', $sname);
        $statement->bindValue(':email', $email);
        $statement->bindValue(':content', $content);
        $statement->execute();

        header('Location: /contacts.php');
    }
}
$stateIndex = $pdo->prepare('SELECT * FROM avis WHERE id=(SELECT max(id) FROM chantiers);');
$stateIndex->execute();
$index = $stateIndex->fetchAll();
?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="public/css/style_contacts.css">
    <link rel="stylesheet" href="public/css/icone.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Oswald&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@1,300&display=swap" rel="stylesheet">
    <title>contacts</title>
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

    <div class="contact_avis">
        <div class="contact_avis_h2">

            <h2>DERNIERS AVIS</h2>
            <div class="submit_avis">
                <a href="/avis.php">Connectez-vous / laisser votre avis</a>
            </div>
        </div>
        <div class="contact_avis_h2_content">


            <div class="detail_article">
                
                <?php foreach ($index as $i) : ?>
                    <h3><?= $i['date'] ?></h3>

                    <h2><?= $i['pseudo'] ?></h2>
                    <h2><?= $i['title'] ?></h2>
                    <br>
                    <br>
                    <br>
                    <h3><?= $i['content'] ?></h3>
                    
                <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>

    <div class="contact_tittle_h3">
        <h3>MAISON FRANCE REMI: 0615332687</h3>
    </div>

    <footer>
        <div class="index_container_contact">

            <div class="index_contact_right">
                <div class="index_contact_right_logo">
                    <div class="index_contact_right_logo_lien">
                        <h3><a href="Index.php" alt="Maison france remi"><img src="img/photos_principales/homemono.png"></a></h3>
                        <h3><a href="https://www.snapchat.com/add/remibati20?share_id=NjE4QjM5&locale=fr_FR" alt="Maison france remi"><img src="/img/photos_principales/Snapchat-.png"></a></h3>
                        <h3><a href="https://www.facebook.com/profile.php?id=100069966685291" alt="Maison france remi"><img src="/img/photos_principales/facebook.png"></a></h3>
                    </div>
                </div>

                <div class="index_contact_right_logo_end">
                    <div class="index_contact_right_logo_end_content">
                        <div class="index_contact_right_logo_end_geolocation">
                            <div class="index_contact_right_logo_end_geolocation_icon">
                                <div class="icon_content">
                                    <h4><a href="index.php" alt="Maison france remi"><img src="/img/photos_principales/location3.png"></a></h4>
                                    <h4><a href="contacts.php" alt="Maison france remi"><img src="/img/photos_principales/phone.png"></a></h4>
                                    <h4><a href="index.php" alt="Maison france remi"><img src="/img/photos_principales/email.png"></a></h4>
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="index_contact_right_logo_end_content2">
                        <div class="index_contact_right_logo_end_geolocation2">
                            <div class="index_contact_right_logo_end_geolocation_icon2">
                                <div class="icon_content2">
                                    <p>39 rue du 11 novembre 62880 Annay-sous-Lens</p>
                                    <p>0615332687</p>
                                    <p>ellartremi@orange.fr </p>
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="index_contact_right_logo_end_content3">
                        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2539.7063663053764!2d2.874024415233991!3d50.465192379477415!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47dd31f1d5c03ab5%3A0x9d9aea24edd00290!2s39%20Rue%20%C3%80%20Cit%C3%A9%20Jean%20Jaur%C3%A8s%2C%2062880%20Annay!5e0!3m2!1sfr!2sfr!4v1633130643120!5m2!1sfr!2sfr" width="460" height="400" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
                    </div>
                </div>
            </div>

            <div class="index_contact_left">
                <div class="index_contact_left_contact_us_title">
                    <p class="p7"> <b> Nous contacter </b></p>
                </div>
                <div class="index_contact_left_contact_us">
                    <form class="contacts" action="contacts.php" method="POST">
                        <div class="index_contact">
                            <div class="name_sname">
                                <div class="name">
                                    <input type="text" placeholder="Nom" name="name">
                                </div>
                                <div class="sname">
                                    <input type="text" placeholder="Prénom" name="sname">
                                </div>
                            </div>
                            <div class="mail">
                                <input type="text" placeholder="Email" name="email">
                            </div>
                            <div class="content">
                                <textarea name="content" id="content" type="text" placeholder="Décrivez votre projet en quelques mots"></textarea>
                            </div>
                            <div class="submit">
                                <button>ENVOYER</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>


        </div>


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