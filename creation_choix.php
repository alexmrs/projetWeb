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

        <title>Créez les choix</title>
        
    </head>
    <?php include "includes/header.php"; ?>

    <body>

    	<?php
    	//Récupère le compteur de chapitre + id + titre de l'histoire dans l'URL
		if (!empty($_GET['cpt']) && !empty($_GET['id']) && !empty($_GET['titre']))
		{
			$id_histoire = $_GET['id'];
			$compteur = $_GET['cpt'];
			$titre_histoire = $_GET['titre'];
		}



		//Récupère et insère les chapitres dans la table chapitre
		for ($i=1; $i<$compteur; $i++)
		{
			if (!empty($_POST['chapitre'.$i]))
			{
				$contenu = $_POST['chapitre'.$i];
			
			
			$req = $BDD->prepare("INSERT INTO chapitre (num_chapitre, contenu, id_histoire) VALUES (:num_chap, :contenu, :id_hist)");
        	$req->execute(array(
        	'num_chap' => $i,
        	'contenu' => $contenu, 
        	'id_hist'=> $id_histoire)); 
        	}
		}?>

	 	<div class="centre">
	 	<h2>Ajoutez les choix de chaque chapitre</h2>
		<p>Créez les options et choisissez les issues de chaque chapitre.</p>
		<!-- test <?php echo $titre_histoire.$compteur.$id_histoire ;?> -->
		</div>

	 
	
    <?php include "includes/footer.php"; ?>

    <!-- Bootstrap -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>

    </body>
</html>