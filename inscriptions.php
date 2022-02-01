<?php



$pdo = require_once './maison_france_remi.php';

$passAdmin = require_once './inscriptions_a.php';


const ERR_REQUIRED = "Veuillez renseigner ce champ";
const ERR_CONTENT_SHORT = "L'article est trop court";

$stateCreate = $pdo->prepare('
INSERT INTO inscription (
    pseudo, 
    name, 
    sname, 
    email, 
    password
    ) VALUES (
            :pseudo,
            :name,
            :sname,
            :email,
            :password
        )
');

$stateUpdate = $pdo->prepare('
UPDATE inscription
SET
pseudo=:pseudo,
name=:name,
sname=:sname,
email=:email,
password=:password
WHERE id=:id
');

$stateRead = $pdo->prepare('SELECT * FROM chantiers WHERE id=:id');

$errors = [
    'pseudo' => '',
    'name' => '',
    'sname' => '',
    'email' => '',
    'password' => ''
];

$_GET = filter_input_array(INPUT_GET, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
$id = $_GET['id'] ?? '';

if ($id) {
    $stateRead->bindValue(':id', $id);
    $stateRead->execute();
    $article = $stateRead->fetch();
    $pseudo = $article['pseudo'];
    $name = $article['name'];
    $sname = $article['sname'];
    $email = $article['email'];
    $password = $article['password'];
}

if ($_SERVER['REQUEST_METHOD'] === "POST") {

    $_POST = filter_input_array(INPUT_POST, [
        'pseudo' => FILTER_SANITIZE_STRING,
        'name' => FILTER_SANITIZE_STRING,
        'sname' => FILTER_SANITIZE_STRING,
        'email' => FILTER_SANITIZE_EMAIL,
        'password' => FILTER_SANITIZE_STRING,

    ]);

    $pseudo = $_POST['pseudo'] ?? '';
    $name = $_POST['name'] ?? '';
    $sname = $_POST['sname'] ?? '';
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';
    

    if (!$pseudo) {
        $errors['pseudo'] = ERR_REQUIRED;
    } else if (mb_strlen($pseudo) < 3) {
        $errors['pseudo'] = ERR_TITLE_SHORT;
    }
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
    } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = ERR_URL;
    }
    if (!$password) {
        $errors['password'] = ERR_REQUIRED;
    } else if (mb_strlen($password) < 3) {
        $errors['password'] = ERR_TITLE_SHORT;
    }

    $hashpassword = password_hash($password, PASSWORD_ARGON2I);
    // echo"<pre>";

    if (empty(array_filter($errors, fn ($e) => $e !== ''))) {
        // echo "ok";
        if ($id) {
            $articles['pseudo'] = $pseudo;
            $articles['name'] = $name;
            $articles['sname'] = $sname;
            $articles['email'] = $email;
            $articles['password'] = $hashpassword;
            $stateUpdate->bindValue(':pseudo',  $articles['pseudo']);
            $stateUpdate->bindValue(':name',  $articles['city']);
            $stateUpdate->bindValue(':sname',  $articles['sname']);
            $stateUpdate->bindValue(':email',  $articles['email']);
            $stateUpdate->bindValue(':password',  $articles['password']);
            $stateUpdate->execute();
        } else {
            $stateCreate->bindValue(':pseudo',  $pseudo);
            $stateCreate->bindValue(':name',  $name);
            $stateCreate->bindValue(':sname',  $sname);
            $stateCreate->bindValue(':email',  $email);
            $stateCreate->bindValue(':password',  $hashpassword);
            $stateCreate->execute();
        }


        header('Location: /connexion.php');
    }
}

?>

<!DOCTYPE html>
<html lang="fr">

<head>

    <?php require_once 'includes/head.php' ?>
    <link rel="stylesheet" href="/public/CSS/style_inscriptions.css">
    <title>Inscriptions</title>
    <?php require_once 'includes/header.php' ?>
</head>


<body>
    <div class="container">
        <!-- <form class="inscriptions" action="inscriptions.php" method="POST"> -->
        <form action="/inscriptions.php<?= $id ? "?id=$id" : '' ?>" method="POST">
        <div class="login">
            <div class="container">
                <div class="sideone">
                    <div class="bck"> </div>
                    <h1>MAISON FRANCE REMI</h1> <br>
                    <h3> Rejoignez_nous</h3> <br>
                    <h2> Veuillez entrez vos identifiants pour vous connecter</h2>
                </div>
                <div class="sidetwo">
                    <h1> Inscription </h1>
                    <div class="form">
                        <input type="text" name="pseudo" id="pseudo" placeholder="Pseudo" value="<?= $pseudo ?? '' ?>">
                        <p class="text-error"><?= $errors['pseudo'] ?></p>
                        <!-- <input type="text" placeholder="pseudo" name="pseudo"> -->
                        <!-- <br> -->
                        <input type="text" name="name" id="name" placeholder="Nom" value="<?= $name ?? '' ?>">
                        <p class="text-error"><?= $errors['name'] ?></p>
                        <!-- <input type="text" placeholder="name" name="name"> -->
                        <!-- <br> -->
                        <input type="text" name="sname" id="sname" placeholder="Prénom" value="<?= $sname ?? '' ?>">
                        <p class="text-error"><?= $errors['sname'] ?></p>
                        <!-- <input type="text" placeholder="sname" name="sname"> -->
                        <!-- <br> -->
                        <input type="text" name="email" id="email" placeholder="Email" value="<?= $email ?? '' ?>">
                        <p class="text-error"><?= $errors['email'] ?></p>
                        <!-- <input type="text" placeholder="email" name="email"> -->
                        <!-- <br> -->
                        <input type="text" name="password" id="password" placeholder="password" value="<?= $password ?? '' ?>">
                        <p class="text-error"><?= $errors['password'] ?></p>
                        <!-- <input type="password" placeholder="password" name="password"> -->
                        <!-- <br> -->

                       

                        <button>Créer le compte</button>

                        <!-- <button class="btn btn-create">Créer un compte
                                <a href="/connexion.php"></a>
                            </button> -->
                    </div>
                </div>
            </div>
        </div>

        </form>
    </div>
    <?php require_once 'includes/footer.php' ?>
</body>

</html>