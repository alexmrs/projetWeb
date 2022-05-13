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
	<?php // Récupère toutes les histoires
	$reqHist="SELECT * FROM histoire";
	$exeHist=$BDD->prepare($reqHist);
	$exeHist->execute(array());
	?>

    <div class="row">
		<?php foreach($exeHist as $key=>$histoire){
			?>
			<div class="card bg-light text-black" id="carte">
				<div class="card-img-overlay">
					<h5 class="card-title" > <?=$histoire["titre"]?> </h5>
					<p class="card-text"><?=$histoire["description"]?></p>
					<a class="btn btn-info"  <?php if(UtilisateurConnecte()){?>href="chapitre.php?titre=<?=$histoire['titre']?>" <?php } ?> role="button">Lire </a>
					<a class="btn btn-danger"  <?php if(UtilisateurConnecte()){?>href="recommencer_histoire.php?id=<?=$histoire['id']?>&titre=<?=$histoire["titre"]?>" <?php } ?> role="button">Recommencer l'histoire</a>
					<br/>
					<br/>
					<?php if(!empty($histoire["image"])) {?>
					<img src="<?=$histoire["image"]?>" class="card-img" alt="..." id="photoHistoire">
				<?php }
				else{ ?>
					<img src="https://www.linfodurable.fr/sites/linfodurable/files/styles/landscape_w800/public/2018-03/Livre%20%28c%29Billion%20Photos%20shutterstock_349265855.jpg?h=41ae7b08&itok=p-PSMLFK" class="card-img" alt="..." id="photoHistoire">
				<?php } ?>
				</div>
			</div>
		<?php }?>

	</div>



<?php include "includes/footer.php"; ?>



    </body>
</html>