<?php

$pdo = require_once './maison_france_remi.php';

$pdo_profil = require_once './is_loggin.php';

$user = isLoggedIn();
if (!$user) {
    header ('location: /connexion.php');
}
?>
<!DOCTYPE html>
<html lang="fr">



<head>

    <?php require_once 'includes/head.php' ?>
    <link rel="stylesheet" href="/public/CSS/style_ajouter_avis.css">
    <title>Inscriptions</title>
    <?php require_once 'includes/header.php' ?>
</head>


<body>
    <div class="container">
        <form class="/ajouter_avis.php" action="ajouter_avis.php" method="POST">
            <div class="login">
                <div class="container">
                    <div class="sideone">
                        <div class="bck"> </div>
                        <h1>MAISON FRANCE REMI</h1> <br>
                        <h3> Votre avis nous importe</h3> <br>
                        <h2> Entrez vos commentaires ici</h2>
                    </div>
                    <div class="sidetwo">
                        <h1> Mon avis </h1>
                        <div class="form">
                        <input type="text" name="pseudo" id="pseudo" placeholder="Pseudo">
                            <br>
                            <input type="text" name="title" id="title" placeholder="Titre">
                            <br>
                            <select name="category" id="category" placeholder="Catégorie">
                                <option value="maconnerie">Maconnerie</option>
                                <option value="toiture">Toiture</option>
                                <option value="autres">Autres</option>
                            </select>

                            <textarea name="content" id="content" placeholder="Contenu"></textarea>
                            <br>

                            
                            <div class="button">
                                <button>Envoyer</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </form>
    </div>


















    <!-- <div class="addAnArticle_container">
        <ul class="addAnArticle_header-menu">
            <h2>VOTRE AVIS COMPTE</h2>
        </ul>

        <div class="content">
            <div class="block p-20 form-container">
                <h1>ecrivez nous </h1>
                <form class="/ajouter_avis.php" action="ajouter_avis.php" method="POST">
                    <div class="form-control">
                        <label for="title">Titre</label>
                        <input type="text" name="title" id="title" value="title">
                    </div>
                    <div class="form-control">
                        <label for="category">Catégorie</label>
                        <select name="category" id="category">
                            <option value="maconnerie">Maconnerie</option>
                            <option value="toiture">Toiture</option>
                            <option value="autres">Autres</option>
                        </select>
                    </div>
                    <div class="form-control">
                        <label for="content">Laissez votre avis en quelques mots</label>
                        <textarea name="content" id="content"></textarea>
                    </div>
                    <div class="form-action">
                        <button>envoyer</button>
                    </div>
                </form>
            </div>
        </div>

    </div> -->
    <?php require_once 'includes/footer.php' ?>
</body>

</html>