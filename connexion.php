<?php
session_start();
require_once "includes/connect.php";
require_once "includes/function.php";
require_once "includes/header.php";


// Vérifie que le mot de passe et identifiant entrés existent dans le formulaire
if (!empty($_POST["pseudo"]) and !empty($_POST["mdp"]))
{
    $login = escape($_POST["pseudo"]); // récupère l'identifiant du formulaire de connexion
    $password = escape($_POST["mdp"]); // récupère le mot de passe du formulaire de connexion

    //vériier le mdp crypté
    $requete="SELECT * FROM utilisateur WHERE pseudo=? AND mdp=?"; // requete SQL
    $reponse=$BDD->prepare($requete); // preparation de la requête SQL
    $reponse->execute(array($login, $password)); // execute la requête et récupère la ligne avec login et password égaux à ceux rentrés si elle existe

    echo $pseudo;
    if ($reponse->rowCount() == 1)
    {
        // Identification réussie
        $_SESSION["pseudo"] = $login; // variable super globale du pseudo

        $utilisateur=$reponse->fetch();
        $_SESSION["admin"] = $utilisateur["admin"];
        
        ?> <META http-EQUIV="Refresh" CONTENT="1; url=index.php"> <?php

    }
    else
    {
        $error = "Utilisateur non reconnu";
    }
}
?>
<!doctype html>
<html>

<?php 
$titrePage = "Connexion";

?>
<?php if (isset($error)) { // Affiche un message d'erreur si le mot de passe ou le pseudo n'existe pas dans la BDD ?>
    <div class="alert alert-danger">
        <strong>Erreur !</strong> <?= $error ?>
    </div>
<?php } ?>

<head>
        <meta charset="utf-8">
        <link href="style.css" rel="stylesheet">
        <title><?= $titrePage ?></title>
</head>

<body>


        <div class="centre">
        <h1 class="text-center"><?= $titrePage ?></h1>
        <p>Connectez-vous pour accéder à toutes nos histoires.</p>
        <br>
    

        <form action="connexion.php" method="post" class="form">
            <div class="mb-3">
                <label for="pseudo" class="form-label">Pseudo</label>
                <input type="text" class="form-control" id="pseudo" name="pseudo" aria-describedby="pseudo">
                <br>
                <label for="mdp" class="form-label">Mot de passe</label>
                <input type="password" class="form-control" id="mdp" name="mdp">
                <br>
            </div>
            <div>
                <button type="submit" class="btn btn-info"> Se connecter </button>
            </div>
        </form>
        </div>
        



        <?php require_once "includes/footer.php"; ?>
   
    <!-- Bootstrap -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>

</body>

</html>
