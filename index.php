<!DOCTYPE>
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
    <?php include "header.php"; ?>

    <body>


    <div class="row">
        <div class="card bg-dark text-white" id="carte">
		  <img src="images/histoires/abracalamar.jpg" class="card-img" alt="..." id="photoHistoire">
		  <div class="card-img-overlay">
		    <h5 class="card-title"> Nom histoire </h5>
		    <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
		    <p class="card-text">Last updated 3 mins ago</p>
		    <a class="btn btn-outline-info" href="detail_article.php?id=<?php echo $enregistrements[$i]['id'];?>" role="button">Commencer la lecture </a>
		    <a class="btn btn-outline-danger" href="detail_article.php?id=<?php echo $enregistrements[$i]['id'];?>" role="button">Recommencer l'histoire</a>
		  </div>
		</div>

		 <div class="card bg-dark text-white" id="carte">
		  <img src="images/histoires/octolanta.jpg" class="card-img" alt="..." id="photoHistoire">
		  <div class="card-img-overlay">
		    <h5 class="card-title"> Nom histoire </h5>
		    <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
		    <p class="card-text">Last updated 3 mins ago</p>
		    <a class="btn btn-outline-info" href="detail_article.php?id=<?php echo $enregistrements[$i]['id'];?>" role="button">Commencer la lecture</a>
		    <a class="btn btn-outline-danger" href="detail_article.php?id=<?php echo $enregistrements[$i]['id'];?>" role="button">Recommencer l'histoire</a>
		  </div>
		</div>

		<div class="card bg-dark text-white" id="carte">
		  <img src="..." class="card-img" alt="..." >
		  <div class="card-img-overlay">
		    <h5 class="card-title"> Nom histoire </h5>
		    <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
		    <p class="card-text">Last updated 3 mins ago</p>
		    <a class="btn btn-outline-info" href="detail_article.php?id=<?php echo $enregistrements[$i]['id'];?>" role="button">Commencer la lecture</a>
		    <a class="btn btn-outline-danger" href="detail_article.php?id=<?php echo $enregistrements[$i]['id'];?>" role="button">Recommencer l'histoire</a>
		  </div>
		</div>

	</div>



<?php include "footer.php"; ?>

<!-- Option 1: Bootstrap Bundle with Popper -->
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>

    </body>
</html>