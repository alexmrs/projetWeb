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

    <div class="centre">
        <h1>Espace administrateur</h1>
        <br>
        <a class="btn btn-primary btn-success" href="creation.php" role="button">Créer une histoire</a>
        <a class="btn btn-primary btn-primary" href="statistique.php" role="button">Statistiques</a>

    </div>

    <br>

        <div class="container"> <!-- ajouter un id pour le css -->
            <ul class="list-group list-group-flush">
                <?php $requete="SELECT * FROM histoire"; // Requête SQL pour récupèrer toutes les informations concernant les histoires
                $resultat=$BDD->prepare($requete); // Prépare la requête
                $resultat->execute(array()); // Récupère toutes les informations concernant les histoires
                $tab=$resultat->fetchAll(); // Crée un tableau avec les informations 
                foreach($tab as $key => $ligne)
                {?> <!-- // Parcourt le tableau      -->
                    <li class="list-group-item">
                        <?=$ligne["titre"]?>

                        <div class="droite">
                        <a class="btn btn-primary btn-warning" href="modifier.php?id=<?=$ligne["id"]?>" role="button">Modifier</a>
                        <a class="btn btn-primary btn-danger" href="supprimer.php?id=<?=$ligne["id"]?>" role="button">Supprimer</a>
                        </div>
                        </li>
                <?php }?>
            </ul>
        </div>

       
    <?php include "includes/footer.php"; ?>


    </body>
</html>