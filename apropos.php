<?php

$pdo = require_once './maison_france_remi.php';



$id = $_COOKIE['session'] ?? '';
$stateUser = $pdo->prepare('SELECT id FROM session WHERE id_session=:id');
$stateUser->bindValue(':id', $id);
$stateUser->execute();
$userid = $stateUser->fetch();

?>


<!DOCTYPE html>
<html lang="fr">

<head>
    <?php require_once 'includes/head.php' ?>
    <title>Avis</title>
    <link rel="stylesheet" href="/public/css/style_apropos.css">
    <?php require_once 'includes/header.php' ?>
</head>

<body>
    <div class="container_apropos">

        <div class="container_apropos_content">

            <!-- <h1>CGE</h1> -->

            <h2>
                Dispositions générales
            </h2>

            <h3>

                MAISON FRANCE REMI est engagé dans une démarche globale de respect de la confidentialité des données à caractère
                personnel qui lui sont confiées dans le cadre de son activité, y compris à travers les moyens de collecte disponibles
                depuis son site internet MAISON FRANCE REMI.

                À ce titre, MAISON FRANCE REMI s’engage à pratiquer une exploitation des données personnelles conforme aux directives
                du Règlement Général de la Protection des Données (RGPD) de l’UE.

            </h3>


            <h2>1.Collecte de l’information</h2>
            <h3>Nous recueillons des informations lorsque vous vous inscrivez sur notre site, lorsque vous vous connectez à votre compte,
                laisser un avis, et / ou lorsque vous vous déconnectez. Les informations recueillies incluent
                votre nom, votre adresse e-mail, numéro de téléphone.
                En outre, nous recevons et enregistrons automatiquement des informations à partir de votre ordinateur et navigateur
                et la page que vous demandez.

                Sont mis à disposition des usagers du site MAISON FRANCE REMI.fr, les formulaires suivants :

                Demande de contact
                Demande de devis

                Dans chaque cas, les informations collectées à travers ces formulaires sont strictement minimisées
                aux besoins de compréhension des demandes et d’élaboration des réponses correspondantes aux services proposés.
                En dehors de ce contexte, aucune information n’est collectée. MAISON FRANCE REMI ne collecte pas de données personnelles sensibles.
            </h3>

            <h2>2. Utilisation des informations</h2>
            <h3>Toutes les informations que nous recueillons auprès de vous peuvent être utilisées pour :

                - Personnaliser votre expérience et répondre à vos besoins individuels
                - Améliorer notre site
                - Vous contacter par e-mail

                Les données personnelles qui nous sont transmises depuis le site MAISON FRANCE REMI.fr,
                sont utilisées exclusivement par MAISON FRANCE REMI dans le cadre des services proposés
                et ne font l’objet d’aucune cession à des tiers.

                Les informations communiquées ne sont soumises à aucun autre traitement en dehors de celui
                indiqué sur la page de collecte du formulaire correspondant. MAISON FRANCE REMI ne réalise
                aucun traitement automatisé et aucun profilage à partir des données qui lui sont confiées.

                MAISON FRANCE REMI ne sous-traite pas le traitement des données personnelles qui lui sont confiées.</h3>

            <h2>3. Confidentialité du commerce en ligne</h2>
            <h3>Nous sommes les seuls propriétaires des informations recueillies sur ce site. Vos informations personnelles ne seront
                pas vendues, échangées, transférées, ou données à une autre société pour n’importe quelle raison, sans votre consentement,
                en dehors de ce qui est nécessaire pour répondre à une demande et / ou une transaction, comme par exemple répondre à un devis.</h3>

            <h2>
                4. Divulgation à des tiers
            </h2>

            <h3>
                <br>
                Nous ne vendons, n’échangeons et ne transférons pas vos informations personnelles identifiables à des tiers.
                Cela ne comprend pas les tierce parties de confiance qui nous aident à exploiter notre site Web ou à mener nos affaires,
                tant que ces parties conviennent de garder ces informations confidentielles.

                Nous pensons qu’il est nécessaire de partager des informations afin d’enquêter, de prévenir ou de prendre
                des mesures concernant des activités illégales, fraudes présumées, situations impliquant des menaces potentielles à la sécurité physique de toute personne, violations de nos conditions d’utilisation, ou quand la loi nous y contraint.

                Les informations non-privées, cependant, peuvent être fournies à d’autres parties pour le marketing,
                la publicité, ou d’autres utilisations.

                Exercice des droits
                Dans le cadre de la transparence et des modalités d’exercice des droits de la personne concernée,
                les utilisateurs de MAISON FRANCE REMI.fr, qui communiquent ou nous ont communiqué des informations personnelles,
                sont informés qu’à tout moment ils peuvent exercer leurs droits sur les données personnelles qui les concernent,
                détenues par MAISON FRANCE REMI.

                À cet effet, nous mettons à leur disposition sur ce site la page “Exercez vos droits”. Depuis cette page,
                il est possible d’effectuer une demande pour :

                Reprendre son consentement, faisant ainsi valoir son droit à la limitation du traitement.
                Demander l’effacement de ses données personnelles, faisant ainsi valoir son droit à l’oubli.
                Demander la rectification de ses données personnelles, en permettant de corriger une anomalie.
                Demander la portabilité de ses données.
                Dans le cadre de cette procédure, les utilisateurs sont invités à nous communiquer les informations nécessaires
                pour les rapprocher de leurs données personnelles stockées. Leurs demandes sont exécutées à l’issue du processus
                de vérification de leur identité, auquel ils sont conviés.
                <br>
                <br>
                <br>

            </h3>

            <h2>5. Protection des informations</h2>

            <h3> <br>
                <br>
                Nous mettons en œuvre une variété de mesures de sécurité pour préserver la sécurité de vos
                informations personnelles. Nous utilisons un cryptage à la pointe de la technologie pour protéger
                les informations sensibles transmises en ligne. Nous protégeons également vos informations hors ligne.
                Les ordinateurs et serveurs utilisés pour stocker des informations personnelles identifiables sont conservés
                dans un environnement sécurisé.

                MAISON FRANCE REMI, à travers son site MAISON FRANCE REMI.fr, et plus particulièrement vis-à-vis des
                données personnelles qui lui sont confiées par ses utilisateurs, est très vigilante sur l’application de la sécurité.

                Les flux de données qui transitent depuis les navigateurs des utilisateurs,
                vers le serveur du site MAISON FRANCE REMI.fr, sont protégés par chiffrement,
                et sécurisés grâce à un certificat SSL. Le CMS qui propulse et administre les contenus du site,
                fait l’objet d’une maintenance corrective et évolutive continue, pour garantir toute faille ou
                problématique de sécurité. Enfin le data-center et le serveur sur lequel est hébergé le site MAISON FRANCE REMI.fr,
                bénéficient des meilleures protections physiques et logicielles, d’une surveillance et d’un monitoring permanents.
                Les utilisateurs sont informés que malgré toutes les mesures raisonnables de sécurité mises en œuvre,
                MAISON FRANCE REMI ne peut écarter l’éventualité d’une intrusion malveillante sur son serveur qui n’aurait
                pu être déjouée. Si cette hypothèse était avérée, MAISON FRANCE REMI s’engage à prévenir les autorités
                compétentes dans un délai maximum de 72h après estimation de l’atteinte consécutive à l’intrusion, notamment
                si la violation des données personnelles était établie.

                Est-ce que nous utilisons des cookies ?
                Nos cookies améliorent l’accès à notre site et identifient les visiteurs réguliers. En outre,
                nos cookies améliorent l’expérience d’utilisateur grâce au suivi et au ciblage de ses intérêts.
                Cependant, cette utilisation des cookies n’est en aucune façon liée à des informations personnelles
                identifiables sur notre site.
                Le site MAISON FRANCE REMI.fr, n’utilise que des cookies techniques, utiles au fonctionnement,
                et des cookies statistiques, qui permettent d’évaluer les performances du site. Aucun cookie,
                de géolocalisation, de profilage, publicitaire ou en provenance de tiers, n’est installé sur
                le logiciel de navigation de l’utilisateur pendant sa session.
                <br>
                <br>
                <br>
            </h3>


            <h2> 6. Se désabonner</h2>
            <h3>Nous utilisons l’adresse e-mail que vous fournissez pour vous envoyer des informations et mises
                à jour relatives à votre commande, des nouvelles de l’entreprise de façon occasionnelle, des
                informations sur des produits liés, etc. Si à n’importe quel moment vous souhaitez vous désinscrire ,
                des instructions de désabonnement détaillées sont incluses en bas de chaque e-mail.
            </h3>

            <h2> 7. Consentement</h2>

            <h3>
                <br>
                <br>
                En utilisant notre site, vous consentez à notre politique de confidentialité.
                Résumé : Votre politique de confidentialité en ligne renforce la confiance de l’utilisateur
                Votre politique de confidentialité offre une protection utile à votre entreprise et vos utilisateurs.
                Et surtout, elle crée un niveau accru de confiance. En utilisant un français simple, et une politique
                claire qui décrit les protections de façon concrète, votre site aura un avantage sur les concurrents,
                avec leurs politiques confuses et complexes.

                Pour toute question relative à la protection des données personnelles et à l’exercice des droits*
                Si vous êtes client, prospect de MAISON FRANCE REMI ou usager du site MAISON FRANCE REMI.fr, vous pouvez
                également nous communiquer votre demande par voie postale à :

                Pour toute question relative à la protection des données personnelles et à l’exercice des droits*

                Si vous êtes client, prospect de Maison france remi ou usager du site MAISON FRANCE REMI.fr,
                vous pouvez également nous communiquer votre demande par voie postale à :
                <br>
                <br>
                <br>
                Maison France remi <br>
                39 rue du 11 novenmbre <br>
                62880 annay <br>
                06 68 55 49 82 <br>
                <br>
                <br>

                Concernant les demandes effectuées par voie postale, de limitation, effacement, rectification
                ou portabilité sur des données personnelles vous concernant, merci d’accompagner votre demande
                par un justificatif de votre identité : ex. copie de la carte nationale d’identité. <br>
                <br>
                <br>
            </h3>
            </h2>
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