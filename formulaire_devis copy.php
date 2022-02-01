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
        'second_name' => FILTER_SANITIZE_FULL_SPECIAL_CHARS,
        'email' => FILTER_SANITIZE_EMAIL,
        'number_phone' => FILTER_SANITIZE_FULL_SPECIAL_CHARS,
        'adress' => FILTER_SANITIZE_FULL_SPECIAL_CHARS,
        'cp' => FILTER_SANITIZE_FULL_SPECIAL_CHARS,
        'city' => FILTER_SANITIZE_FULL_SPECIAL_CHARS,
        'category_lieu_travaux' => FILTER_SANITIZE_FULL_SPECIAL_CHARS,
        'content' => FILTER_SANITIZE_FULL_SPECIAL_CHARS,
        'category_renovation' => FILTER_SANITIZE_FULL_SPECIAL_CHARS,
        'category_construction' => FILTER_SANITIZE_FULL_SPECIAL_CHARS,
        'category_autres' => FILTER_SANITIZE_FULL_SPECIAL_CHARS,
        'content2' => FILTER_SANITIZE_FULL_SPECIAL_CHARS,
        'category' => FILTER_SANITIZE_FULL_SPECIAL_CHARS,
        'category_habitation' => FILTER_SANITIZE_FULL_SPECIAL_CHARS,
        'category_residence' => FILTER_SANITIZE_FULL_SPECIAL_CHARS,
    ]);

    $name = $_input['name'] ?? '';
    $second_name = $_input['second_name'] ?? '';
    $email = $_input['email'] ?? '';
    $number_phone = $_input['number_phone'] ?? '';
    $adress = $_input['adress'] ?? '';
    $cp = $_input['cp'] ?? '';
    $city = $_input['city'] ?? '';
    $category_lieu_travaux = $_input['category_lieu_travaux'] ?? '';
    $content = $_input['content'] ?? '';
    $category_renovation = $_input['category_renovation'] ?? '';
    $category_construction = $_input['category_construction'] ?? '';
    $category_autres = $_POST['category_autres'] ?? '';
    $content2 = $_POST['content2'] ?? '';
    $category = $_POST['category'] ?? '';
    $category_habitation = $_POST['category_habitation'] ?? '';
    $category_residence = $_POST['category_residence'] ?? '';

    if (!$name || !$second_name || !$email || !$number_phone || !$adress || !$cp || !$city || !$category_lieu_travaux || !$content || !$category_renovation || !$category_construction || !$category_autres || !$content || !$category || !$category_habitation || !$category_residence) {
        $error = "LES CHAMPS DOIVENT ETRE REMPLIS";
    } else {
        $statement = $pdo->prepare('INSERT INTO devis VALUES (
                DEFAULT,
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
                )');
        $statement->bindValue(':name', $name);
        $statement->bindValue(':second_name', $second_name);
        $statement->bindValue(':email', $email);
        $statement->bindValue(':number_phone', $number_phone);
        $statement->bindValue(':adress', $adress);
        $statement->bindValue(':cp', $cp);
        $statement->bindValue(':city', $city);
        $statement->bindValue(':category_lieu_travaux', $category_lieu_travaux);
        $statement->bindValue(':content', $content);
        $statement->bindValue(':category_renovation', $category_renovation);
        $statement->bindValue(':category_construction', $category_construction);
        $statement->bindValue(':category_autres', $category_autres);
        $statement->bindValue(':content2', $content2);
        $statement->bindValue(':category', $category);
        $statement->bindValue(':category_habitation', $category_habitation);
        $statement->bindValue(':category_residence', $category_residence);
        $statement->execute();

        header('Location: /devis.php');
    }
}

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
            <form action="/formulaire_devis.php" method="POST">
                <div class="form-container">
                    <div class="form-control">
                        <label for="category_lieu_travaux">Les travaux concernent-ils cette adresse ?</label>
                        <select name="category_lieu_travaux" id="category_lieu_travaux">
                            <option value="oui">Oui</option>
                            <option value="non">Non</option>
                        </select>
                    </div>

                    <div class="form-control">
                        <label for="proprietaire">Êtes vous proprietaire ?</label>
                        <select name="category" id="category">
                            <option value="oui">Oui</option>
                            <option value="non">Non</option>
                        </select>
                    </div>

                    <div class="form-control">
                        <label for="proprietaire">Pour quel type d'habitation ?</label>
                        <select name="category_habitation" id="category_habitation">
                            <option value="maison">Maison</option>
                            <option value="appartement">Appartement</option>
                        </select>
                    </div>

                    <div class="form-control2">
                        <label for="content2">Décrivez votre projet en quelques mots</label>
                        <textarea name="content2" id="content2" placeholder="DECRIVEZ VOTRE PROJET"></textarea>
                    </div>

                    <div class="form-control">
                        <label for="proprietaire">Pour quel type de résidence ? *</label>
                        <select name="category_residence" id="category_residence">
                            <option value="principale">Principale</option>
                            <option value="secondaire">Secondaire</option>
                        </select>
                    </div>
                </div>

                <div class="form-container2">
                    <div class="form-control">
                        <br>
                        <label for="name">Nom *</label>
                        <input type="text" name="name" id="name" placeholder="NOM">
                    </div>

                    <div class="form-control">
                        <br>
                        <label for="second_name">Prénom *</label>
                        <input type="text" name="second_name" id="second_name" placeholder="PRENOM">
                    </div>

                    <div class="form-control">
                        <label for="email">Email *</label>
                        <input type="text" name="email" id="email" placeholder="EMAIL">
                    </div>

                    <div class="form-control">
                        <label for="number_phone">Numéro téléphone *</label>
                        <input type="text" name="number_phone" id="number_phone" placeholder="NUMERO DE TELEPHONE">
                    </div>

                    <div class="form-control">
                        <label for="cp">Code postale *</label>
                        <input type="text" name="cp" id="cp" placeholder="CODE POSTAL">
                    </div>

                    <div class="form-control">
                        <label for="adress">Adresse postale *</label>
                        <input type="text" name="adress" id="adress" placeholder="ADRESSE">
                    </div>

                    <div class="form-control">
                        <label for="city">Ville *</label>
                        <input type="text" name="city" id="city" placeholder="VILLE">
                    </div>

                    <div class="form-control2">
                        <label for="content">INFORMATIONS COMPLEMENTAIRES *</label>
                        <textarea name="content" id="content" placeholder="INFORMATIONS COMPLEMENTAIRES"></textarea>
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