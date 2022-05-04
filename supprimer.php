<?php session_start()
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
        <title>Administrateur</title>
        <link href="moz-extension://6de86387-081d-400c-96ba-2e32fcf69c81/styles/host.css" rel="stylesheet">
    </head>
    
    <?php include "includes/header.php"; ?>

    <body>

    <?php 
    //récupérer le titre de l'histoire grâce à l'id en URL
    $requete = "SELECT titre FROM histoire WHERE id=:id_histoire"; 
    $response = $BDD->prepare($requete);
    $response->execute(array(
    "id_histoire" => $_GET['id'] ));
    $ligne = $response->fetch();
    ?> 

    <div class="centre">
        <br>
        <h2>Êtes-vous sûr de vouloir supprimer "<?=$ligne["titre"]?>" ?</h2>
        <p>Attention, la suppresion d'une histoire est définitive.</p>
        <br>
        <a class="btn btn-primary btn-danger" href="supprimer_sur.php?id=<?=$_GET['id']?>" role="button">Supprimer</a>
        <a class="btn btn-primary btn-primary" href="administrateur.php" role="button">Retour</a>

    </div>

    

       
    <?php include "includes/footer.php"; ?>


    </body>
</html>