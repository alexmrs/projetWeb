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
        
        ?> <META http-EQUIV="Refresh" CONTENT="2; url=index.php"> <?php

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

<body>
    <div class="container">
        <h2 class="text-center"><?= $titrePage ?></h2>

        <div class="well">
            <form role="form" action="connexion.php" method="post">
                <div class="mb-3">
                    <label for="pseudo" class="form-label">Pseudo</label>
                    <input type="text" class="form-control" name="pseudo" aria-describedby="pseudo" required>
                </div>
                <div class="mb-3">
                    <label for="mdp" class="form-label">Mot de passe</label>
                    <input type="password" class="form-control" name="mdp" required>
                </div>
                <div>
                    <button type="submit" class="btn btn-info"> Se Connecter </button>
                </div>
            </form>
        </div>

        <?php require_once "includes/footer.php"; ?>
    </div>

   

</body>

</html>
