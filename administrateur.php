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

        <title>StoryTime</title>
        <link href="moz-extension://6de86387-081d-400c-96ba-2e32fcf69c81/styles/host.css" rel="stylesheet">
    </head>
    <?php include "includes/header.php"; ?>

    <body>
        <!--Satististiques des histoires-->
        <h2>Statistiques</h2>
        <table class="table table-striped">
            <thead>
                <tr>
                <th scope="col">Titre</th>
                <th scope="col">Auteur</th>
                <th scope="col">Histoire lu</th>
                <th scope="col">Gagné</th>
                <th scope="col">Perdu</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                    $requete="SELECT * FROM HISTOIRE"; // Requête SQL pour récupèrer toutes les informations concernant les histoires
                    $resultat=$BDD->prepare($requete); // Prépare la requête
                    $resultat->execute(array()); // Récupère toutes les informations concernant les histoires
                    $tab=$resultat->fetchAll(); // Crée un tableau avec les informations 
                    foreach($tab as $key => $ligne){ // Parcourt le tableau?> 
                        <tr>
                            <th scope="row"><?=$ligne["titre"]?></th>
                            <td><?=$ligne["auteur"]?></td>
                            <td><?=$ligne["nb_lecture"]?></td>
                            <td><?=$ligne["nb_gagne"]?></td>
                            <td><?=$ligne["nb_perdu"]?></td>
                        </tr>
                <?php }?>
            </tbody>
        </table>
<?php include "includes/footer.php"; ?>

<!-- Option 1: Bootstrap Bundle with Popper -->
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>

    </body>
</html>