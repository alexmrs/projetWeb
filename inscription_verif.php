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

        <title>StoryTime</title>
        
    </head>
    <?php include "includes/header.php"; ?>

    <body>

    <?php 
    if (!empty($_POST['pseudo']) && !empty($_POST['email']) && !empty($_POST['mdp']))
	{
	    $pseudo = $_POST['pseudo'];
	    $email = $_POST['email'];
	    $mdp = $_POST['mdp'];  //$motdepasse_crypte = password_hash($mdp, PASSWORD_DEFAULT);


	    //Option : tester ici si le pseudo est le mail ne sont pas déjà utilisé

		$req = $BDD->prepare('INSERT INTO `utilisateur` (`pseudo`, `email`, `mdp`) VALUES (:pseudo, :email, :mdp)');
		$req->execute(array(
		'pseudo' => $pseudo,
		'email' => $email, 
		'mdp'=> $mdp)); //mettre $motdepasse_crypte si besoin et changer dans connexion la vérif du mot de passe
	  
	  	

	  	//remplir la variable de session
	  	$_SESSION['pseudo'] = $pseudo;
	  ?>

	  <h3>Bienvenue <?php echo $pseudo;?> ! Vous allez être redirigé(e) vers la page accueil.</h3>
	<?php }?>

	<META http-EQUIV="Refresh" CONTENT="4; url=index.php">

    <?php include "includes/footer.php"; ?>

    <!-- Bootstrap -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>

    </body>
</html>