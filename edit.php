<?php


$filename = __DIR__ . "/data/avis.json";



// affichage a titre informatif des donnees recuperees
// echo 'EDIT';
print_r($_GET);

//nettoyage des donnes passees
$_GET = filter_input_array(INPUT_GET,FILTER_SANITIZE_FULL_SPECIAL_CHARS);
//attribution a la variable $id la valeur de l'id passé dans l'url
$id = $_GET['id'] ?? '';
// si il y a un id
if ($id) {
    // on recupere le contenu du fichier json
$data = file_get_contents($filename);
//que l'on transforme en tableau associatif
$aviss = json_decode($data, true) ?? [];
//si il y a au moins un todo
if (count ($aviss)) {
    //on recherche l'index de la todo clique dans le tableau todos en parcourant chaque id
    $avisIndex = array_search($id, array_column($aviss, 'id'));
    echo $avisIndex;
    //on attribue le contraire de la valeur du booleen done true -> falce et vice versa
    $aviss[$avisIndex]['done'] = !$aviss[$avisIndex] ['done'];
    //on modofie le contenu du fichier json en n'oubliant pas d'encoder en json le tableau $todos
    file_put_contents($filename, json_encode($aviss));
}



}
//redirection vers la page principale
header('Location: http://localhost:3000');