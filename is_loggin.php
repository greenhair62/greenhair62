<?php
function isLoggedIn()
{

    $pdo = require_once './maison_france_remi.php';
    $sessionId = $_COOKIE['session'] ?? '';


    if ($sessionId) {
        $statementSession = $pdo->prepare('SELECT * FROM session WHERE id_session=:id');
        $statementSession->bindValue(':id', $sessionId);
        $statementSession->execute();
        $session = $statementSession->fetch();
        // echo "<pre>";
        // var_dump($session);
        // echo "</pre>";
        $userStatement = $pdo->prepare('SELECT * FROM inscription WHERE id=:id');
        $userStatement->bindValue(':id', $session['id']);
        $userStatement->execute();
        $user = $userStatement->fetch();
    }
    return $user ?? false;
}
