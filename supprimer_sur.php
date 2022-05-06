<?php session_start()
?>
<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        
        <!-- Bootstrap CSS -->
		<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
        <link href="style.css" rel="stylesheet">
        <title>Administrateur</title>
        <link href="moz-extension://6de86387-081d-400c-96ba-2e32fcf69c81/styles/host.css" rel="stylesheet">
    </head>
    
    <?php include "includes/header.php"; ?>

    <body>

    <?php 
    //récupérer le titre de l'histoire grâce à l'id en URL
    $requete = "SELECT titre FROM histoire WHERE id=:id_histoire"; 
    $response = $BDD->prepare($requete);
    $response->execute(array(
    "id_histoire" => $_GET['id'] ));
    $ligne = $response->fetch();

    ?> 

    <div class="centre">
        <h2><?=$ligne['titre']?> a été supprimé.</h2>
        <a href="administrateur.php">Retour</a>
    </div>

    <?php

    //Supprimer l'histoire de toutes les tables
    // Supprime aussi dans les tables chapitre, choix et progression car la suppression se fait en cascade
    $requete = 'DELETE FROM histoire WHERE id=:id';
    $response = $BDD->prepare($requete);
    $response->execute(array(
    'id' => $_GET['id'] ));
    
    ?> 

    <?php include "includes/footer.php"; ?>


    </body>
</html>