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
        'email' => FILTER_SANITIZE_EMAIL
    ]);

    $email = $_input['email'] ?? '';
    $password = $_POST['password'] ?? '';

    echo $email;
    echo $password;


    if (!$password || !$email) {
        $error = "LES CHAMPS DOIVENT ETRE REMPLIS";
    } else {
        $statementUser = $pdo->prepare('SELECT * FROM inscription WHERE email=:email');
        $statementUser->bindValue(':email', $email);
        $statementUser->execute();
        $user = $statementUser->fetch();
        // echo "<pre>";
        // var_dump($user);
        // echo "</pre>";
        // die();

        if ($user && password_verify($password, $user['password'])) {
            if (password_verify($passAdmin, $user['password'])) {
                $statementSession = $pdo->prepare('INSERT INTO session VALUES(default, :id)');
                $statementSession->bindValue(':id', $user['id']);
                $statementSession->execute();
                $sessionId = $pdo->lastInsertId();
                setcookie('session', $sessionId, time() + 60 * 60, '', '', false, true);
                header('Location: ./administrateur.php?id=' . $user['id']);
                // header('Location: ./administrateur.php?id=' . $user['id']); je ne recupere pas le bon id

            } else {
                $statementSession = $pdo->prepare('INSERT INTO session VALUES (default, :id)');
                $statementSession->bindValue(':id', $user['id']);
                $statementSession->execute();
                $sessionId = $pdo->lastInsertId();
                setcookie('session', $sessionId, time() + 60 * 60, '', '', false, true);
                header('location: /ajouter_avis.php?id=' . $user['id']);
                // header('location: /ajouter_avis.php?id=' . $user['id']); je ne recupere pas le bon id

        }}
    }
}


?>

<!DOCTYPE html>
<html lang="fr">

<head>

    <?php require_once 'includes/head.php' ?>
    <link rel="stylesheet" href="/public/CSS/style_connexion.css">
    <!-- <link rel="stylesheet" href="/public/CSS/footer.css"> -->
    <title>Connexion</title>
    <?php require_once 'includes/header.php' ?>
</head>


<body>

    <div class="container">
        <form class="connexion" action="connexion.php" method="POST">
            <div class="login">
                <div class="container">
                    <div class="sideone">
                        <div class="bck"> </div>
                        <h1>MAISON FRANCE REMI</h1> <br>
                        <h3> Rejoignez_nous</h3> <br>
                        <h2> Veuillez entrez vos identifiants pour vous connecter</h2>
                    </div>
                    <div class="sidetwo">
                        <h1> Connexion </h1>
                        <div class="form">
                            <input type="text" name="email" id="email" placeholder="E-mail" value=<?= isset($email) ? "$email" : "" ?>>

                            <br>
                            <!-- <input type="password" name="Password" placeholder="Mot de Passe"> -->
                            <input type="password" name="password" id="password" placeholder="Mot de passe" required value=<?= isset($password) ? "$password" : "" ?>>

                            <br>
                            <button class="btn btn-connect">Se connecter</button>
                            <br>
                            <div class="content">
                                <div class="content1">
                                    <h2>Pas de compte ?</h2>
                                    <a href="/inscriptions.php">Créer un compte</a>
                                </div>
                                <div class="content1">
                                    <h2>Mot de passe oublié ?</h2>
                                    <a href="/inscriptions.php">Réinitialiser le mot de passe</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
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
                        <a href="connexion.php">Chartes de confidentialité et cookies</a>
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