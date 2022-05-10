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
        <br>
        <h2>Créez une nouvelle histoire.</h2>
    </div>
    
    <div class="form_creation">
        <form action="creation_detaillee.php" method="post">
            <div class="mb-3">
                <label for="titre" class="form-label">Titre de l'histoire</label>
                <input type="text" class="form-control" id="titre" name="titre" placeholder="">
            </div>
            <br>
            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea class="form-control" id="description" name="description" rows="3" placeholder="Décrivez votre histoire en 1 ou 2 phrases."></textarea>
            </div>
            <br>
            <div class="d-grid gap-2 col-4 mx-auto">
            <button class="btn btn-success" type="submit">Créer</button>
            </div>
        </form>
    </div>
    

       
    <?php include "includes/footer.php"; ?>


    </body>
</html>