<?php

$pdo = require_once './maison_france_remi.php';

$error = '';
// $content = '';


$filename = __DIR__ . '\img\tmp\\';

if ($_SERVER['REQUEST_METHOD'] === "POST") {

    echo "<pre>";
    print_r($filename );
    echo "</pre>";

    move_uploaded_file($_FILES["photo"]["tmp_name"], $filename . $_FILES["photo"]["name"]);

    $file = '\img\tmp\\' . $_FILES["photo"]["name"] ?? '';


    echo "<pre>";
    print_r($file );
    echo "</pre>";

    if ($file) {
                $statementImage = $pdo->prepare('INSERT INTO chantiers VALUES (DEFAULT, :image)');
                $statementImage->bindValue(':image',$file);
                $statementImage->execute();
            }
        };


    $_input = filter_input_array(INPUT_POST, [
        'title' => FILTER_SANITIZE_FULL_SPECIAL_CHARS,
        'image' => FILTER_SANITIZE_FULL_SPECIAL_CHARS,
        'image1' => FILTER_SANITIZE_FULL_SPECIAL_CHARS,
        'image2' => FILTER_SANITIZE_FULL_SPECIAL_CHARS,
        'image3' => FILTER_SANITIZE_FULL_SPECIAL_CHARS,
        'image4' => FILTER_SANITIZE_FULL_SPECIAL_CHARS,
        'category' => FILTER_SANITIZE_FULL_SPECIAL_CHARS,
        'content' => FILTER_SANITIZE_FULL_SPECIAL_CHARS,
    ]);


    $title = $_POST['title'] ?? '';
    $image = $_POST['image'] ?? '';
    $image1 = $_POST['image1'] ?? '';
    $image2 = $_POST['image2'] ?? '';
    $image3 = $_POST['image3'] ?? '';
    $image4 = $_POST['image4'] ?? '';
    $category = $_POST['category'] ?? '';
    $content = $_POST['content'] ?? '';

    if (!$title || !$image || !$image1 || !$image2 || !$image3 || !$image4 || !$category || !$content) {
        $error = "LES CHAMPS DOIVENT ETRE REMPLIS";
    } else {

        $statement = $pdo->prepare('INSERT INTO chantiers VALUES (
            DEFAULT,
            :title,
            :image,
            :image1,
            :image2,
            :image3,
            :image4,
            :category,
            :content
            )');
        $statement->bindValue(':title', $title);
        $statement->bindValue(':image', $image);
        $statement->bindValue(':image1', $image1);
        $statement->bindValue(':image2', $image2);
        $statement->bindValue(':image3', $image3);
        $statement->bindValue(':image4', $image4);
        $statement->bindValue(':category', $category);
        $statement->bindValue(':content', $content);
        $statement->execute();

        header('Location: /chantiers.php');
    }
   



?>

<!DOCTYPE html>
<html lang="fr">

<head>

    <?php require_once 'includes/head.php' ?>
    <link rel="stylesheet" href="/public/CSS/admin_ajouter_chantiers.css">
    <!-- <link rel="stylesheet" href="/public/CSS/footer.css"> -->
    <title>admin_ajouter_chantiers</title>
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
    <header class="logo2">
        <div class="container">
            <div class="content">
                <div class="block p-20 form-container">
                    <h1 class="title" value="title" alt="titre page ajouter chantiers admin">
                        ESPACE ADMINISTRATEUR
                    </h1>

                    <h2> Ajouter un chantier</h2>
                    <div class="input_gauche_reste">
                        <div class="input_gauche">
                            <form action="/admin_ajouter_chantiers.php" method="POST" enctype="multipart/form-data">
                                <div class="form-control">
                                    <label for="title">TITRE</label>
                                    <input type="text" name="title" placeholder='TITRE CHANTIER' id="title">

                                </div>
                                <div class="form-control">
                                    <label for="image">IMAGE</label>
                                    <input type="file" name="photo" id="fileUpload" value="image">

                                </div>
                                <div class="form-control">
                                    <label for="image1">IMAGE1</label>
                                    <input type="text" name="image1" id="image1" value="image1">

                                </div>
                                <div class="form-control">
                                    <label for="image2">IMAGE2</label>
                                    <input type="text" name="image2" id="image2" value="image2">

                                </div>
                                <div class="form-control">
                                    <label for="image3">IMAGE3</label>
                                    <input type="text" name="image3" id="image3" value="image3">

                                </div>
                                <div class="form-control">
                                    <label for="image4">IMAGE4</label>
                                    <input type="text" name="image4" id="image4" value="image4">

                                </div>
                        </div>
                        <div class="input_reste">
                            <div class="form-control">
                                <label for="category">CATEGORIE</label>
                                <select name="category" id="category">
                                    <option value="maconnerie">MACONNERIE</option>
                                    <option value="toiture">TOITURE</option>
                                    <option value="autres">AUTRES</option>
                                </select>

                            </div>
                            <div class="form-control">
                                <label for="content">DESCRIPTION</label>
                                <textarea name="content" id="content" placeholder="DESCRIPTION DU CHANTIER"></textarea>

                            </div>
                        </div>
                    </div>
                    <div class="form-action">
                        <!-- <button>AJOUTER</button> -->
                        <input type="submit" name="submit" value="Upload">
                    </div>
                    </form>
                </div>
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
                            <a href="administrateur.php">Administrateur</a>
                            <a href="admin_devis.php">Devis</a>
                            <a href="admin_contact.php">Demandes de contact</a>
                            <a href="admin_chantiers.php">Gérer les chantiers</a>
                            <a href="admin_ajouter_chantiers.php">Gérer les chantiers</a>
                            <a href="admin_avis.php">Gérer les avis</a>
                            <a href="apropos.php">A propos</a>
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