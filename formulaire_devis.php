<?php

$pdo = require_once './maison_france_remi.php';

const ERR_REQUIRED = "Veuillez renseigner ce champ";
const ERR_TITLE_SHORT = "Saisie trop courte";
const ERR_CONTENT_SHORT = "Le contenu doit faire plus de 50 caractères";

$stateCreate = $pdo->prepare('
INSERT INTO devis (
    name,
    second_name,
    email,
    number_phone,
    adress,
    cp,
    city,
    category_lieu_travaux,
    content,
    category_renovation,
    category_construction,
    category_autres,
    content2,
    category,
    category_habitation,
    category_residence
      ) VALUES (
        :name,
        :second_name,
        :email,
        :number_phone,
        :adress,
        :cp,
        :city,
        :category_lieu_travaux,
        :content,
        :category_renovation,
        :category_construction,
        :category_autres,
        :content2,
        :category,
        :category_habitation,
        :category_residence
        )
');

$stateUpdate = $pdo->prepare('
        UPDATE devis
        SET
        name=:name,
        second_name=:second_name,
        email=:email,
        number_phone=:number_phone,
        adress=:adress,
        cp=:cp,
        city=:city,
        category_lieu_travaux=:category_lieu_travaux,
        content=:content,
        category_renovation=:category_renovation,
        category_construction=:category_construction,
        category_autres=:category_autres,
        content2=:content2,
        category=:category,
        category_habitation=:category_habitation,
        category_residence=:category_residence
        WHERE id=:id
        ');

$stateRead = $pdo->prepare('SELECT * FROM devis WHERE id=:id');


$category = '';
$category_lieu_travaux = '';
$category_habitation = '';
$category_residence = '';


$errors = [
    'name' => '',
    'second_name' => '',
    'email' => '',
    'number_phone' => '',
    'adress' => '',
    'cp' => '',
    'city' => '',
    'category_lieu_travaux' => '',
    'content' => '',
    'category_renovation' => '',
    'category_construction' => '',
    'category_autres' => '',
    'content2' => '',
    'category' => '',
    'category_habitation' => '',
    'category_residence' => ''
];

$_GET = filter_input_array(INPUT_GET, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
$id = $_GET['id'] ?? '';

if ($id) {
    $stateRead->bindValue(':id', $id);
    $stateRead->execute();
    $article = $stateRead->fetch();
    $name = $article['name'];
    $second_name = $article['second_name'];
    $email = $article['email'];
    $number_phone = $article['number_phone'];
    $adress = $article['adress'];
    $cp = $article['cp'];
    $city = $article['city'];
    $category_lieu_travaux = $article['category_lieu_travaux'];
    $content = $article['content'];
    $category_renovation = $article['category_renovation'];
    $category_construction = $article['category_construction'];
    $category_autres = $article['category_autres'];
    $content2 = $article['content2'];
    $category = $article['category'];
    $category_habitation = $article['category_habitation'];
    $category_residence = $article['category_residence'];
}


if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $_POST = filter_input_array(INPUT_POST, [
        'name' => FILTER_SANITIZE_FULL_SPECIAL_CHARS,
        'second_name' => FILTER_SANITIZE_FULL_SPECIAL_CHARS,
        'email' => FILTER_SANITIZE_EMAIL,
        'number_phone' => FILTER_SANITIZE_FULL_SPECIAL_CHARS,
        'adress' => FILTER_SANITIZE_FULL_SPECIAL_CHARS,
        'cp' => FILTER_SANITIZE_FULL_SPECIAL_CHARS,
        'city' => FILTER_SANITIZE_FULL_SPECIAL_CHARS,
        'category_lieu_travaux' => FILTER_SANITIZE_FULL_SPECIAL_CHARS,
        'content' => [
            'filter' => FILTER_SANITIZE_STRING,
            'flags' => FILTER_FLAG_NO_ENCODE_QUOTES
        ],
        'category_renovation' => FILTER_SANITIZE_FULL_SPECIAL_CHARS,
        'category_construction' => FILTER_SANITIZE_FULL_SPECIAL_CHARS,
        'category_autres' => FILTER_SANITIZE_FULL_SPECIAL_CHARS,
        'content2' => [
            'filter' => FILTER_SANITIZE_STRING,
            'flags' => FILTER_FLAG_NO_ENCODE_QUOTES
        ],
        'category' => FILTER_SANITIZE_FULL_SPECIAL_CHARS,
        'category_habitation' => FILTER_SANITIZE_FULL_SPECIAL_CHARS,
        'category_residence' => FILTER_SANITIZE_FULL_SPECIAL_CHARS,
    ]);

    $name = $_POST['name'] ?? '';
    $second_name = $_POST['second_name'] ?? '';
    $email = $_POST['email'] ?? '';
    $number_phone = $_POST['number_phone'] ?? '';
    $adress = $_POST['adress'] ?? '';
    $cp = $_POST['cp'] ?? '';
    $city = $_POST['city'] ?? '';
    $category_lieu_travaux = $_POST['category_lieu_travaux'] ?? '';
    $content = $_POST['content'] ?? '';
    $category_renovation = $_POST['category_renovation'] ?? '';
    $category_construction = $_POST['category_construction'] ?? '';
    $category_autres = $_POST['category_autres'] ?? '';
    $content2 = $_POST['content2'] ?? '';
    $category = $_POST['category'] ?? '';
    $category_habitation = $_POST['category_habitation'] ?? '';
    $category_residence = $_POST['category_residence'] ?? '';

    if (!$name) {
        $errors['name'] = ERR_REQUIRED;
    } else if (mb_strlen($name) < 3) {
        $errors['name'] = ERR_TITLE_SHORT;
    }
    if (!$second_name) {
        $errors['second_name'] = ERR_REQUIRED;
    } else if (mb_strlen($second_name) < 3) {
        $errors['second_name'] = ERR_TITLE_SHORT;
    }
    if (!$email) {
        $errors['email'] = ERR_REQUIRED;
    }
    if (!$number_phone) {
        $errors['number_phone'] = ERR_REQUIRED;
        // } else if (!filter_var($number_phone) < 2) {
        //     $errors['number_phone'] = ERR_TITLE_SHORT;
    }
    if (!$adress) {
        $errors['adress'] = ERR_REQUIRED;
        // } else if (!filter_var($adress) < 2) {
        //     $errors['adress'] = ERR_TITLE_SHORT;
    }
    if (!$cp) {
        $errors['cp'] = ERR_REQUIRED;
        // } else if (!filter_var($cp) < 2) {
        //     $errors['cp'] = ERR_TITLE_SHORT;
    }
    if (!$city) {
        $errors['city'] = ERR_REQUIRED;
        // } else if (!filter_var($city) < 3) {
        //     $errors['city'] = ERR_TITLE_SHORT;
    }

    if (!$category_lieu_travaux) {
        $errors['category_lieu_travaux'] = ERR_REQUIRED;
    }
    // if (!$content) {
    //     $errors['content'] = ERR_REQUIRED;
    // } else if (mb_strlen($content) < 50) {
    //     $errors['content'] = ERR_CONTENT_SHORT;
    // }
    if (!$category_renovation) {
        $errors['category_renovation'] = ERR_REQUIRED;
    }
    if (!$category_construction) {
        $errors['category_construction'] = ERR_REQUIRED;
    }
    if (!$category_autres) {
        $errors['category_autres'] = ERR_REQUIRED;
    }
    // if (!$content2) {
    //     $errors['content2'] = ERR_REQUIRED;
    // } else if (mb_strlen($content2) < 20) {
    //     $errors['content2'] = ERR_CONTENT_SHORT;
    // }
    if (!$category) {
        $errors['category'] = ERR_REQUIRED;
    }
    if (!$category_habitation) {
        $errors['category_habitation'] = ERR_REQUIRED;
    }
    if (!$category_residence) {
        $errors['category_residence'] = ERR_REQUIRED;
    }

    // echo"<pre>";

    if (empty(array_filter($errors, fn ($e) => $e !== ''))) {
        // echo "ok";
        if ($id) {
            $articles['name'] = $name;
            $articles['second_name'] = $second_name;
            $articles['email'] = $email;
            $articles['number_phone'] = $number_phone;
            $articles['adress'] = $adress;
            $articles['cp'] = $cp;
            $articles['city'] = $city;
            $articles['category_lieu_travaux'] = $category_lieu_travaux;
            $articles['content'] = $content;
            $articles['category_renovation'] = $category_renovation;
            $articles['category_construction'] = $category_construction;
            $articles['category_autres'] = $category_autres;
            $articles['content2'] = $content2;
            $articles['category'] = $category;
            $articles['category_habitation'] = $category_habitation;
            $articles['category_residence'] = $category_residence;
            $stateUpdate->bindValue(':name',  $articles['name']);
            $stateUpdate->bindValue(':second_name',  $articles['second_name']);
            $stateUpdate->bindValue(':email',  $articles['email']);
            $stateUpdate->bindValue(':number_phone',  $articles['number_phone']);
            $stateUpdate->bindValue(':adress',  $articles['adress']);
            $stateUpdate->bindValue(':cp',  $articles['cp']);
            $stateUpdate->bindValue(':city',  $articles['city']);
            $stateUpdate->bindValue(':category_lieu_travaux',  $articles['category_lieu_travaux']);
            $stateUpdate->bindValue(':content',  $articles['content']);
            $stateUpdate->bindValue(':category_renovation',  $articles['category_renovation']);
            $stateUpdate->bindValue(':category_construction',  $articles['category_construction']);
            $stateUpdate->bindValue(':category_autres',  $articles['category_autres']);
            $stateUpdate->bindValue(':category',  $articles['category']);
            $stateUpdate->bindValue(':content2',  $articles['content2']);
            $stateUpdate->bindValue(':category_habitation',  $articles['category_habitation']);
            $stateUpdate->bindValue(':category_residence',  $articles['category_residence']);
            $stateUpdate->execute();
        } else {
            $stateCreate->bindValue(':name',  $name);
            $stateCreate->bindValue(':second_name',  $second_name);
            $stateCreate->bindValue(':email',  $email);
            $stateCreate->bindValue(':number_phone',  $number_phone);
            $stateCreate->bindValue(':adress',  $adress);
            $stateCreate->bindValue(':cp',  $cp);
            $stateCreate->bindValue(':city',  $city);
            $stateCreate->bindValue(':category_lieu_travaux',  $category_lieu_travaux);
            $stateCreate->bindValue(':content',  $content);
            $stateCreate->bindValue(':category_renovation',  $category_renovation);
            $stateCreate->bindValue(':category_construction',  $category_construction);
            $stateCreate->bindValue(':category_autres',  $category_autres);
            $stateCreate->bindValue(':category',  $category);
            $stateCreate->bindValue(':content2',  $content2);
            $stateCreate->bindValue(':category_habitation',  $category_habitation);
            $stateCreate->bindValue(':category_residence',  $category_residence);
            $stateCreate->execute();
        }
        header('Location: /devis.php');
    }
}
// echo "<pre>";
// print_r($id);
// echo "</pre>";
// die();

?>


<!DOCTYPE html>
<html lang="fr">

<head>
    <?php require_once 'includes/head.php' ?>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="public/css/formulaire_devis.css">

    <title>formulaire_devis</title>
    <?php require_once 'includes/header.php' ?>
</head>

<body>

    <div class="container">
        <h1>DEMANDE DE DEVIS</h1>
        <div class="container_choice">
            <div class="container_choice_button">

                <div class="container_choice_button1">
                    <h2>Votre projet</h2>
                </div>
                <div class="container_choice_button2">
                    <h2>Vos coordonnées</h2>
                </div>
            </div>
        </div>


        <div class="content">
            <!-- <form action="/formulaire_devis.php" method="POST"> -->
            <form action="/formulaire_devis.php<?= $id ? "?id=$id" : '' ?>" method="POST">
                <div class="form-container">
                    <div class="form-control">
                        <label for="category_lieu_travaux">Les travaux concernent-ils cette adresse ?</label>
                        <select name="category_lieu_travaux" id="category_lieu_travaux">
                            <option <?= $category_lieu_travaux === "oui" ? 'selected' : '' ?> value="oui">OUI</option>
                            <option <?= $category_lieu_travaux === "non" ? 'selected' : '' ?> value="non">NON</option>
                            <!-- <option value="oui">Oui</option>
                            <option value="non">Non</option> -->
                        </select>
                        <p class="text-error"><?= $errors['category_lieu_travaux'] ?></p>
                    </div>

                    <div class="form-control">
                        <label for="proprietaire">Êtes vous proprietaire ?</label>
                        <select name="category" id="category">
                            <option <?= $category === "oui" ? 'selected' : '' ?> value="oui">OUI</option>
                            <option <?= $category === "non" ? 'selected' : '' ?> value="non">NON</option>
                            <!-- <option value="oui">Oui</option>
                            <option value="non">Non</option> -->
                        </select>
                        <p class="text-error"><?= $errors['category'] ?></p>
                    </div>

                    <div class="form-control">
                        <label for="proprietaire">Pour quel type d'habitation ?</label>
                        <select name="category_habitation" id="category_habitation">
                            <option <?= $category_habitation === "oui" ? 'selected' : '' ?> value="oui">OUI</option>
                            <option <?= $category_habitation === "non" ? 'selected' : '' ?> value="non">NON</option>
                            <!-- <option value="maison">Maison</option>
                            <option value="appartement">Appartement</option> -->
                        </select>
                        <p class="text-error"><?= $errors['category_habitation'] ?></p>
                    </div>

                    <div class="form-control2">
                        <label for="content2">Décrivez votre projet en quelques mots</label>

                        <textarea name="content2" id="content2" placeholder="Descriptif "><?= $content2 ?? '' ?></textarea>
                        <p class="text-error"><?= $errors['content2'] ?></p>



                        <!-- <input type="textarea" name="content2" id="content2" value="<?= $content2 ?? '' ?>">
                        <p class="text-error"><?= $errors['content2'] ?></p> -->
                        <!-- <textarea name="content2" id="content2" placeholder="DECRIVEZ VOTRE PROJET"></textarea> -->
                    </div>

                    <div class="form-control">
                        <label for="proprietaire">Pour quel type de résidence ? *</label>
                        <select name="category_residence" id="category_residence">
                            <option <?= $category_residence === "oui" ? 'selected' : '' ?> value="oui">OUI</option>
                            <option <?= $category_residence === "non" ? 'selected' : '' ?> value="non">NON</option>
                            <!-- <option value="principale">Principale</option>
                            <option value="secondaire">Secondaire</option> -->
                        </select>
                        <p class="text-error"><?= $errors['category_residence'] ?></p>
                    </div>
                </div>

                <div class="form-container2">
                    <div class="form-control">
                        <br>
                        <label for="name">Nom *</label>
                        <input type="text" name="name" id="name" value="<?= $name ?? '' ?>">
                        <p class="text-error"><?= $errors['name'] ?></p>
                        <!-- <input type="text" name="name" id="name" placeholder="NOM"> -->
                    </div>

                    <div class="form-control">
                        <br>
                        <label for="second_name">Prénom *</label>
                        <input type="text" name="second_name" id="second_name" value="<?= $second_name ?? '' ?>">
                        <p class="text-error"><?= $errors['second_name'] ?></p>
                        <!-- <input type="text" name="second_name" id="second_name" placeholder="PRENOM"> -->
                    </div>

                    <div class="form-control">
                        <label for="email">Email *</label>
                        <input type="text" name="email" id="email" value="<?= $email ?? '' ?>">
                        <p class="text-error"><?= $errors['email'] ?></p>
                        <!-- <input type="text" name="email" id="email" placeholder="EMAIL"> -->
                    </div>

                    <div class="form-control">
                        <label for="number_phone">Numéro téléphone *</label>
                        <input type="text" name="number_phone" id="number_phone" value="<?= $number_phone ?? '' ?>">
                        <p class="text-error"><?= $errors['number_phone'] ?></p>
                        <!-- <input type="text" name="number_phone" id="number_phone" placeholder="NUMERO DE TELEPHONE"> -->
                    </div>

                    <div class="form-control">
                        <label for="cp">Code postale *</label>
                        <input type="text" name="cp" id="cp" value="<?= $number_phone ?? '' ?>">
                        <p class="text-error"><?= $errors['cp'] ?></p>
                        <!-- <input type="text" name="cp" id="cp" placeholder="CODE POSTAL"> -->
                    </div>

                    <div class="form-control">
                        <label for="adress">Adresse postale *</label>
                        <input type="text" name="adress" id="adress" value="<?= $adress ?? '' ?>">
                        <p class="text-error"><?= $errors['adress'] ?></p>
                        <!-- <input type="text" name="adress" id="adress" placeholder="ADRESSE"> -->
                    </div>

                    <div class="form-control">
                        <label for="city">Ville *</label>
                        <input type="text" name="city" id="city" value="<?= $city ?? '' ?>">
                        <p class="text-error"><?= $errors['city'] ?></p>
                        <!-- <input type="text" name="city" id="city" placeholder="VILLE"> -->
                    </div>

                    <div class="form-control2">
                        <label for="content">INFORMATIONS COMPLEMENTAIRES *</label>


                        <textarea name="content" id="content" placeholder="Descriptif "><?= $content ?? '' ?></textarea>
                        <p class="text-error"><?= $errors['content'] ?></p>


                        <!-- <input type="textarea" name="content" id="content" value="<?= $content ?? '' ?>">
                        <p class="text-error"><?= $errors['content'] ?></p> -->
                        <!-- <textarea name="content" id="content" placeholder="INFORMATIONS COMPLEMENTAIRES"></textarea> -->
                    </div>
                    <div class="form-action">
                        <button>ENVOYER</button>
                    </div>

                </div>
            </form>
        </div>
    </div>

</body>
<?php require_once 'includes/footer.php' ?>

</html>