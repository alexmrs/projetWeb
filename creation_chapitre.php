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

        <title>Créez vos chapitres</title>
        
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
        $id_hist = $response->fetch(); 

        $id_histoire=$id_hist['id'];
        // echo $id_histoire;

        //Compteur du nombre de chapitre
        $compteur =4;
        if (isset($_POST['nb_chapitre']))
		{
			$compteur = $_POST['nb_chapitre'] + 1;
			
		} 

		if (!empty($_GET['verif']))
		{
			$nb_chapitre =0;
			for ($i=1; $i<$compteur; $i++)
			{
				if (!empty($_POST['chapitre'.$i]))
				{
					$contenu = $_POST['chapitre'.$i];
					$nb_chapitre = $nb_chapitre +1;
				$req = $BDD->prepare("INSERT INTO chapitre (num_chapitre, contenu, id_histoire) VALUES (:num_chap, :contenu, :id_hist)");
	        	$req->execute(array(
	        	'num_chap' => $i,
	        	'contenu' => $contenu, 
	        	'id_hist'=> $id_histoire)); 
	        	}
			}

			?><META http-EQUIV="Refresh" CONTENT="0; url=creation_choix.php?cpt=<?=$nb_chapitre;?>&id=<?=$id_histoire;?>&chap=0"> <?php

		}
		?>


	 	<div class="centre">
		<h2>Ajoutez les chapitres de "<?= $titre_histoire ;?>"</h2>
		<p>Dans un second temps, vous ajouterai toutes les options des chapitres.</p>
		</div>

		<!-- Demander le nombre de chapitre à l'auteur -->
        <form action="creation_chapitre.php?id=<?=$id_histoire;?>&titre=<?=$titre_histoire;?>" method="post">  
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
		<form method="POST" action="creation_chapitre.php?id=<?=$id_histoire;?>&titre=<?=$titre_histoire;?>&verif=1"> <?php
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
			<button type="submit" class="btn btn-info">Enregistrer</button>
		</div>
		</form>

	
    <?php include "includes/footer.php"; ?>

    <!-- Bootstrap -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>

    </body>
</html>