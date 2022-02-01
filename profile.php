<?php

$pdo = require_once './is_loggin.php';

$user = isLoggedIn();
if (!$user) {
    header('location: /login.php');
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <nav>
        <a href="/">Accueil</a>
        <a href="/logout.php">Se déconnecter</a>
        <a href="/profile.php">Profil</a>
    </nav>

    <h1>PROFIL</h1>
    <h2>hello <?= $user['pseudo']  ?></h2>
</body>

</html>