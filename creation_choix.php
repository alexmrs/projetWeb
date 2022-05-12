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
		if (!empty($_GET['cpt']) && !empty($_GET['id']))
		{
			$id_histoire = $_GET['id'];
			$compteur = $_GET['cpt'];
			
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
		}

		//Récupère les chapitres concernés dans la table chapitre
		$requete = "SELECT id, num_chapitre FROM chapitre WHERE id_histoire=:id_hist"; 
        $response = $BDD->prepare($requete);
        $response->execute(array(
        "id_hist" => $id_histoire ));
        $chapitre = $response->fetchAll(); 

        echo $chapitre[0]['id'] ;
		?>

	 	<div class="centre">
	 	<h2>Ajoutez les choix de chaque chapitre</h2>
		<p>Créez les options et choisissez les issues de chaque chapitre.</p>
		<!-- test <?php echo $titre_histoire.$compteur.$id_histoire ;?> -->

		<br>
		<h3>Chapitre <?=$chapitre[0]['num_chapitre'];?></h3>
		</div>


		<?php $nb_choix =4;
        if (isset($_POST['nb_choix']))
		{
			$nb_choix = $_POST['nb_choix'] + 1;
			
		}?>
		<!-- Demander le nombre de choix à l'auteur -->
        <form action="creation_choix.php?cpt=<?=$compteur;?>&id=<?=$id_histoire['id'];?>" method="post">  
		<div class="row g-3 align-items-center">
		  <div class="col-auto">
		    <label for="nb_choix" class="col-form-label">Nombre de choix : </label>
		  </div>
		  <div class="col-auto">
		    <input type="text" id="nb_choix" name="nb_choix" class="form-control" aria-describedby="nombre de choix">
		  </div>
		  <div class="col-auto">
		    <button type="submit" class="btn btn-info">Valider</button>
		  </div>
		</div>
		</form>

		<?php echo $nb_choix ;?>
		
		
		<form method="POST" action="creation_choix.php?cpt=<?=$compteur;?>&id=<?=$id_histoire['id'];?>"> <?php
		for ($i=1; $i<$nb_choix; $i++)
		{?>	
			<div class="form_creation">
				<div class="mb-3">
					<h5>Choix <?php echo $i;?></h5>
					<select class="form-select" aria-label="Default select example">
					  <option selected>Open this select menu</option>
					  <option value="1">One</option>
					  <option value="2">Two</option>
					  <option value="3">Three</option>
					</select>
					<br>
	                <textarea class="form-control" id="chapitre" name="chapitre<?=$i;?>" rows="4" placeholder="Saisissez le contenu du choix."></textarea>
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