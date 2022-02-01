<?php



$pdo = require_once './maison_france_remi.php';

$id = $_COOKIE['session'] ?? '';
$stateUser = $pdo->prepare('SELECT id FROM session WHERE id_session=:id');
$stateUser->bindValue(':id', $id);
$stateUser->execute();
$userid = $stateUser->fetch();

$passAdmin = require_once './inscriptions_a.php';
$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $_input = filter_input_array(INPUT_POST, [
        'password' => FILTER_SANITIZE_FULL_SPECIAL_CHARS,
        'email' => FILTER_SANITIZE_EMAIL,
        'pseudo' => FILTER_SANITIZE_FULL_SPECIAL_CHARS,
        'name' => FILTER_SANITIZE_FULL_SPECIAL_CHARS,
        'sname' => FILTER_SANITIZE_FULL_SPECIAL_CHARS,
    ]);

    $password2 = preg_match('/^(?=.*\d)(?=.*[A-Z])(?=.*[a-z])(?=.*[+!@#$%])[0-9A-Za-z!@#$%]{8,20}$/', $password);
    $password = $_POST['password'] ?? '';
    $email = $_POST['email'] ?? '';
    $pseudo = $_POST['pseudo'] ?? '';
    $name = $_POST['name'] ?? '';
    $sname = $_POST['sname'] ?? '';

    if (!$name || !$password2 || !$password || !$email || !$pseudo || !$sname) {
        $error = "LES CHAMPS DOIVENT ETRE REMPLIS";
    } else {
        // echo $password; pour le crack
        $hashpassword = password_hash($password, PASSWORD_ARGON2I);
        $statement = $pdo->prepare('INSERT INTO inscription VALUES (
            DEFAULT,
            :pseudo,
            :name,
            :sname,
            :email,
            :password
            )');
        $statement->bindValue(':email', $email);
        $statement->bindValue(':name', $name);
        $statement->bindValue(':sname', $sname);
        $statement->bindValue(':pseudo', $pseudo);
        $statement->bindValue(':password', $hashpassword);
        $statement->execute();

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
        <form class="inscriptions" action="inscriptions.php" method="POST">
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
                            <input type="text" placeholder="pseudo" name="pseudo">
                            <br>
                            <input type="text" placeholder="name" name="name">
                            <br>
                            <input type="text" placeholder="sname" name="sname">
                            <br>
                            <input type="text" placeholder="email" name="email">
                            <br>
                            <input type="password" placeholder="password" name="password">
                            <br>

                            <?php if ($error) : ?>
                                <h1 style="color: red"><?= $error ?></h1>
                            <?php endif; ?>

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