<?php
session_start();
require_once("includes/connect.php");
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

        <title>StoryTime </title>
        <link href="moz-extension://6de86387-081d-400c-96ba-2e32fcf69c81/styles/host.css" rel="stylesheet">
    </head>
    <?php include "includes/header.php"; ?>

    <body>

        <div class="centre">
        <h1>Inscription</h1>
        <p>Inscrivez-vous pour accéder à toutes nos histoires.</p>
        <br>
        


        <form action="inscription_verif.php" method="post" class="form">
            <div class="mb-3">
                <label for="pseudo" class="form-label">Pseudo</label>
                <input type="text" class="form-control" id="pseudo" name="pseudo" aria-describedby="pseudo">
                <br>
                <label for="email" class="form-label">Adresse email</label>
                <input type="text" class="form-control" id="email" name="email" aria-describedby="adresse email">
                <br>
                <label for="mdp" class="form-label">Mot de passe</label>
                <input type="password" class="form-control" id="mdp" name="mdp">
                <br>
            </div>
            <div>
                <button type="submit" class="btn btn-info"> S'inscrire </button>
            </div>
        </form>
        </div>
        

    <?php include "includes/footer.php"; ?>


    </body>
</html>