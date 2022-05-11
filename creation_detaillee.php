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
    	//Récupère le compteur de chapitre + titre de l'histoire dans l'URL
		if (isset($_GET['titre']))
		{
			$titre_histoire = $_GET['titre'];
		}

		//Récupérer l'id de l'histoire grâce au titre
        $requete = "SELECT id FROM histoire WHERE titre=:titre"; 
        $response = $BDD->prepare($requete);
        $response->execute(array(
        "titre" => $titre_histoire ));
        $id_histoire = $response->fetch(); 

        //Compteur du nombre de chapitre
        $compteur =4;
        if (isset($_POST['nb_chapitre']))
		{
			$compteur = $_POST['nb_chapitre'] + 1;
			
		} 

		?> 


	 	<div class="centre">
		<h2>Créez les chapitres de "<?= $titre_histoire ;?>"</h2>
		<p>Dans un second temps, vous saisirez toutes les options des chapitres.</p>
		</div>

		<!-- Demander le nombre de chapitre à l'auteur -->
        <form action="creation_detaillee.php?id=<?=$id_histoire['id'];?>&titre=<?=$titre_histoire;?>" method="post">  
		<div class="row g-3 align-items-center">
		  <div class="col-auto">
		    <label for="nb_chapitre" class="col-form-label">Nombre de chapitre : </label>
		  </div>
		  <div class="col-auto">
		    <input type="text" id="nb_chapitre" name="nb_chapitre" class="form-control" aria-describedby="nombre de chapitre">
		  </div>
		  <div class="col-auto">
		    <button type="submit" class="btn btn-info">Valider</button>
		  </div>
		</div>
		</form>
		

		<!-- Saisir le contenu des chapitres et l'envoyer -->
		<form method="POST" action=""> <?php
		for ($i=1; $i<$compteur; $i++)
		{?>	
			<div class="form_creation">
				<div class="mb-3">
					<h5>Chapitre <?php echo $i;?></h5>
	                <textarea class="form-control" id="chapitre" name="chapitre<?=$i;?>" rows="4" placeholder="Saisissez le contenu du chapitre."></textarea>
	            </div>
        	</div>
		<?php } 

		// Valider les chapitres ?>
		<div class="centre">
			<button type="submit" class="btn btn-info">Valider</button>
		 <!-- <a class="btn btn-info btn-info" href="creation_detaillee.php?cpt=<?php echo ($compteur);?>&id=<?=$id_histoire['id'];?>&titre=<?=$titre_histoire;?>" role="button">Valider</a> -->
		</div>
		</form>

	 
	
    <?php include "includes/footer.php"; ?>

    <!-- Bootstrap -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>

    </body>
</html>