<?php

$pdo = require_once './maison_france_remi.php';

const ERR_REQUIRED = "Veuillez renseigner ce champ";
const ERR_TITLE_SHORT = "Le titre est trop court";
const ERR_CONTENT_SHORT = "L'article est trop court";

$stateCreate = $pdo->prepare('
INSERT INTO contact (
    name, 
    sname, 
    email,
    content
    ) VALUES (
            :name,
            :sname,
            :email,
            :content
        )
');

$stateUpdate = $pdo->prepare('
UPDATE contact
SET
name=:name,
sname=:sname,
email=:email,
content=:content
WHERE id=:id
');

$stateRead = $pdo->prepare('SELECT * FROM contact WHERE id=:id');

$errors = [
    'name' => '',
    'sname' => '',
    'email' => '',
    'content' => ''
];

$_GET = filter_input_array(INPUT_GET, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
$id = $_GET['id'] ?? '';

if ($id) {
    $stateRead->bindValue(':id', $id);
    $stateRead->execute();
    $article = $stateRead->fetch();
    $name = $article['name'];
    $sname = $article['sname'];
    $email = $article['email'];
    $content = $article['content'];
}

if ($_SERVER['REQUEST_METHOD'] === "POST") {

    $_POST = filter_input_array(INPUT_POST, [
        'name' => FILTER_SANITIZE_STRING,
        'sname' => FILTER_SANITIZE_STRING,
        'email' => FILTER_SANITIZE_URL,
        'content' => [
            'filter' => FILTER_SANITIZE_STRING,
            'flags' => FILTER_FLAG_NO_ENCODE_QUOTES
        ]
    ]);

    $name = $_POST['name'] ?? '';
    $sname = $_POST['sname'] ?? '';
    $email = $_POST['email'] ?? '';
    $content = $_POST['content'] ?? '';

    if (!$name) {
        $errors['name'] = ERR_REQUIRED;
    } else if (mb_strlen($name) < 3) {
        $errors['name'] = ERR_TITLE_SHORT;
    }

    if (!$sname) {
        $errors['sname'] = ERR_REQUIRED;
    } else if (mb_strlen($sname) < 3) {
        $errors['sname'] = ERR_TITLE_SHORT;
    }
    if (!$email) {
        $errors['email'] = ERR_REQUIRED;
    } else if (mb_strlen($email) < 3) {
        $errors['email'] = ERR_TITLE_SHORT;
    }

    if (!$content) {
        $errors['content'] = ERR_REQUIRED;
    } else if (mb_strlen($content) < 50) {
        $errors['content'] = ERR_CONTENT_SHORT;
    }

    if (empty(array_filter($errors, fn ($e) => $e !== ''))) {
        // echo "ok";
        if ($id) {
            $articles['name'] = $title;
            $articles['sname'] = $city;
            $articles['email'] = $image;
            $articles['content'] = $content;
            $stateUpdate->bindValue(':name',  $articles['name']);
            $stateUpdate->bindValue(':sname',  $articles['sname']);
            $stateUpdate->bindValue(':email',  $articles['email']);
            $stateUpdate->bindValue(':content',  $articles['content']);
            // $stateUpdate->bindValue(':id',  $id);
            $stateUpdate->execute();
        } else {
            $stateCreate->bindValue(':name',  $name);
            $stateCreate->bindValue(':sname',  $sname);
            $stateCreate->bindValue(':email',  $email);
            $stateCreate->bindValue(':content',  $content);
            $stateCreate->execute();
        }


        header('Location: /');
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

            <h2>DERNIER AVIS</h2>
            <div class="submit_avis">
                <a href="/avis.php">Voir tous</a>
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
                    <!-- <form class="contacts" action="contacts.php" method="POST"> -->
                    <form class="contacts" action="contacts.php<?= $id ? "?id=$id" : '' ?>" method="POST">
                        <div class="index_contact">
                            <div class="name_sname">
                                <div class="name">
                                    <input type="text" name="name" id="name" placeholder="Nom" value="<?= $name ?? '' ?>">
                                    <p class="text-error"><?= $errors['name'] ?></p>
                                    <!-- <input type="text" placeholder="Nom" name="name"> -->
                                </div>
                                <div class="sname">
                                <input type="text" name="sname" id="sname" placeholder="Nom" value="<?= $sname ?? '' ?>">
                                    <p class="text-error"><?= $errors['sname'] ?></p>
                                    <!-- <input type="text" placeholder="Prénom" name="sname"> -->
                                </div>
                            </div>
                            <div class="mail">
                            <input type="text" name="email" id="email" placeholder="Email" value="<?= $email ?? '' ?>">
                                    <p class="text-error"><?= $errors['email'] ?></p>
                                    <!-- <input type="text" placeholder="Prénom" name="sname"> -->
                                </div>
                                <!-- <input type="text" placeholder="Email" name="email"> -->
                            </div>
                            <div class="content">
                            <textarea name="content" id="content" placeholder="Votre demande"><?= $content ?? '' ?></textarea>
                                <p class="text-error"><?= $errors['content'] ?></p>
                            
                                <!-- <textarea name="content" id="content" type="text" placeholder="Décrivez votre projet en quelques mots"></textarea> -->
                            </div>
                            <div class="submit">
                                <button>ENVOYER
                                </button>
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