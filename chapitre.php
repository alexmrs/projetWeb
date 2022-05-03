<?php session_start()?>
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
        <?php if(isset($_GET["titre"])){
            $_SESSION["titre"]=escape($_GET["titre"]);
            $requete="SELECT * FROM histoire WHERE titre=?"; // Requête SQL
            $resultatIdHist=$BDD->prepare($requete); // Preparation de la requête SQL
            $resultatIdHist->execute(array($_SESSION["titre"])); // Execute la requête 
            $idHist=$resultatIdHist->fetch();
            $_SESSION["idHist"]=$idHist["id"]; // Définit l'id de l'histoire entrain d'être lu

            $requete="SELECT * FROM progression WHERE id_utilisateur=? AND id_histoire=?"; // requête SQL
            $resultatProgr=$BDD->prepare($requete); // preparation de la requête SQL
            $resultatProgr->execute(array($_SESSION["idUtil"], $_SESSION["idHist"])); // execute la requête et récupère la ligne avec login et password égaux à ceux rentrés si elle existe
            $progressionHist=$resultatProgr->fetch();
            $chapitreActuel=$progressionHist["id_chapitre"];
        }?>
        <h1 class="centre"><?=$_SESSION["titre"] ?></h1>
        <p></p>
        
        
        
        <?php include "includes/footer.php"; ?>
    </body>
</html>