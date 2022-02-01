<?php

$pdo_profil = require_once './is_loggin.php';

$user = isLoggedIn();
if (!$user) {
    header ('location: /connexion.php');
}



$pdo = require_once './maison_france_remi.php';

const ERR_REQUIRED = "Veuillez renseigner ce champ";
const ERR_TITLE_SHORT = "Le titre est trop court";
const ERR_CONTENT_SHORT = "L'article est trop court";
const ERR_URL = "L'image doit avoir une URL valide";

$stateCreate = $pdo->prepare('
INSERT INTO chantiers (
    title, 
    city, 
    image, 
    image1, 
    image2, 
    image3, 
    image4,
    category,
    content
    ) VALUES (
            :title,
            :city,
            :image,
            :image1,
            :image2,
            :image3,
            :image4,
            :category,
            :content
        )
');

$stateUpdate = $pdo->prepare('
UPDATE chantiers
SET
title=:title,
city=:city,
image=:image,
image1=:image1,
image2=:image2,
image3=:image3,
image4=:image4,
image5=:image5,
category=:category,
content=:content
WHERE id=:id
');

$stateRead = $pdo->prepare('SELECT * FROM chantiers WHERE id=:id');

$category = '';


$errors = [
    'title' => '',
    'city' => '',
    'image' => '',
    'image1' => '',
    'image2' => '',
    'image3' => '',
    'image4' => '',
    'category' => '',
    'content' => ''
];

$_GET = filter_input_array(INPUT_GET, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
$id = $_GET['id'] ?? '';

if ($id) {
    $stateRead->bindValue(':id', $id);
    $stateRead->execute();
    $article = $stateRead->fetch();
    $title = $article['title'];
    $city = $article['city'];
    $image = $article['image'];
    $image1 = $article['image1'];
    $image2 = $article['image2'];
    $image3 = $article['image3'];
    $image4 = $article['image4'];
    $category = $article['category'];
    $content = $article['content'];
}

$filename =  __DIR__ . '\img\\';

if ($_SERVER['REQUEST_METHOD'] === "POST") {

    // echo "<pre>";
    // print_r($_FILES['image']);
    // echo "</pre>";

    $_POST = filter_input_array(INPUT_POST, [
        'title' => FILTER_SANITIZE_STRING,
        'city' => FILTER_SANITIZE_STRING,
        'image' => FILTER_SANITIZE_STRING,
        // 'image' => FILTER_SANITIZE_URL,
        'image1' => FILTER_SANITIZE_URL,
        'image2' => FILTER_SANITIZE_URL,
        'image3' => FILTER_SANITIZE_URL,
        'image4' => FILTER_SANITIZE_URL,
        'category' => FILTER_SANITIZE_STRING,
        'content' => [
            'filter' => FILTER_SANITIZE_STRING,
            'flags' => FILTER_FLAG_NO_ENCODE_QUOTES
        ]
    ]);

    $title = $_POST['title'] ?? '';
    $city = $_POST['city'] ?? '';
    $image = $_POST['image'] ?? '';
    $image1 = $_POST['image1'] ?? '';
    $image2 = $_POST['image2'] ?? '';
    $image3 = $_POST['image3'] ?? '';
    $image4 = $_POST['image4'] ?? '';
    $category = $_POST['category'] ?? '';
    $content = $_POST['content'] ?? '';

    if (!$title) {
        $errors['title'] = ERR_REQUIRED;
    } else if (mb_strlen($title) < 3) {
        $errors['title'] = ERR_TITLE_SHORT;
    }
    if (!$city) {
        $errors['city'] = ERR_REQUIRED;
    } else if (mb_strlen($city) < 3) {
        $errors['city'] = ERR_TITLE_SHORT;
    }

    if (!$image) {
        $errors['image'] = ERR_REQUIRED;
    // } else if (!filter_var($image, FILTER_VALIDATE_URL)) {
    //     $errors['image'] = ERR_URL;
    // }
    if (!$image1) {
        $errors['image1'] = ERR_REQUIRED;
    } else if (!filter_var($image1, FILTER_VALIDATE_URL)) {
        $errors['image1'] = ERR_URL;
    }
    if (!$image2) {
        $errors['image2'] = ERR_REQUIRED;
    } else if (!filter_var($image2, FILTER_VALIDATE_URL)) {
        $errors['image2'] = ERR_URL;
    }
    if (!$image3) {
        $errors['image3'] = ERR_REQUIRED;
    } else if (!filter_var($image3, FILTER_VALIDATE_URL)) {
        $errors['image3'] = ERR_URL;
    }
    if (!$image4) {
        $errors['image4'] = ERR_REQUIRED;
    } else if (!filter_var($image4, FILTER_VALIDATE_URL)) {
        $errors['image4'] = ERR_URL;
    }

    if (!$category) {
        $errors['category'] = ERR_REQUIRED;
    }

    if (!$content) {
        $errors['content'] = ERR_REQUIRED;
    } else if (mb_strlen($content) < 50) {
        $errors['content'] = ERR_CONTENT_SHORT;
    }

    // echo"<pre>";

    if (empty(array_filter($errors, fn ($e) => $e !== ''))) {
        // echo "ok";
        if ($id) {
            $articles['title'] = $title;
            $articles['city'] = $city;
            $articles['image'] = $image;
            $articles['image1'] = $image1;
            $articles['image2'] = $image2;
            $articles['image3'] = $image3;
            $articles['image4'] = $image4;
            $articles['category'] = $category;
            $articles['content'] = $content;
            $stateUpdate->bindValue(':title',  $articles['title']);
            $stateUpdate->bindValue(':city',  $articles['city']);
            $stateUpdate->bindValue(':image',  $articles['image']);
            $stateUpdate->bindValue(':image1',  $articles['image1']);
            $stateUpdate->bindValue(':image2',  $articles['image2']);
            $stateUpdate->bindValue(':image3',  $articles['image3']);
            $stateUpdate->bindValue(':image4',  $articles['image4']);
            $stateUpdate->bindValue(':category',  $articles['category']);
            $stateUpdate->bindValue(':content',  $articles['content']);
            // $stateUpdate->bindValue(':id',  $id);
            $stateUpdate->execute();
        } else {
            $stateCreate->bindValue(':title',  $title);
            $stateCreate->bindValue(':city',  $city);
            $stateCreate->bindValue(':image',  $image);
            $stateCreate->bindValue(':image1',  $image1);
            $stateCreate->bindValue(':image2',  $image2);
            $stateCreate->bindValue(':image3',  $image3);
            $stateCreate->bindValue(':image4',  $image4);
            $stateCreate->bindValue(':category',  $category);
            $stateCreate->bindValue(':content',  $content);
            $stateCreate->execute();
        }


        header('Location: /');
    }
}}
// if ($_SERVER['REQUEST_METHOD'] === "POST") {

//     echo "<pre>";
//     print_r($_FILES['image']);
//     echo "</pre>";

//     move_uploaded_file($_FILES["image"]["tmp_name"], $filename . $_FILES["image"]["name"]);

//     $file = '\img\\' . $_FILES["image"]["name"] ?? '';

//     if ($file) {
//         $statement = $pdo->prepare('INSERT INTO chantiers VALUES (DEFAULT, :name)');
//         $statement->bindValue(':name', $file);
//         $statement->execute();
//     }
// };

if (isset($_FILES['chantiers'])) {
    $tmpName = $_FILES['chantiers']['tmp_name'];
    $name = $_FILES['chantiers']['image'];
    $size = $_FILES['chantiers']['size'];
    $errors = $_FILES['chantiers']['error'];

 

    $tabExtension = explode('.', $name);
    $extension = strtolower(end($tabExtension));

    $extensions = ['jpg', 'png', 'jpeg', 'gif'];
    $maxSize = 400000;

    if (in_array($extension, $extensions) && $size <= $maxSize && $errors == 0) {

        $uniqueName = uniqid('', true);
        $file = $uniqueName . "." . $extension;

        move_uploaded_file($tmpName, './img/' . $file);

        $req = $pdo->prepare('INSERT INTO chantiers (image) VALUES (?)');
        $req->execute([$file]);

        echo "Image enregistrée";
        header('location: /admin_ajouter_chantiers.php');
    } else {
        echo "Une erreur est survenue";
    }
}
echo "<pre>";
print_r($_FILES['image']);
echo "</pre>";?>

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
                            <form action="/admin_ajouter_chantiers.php<?= $id ? "?id=$id" : '' ?>" method="POST" enctype="multipart/form-data">
                                <div class="form-control">
                                    <label for="title">Titre</label>
                                    <input type="text" name="title" id="title" placeholder="Titre" value="<?= $title ?? '' ?>">
                                    <p class="text-error"><?= $errors['title'] ?></p>
                                </div>
                                <div class="form-control">
                                    <label for="city">Ville</label>
                                    <input type="text" name="city" id="city" placeholder="Ville" value="<?= $city ?? '' ?>">
                                    <p class="text-error"><?= $errors['city'] ?></p>
                                </div>
                                <div class="form-control">
                                    <label for="image">Image1</label>

                                    <!-- <label for="fileUpload">Fichier:</label> -->
                                    <input type="file" name="image" id="image"placeholder="Image1" value="<?= $image ?? '' ?>">
                                    <!-- <input type="submit" name="submit" value="Upload"> -->


                                    <!-- <input type="text" name="image" id="image" placeholder="Image1" value="<?= $image ?? '' ?>">
                                    <p class="text-error"><?= $errors['image'] ?></p> -->
                                </div>


                                <div class="form-control">
                                    <label for="image1">Image2</label>
                                    <input type="text" name="image1" id="image1" placeholder="Image2" value="<?= $image1 ?? '' ?>">
                                    <p class="text-error"><?= $errors['image1'] ?></p>
                                </div>
                                <div class="form-control">
                                    <label for="image2">Image3</label>
                                    <input type="text" name="image2" id="image2" placeholder="Image3" value="<?= $image2 ?? '' ?>">
                                    <p class="text-error"><?= $errors['image2'] ?></p>
                                </div>
                                <div class="form-control">
                                    <label for="image3">Image4</label>
                                    <input type="text" name="image3" id="image3" placeholder="Image4" value="<?= $image3 ?? '' ?>">
                                    <p class="text-error"><?= $errors['image3'] ?></p>
                                </div>
                                <div class="form-control">
                                    <label for="image4">Image5</label>
                                    <input type="text" name="image4" id="image4" placeholder="Image5" value="<?= $image4 ?? '' ?>">
                                    <p class="text-error"><?= $errors['image4'] ?></p>
                                </div>
                        </div>

                        <div class="input_reste">
                            <div class="form-control">
                                <label for="category">Catégorie</label>
                                <select name="category" id="category">
                                    <option <?= !$category || $category === "maconnerie" ? 'selected' : '' ?> value="maconnerie">MACONNERIE</option>
                                    <option <?= $category === "toiture" ? 'selected' : '' ?> value="toiture">TOITURE</option>
                                    <option <?= $category === "autres" ? 'selected' : '' ?> value="autres">AUTRES</option>
                                </select>
                                <p class="text-error"><?= $errors['category'] ?></p>
                            </div>
                            <div class="form-control">
                                <label for="content">Content</label>
                                <textarea name="content" id="content" placeholder="Descriptif du chantier"><?= $content ?? '' ?></textarea>
                                <p class="text-error"><?= $errors['content'] ?></p>
                            </div>
                            <div class="form-action">
                                <a href="/" class="btn btn-secondary" type="button">Annuler</a>
                                <button class="btn btn-primary"><?= $id ? 'Modifier' : 'Sauvegarder' ?></button>
                            </div>
                        </div>

                    </div>
                    </form>
                </div>
            </div>
        </div>
    </header>
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



</body>

</html>