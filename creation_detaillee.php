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

        <title>Créez votre histoire</title>
        
    </head>
    <?php include "includes/header.php"; ?>

    <body>

    <?php 

    $auteur = $_SESSION['pseudo'];

    if (!empty($_POST['titre']) && !empty($_POST['description']))
	{
	    $titre = $_POST['titre'];
	    $description = $_POST['description'];
	   

		$req = $BDD->prepare("INSERT INTO histoire (titre, auteur, description) VALUES (:titre, :auteur, :description)");
		$req->execute(array(
		'titre' => $titre,
		'auteur' => $auteur, 
		'description'=> $description)); 

	 ?>

		<h3>Créez vos chapitres</h3>
	 	<h5 class="centre">L'histoire "<?php echo $titre;?>" a bien été créée !</h5>
	 <?php }

	 // bouton ajouter qui renvoie vers la même page en ajoutant un paragraphe

	 else 
	 {?>
	 	<br>
	 	<h2 class="centre">Veuillez saisir un titre et une description.</h2>
	 	<META http-EQUIV="Refresh" CONTENT="2; url=creation.php">
	 <?php } ?>
	

    <?php include "includes/footer.php"; ?>

    <!-- Bootstrap -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>

    </body>
</html>