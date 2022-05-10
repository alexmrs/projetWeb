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

	 	<div class="centre">
		<h2>Créez les chapitres de "<?php echo $titre;?>"</h2>
		<p>Dans un second temps, vous saisirez toutes les options des chapitres.</p>
		</div>

		<?php

		$compteur = $_GET['cpt'];

		?> <form method="POST" action=""> <?php

		for ($i=$compteur; $i<($compteur+5); $i++)
		{?>
			
			<div class="form_creation">
				<div class="mb-3">
					<h5>Chapitre <?php echo $i;?></h5>
	                <textarea class="form-control" id="chapitre" name="chapitre" rows="4" placeholder="Saisissez le contenu du chapitre."></textarea>
	            </div>
        	</div>
		<?php } 

		// bouton ajouter qui renvoie vers la même page en ajoutant un paragraphe ?>

		<div class="centre">
		 <a class="btn btn-primary btn-primary" href="creation_detaillee.php?cpt=<?= $compteur+5 ?>" role="button">Ajouter + de chapitres </a>
		</div>

		</form>

	 
	

    <?php include "includes/footer.php"; ?>

    <!-- Bootstrap -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>

    </body>
</html>