<?php 
require_once "includes/connect.php";
require_once "includes/function.php";
session_start();

// Vérifie que le mot de passe et identifiant entrés existent dans le formulaire
if (!empty($_POST["pseudo"]) and !empty($_POST["mdp"])) {
    $login = escape($_POST["pseudo"]); // récupère l'identifiant du formulaire de connexion
    $password = escape($_POST["mdp"]); // récupère le mot de passe du formulaire de connexion
    $requete="SELECT * FROM utilisateurs WHERE pseudo=? AND mdp=?"; // requete SQL
    $reponse=$BDD->prepare($requete); // preparation de la requête SQL
    $reponse->execute(array($login, $password)); // execute la requête et récupère la ligne avec login et password égaux à ceux rentrés si elle existe
    if ($reponse->rowCount() == 1) {
        // Identification réussie
        $_SESSION["pseudo"] = $login; // variable super globale du 
        header("Location : index.php");
    }
    else {
        $error = "Utilisateur non reconnu";
    }
}
?>
<!doctype html>
<html>

<?php 
$pageTitle = "Connexion";
require_once "includes/header.php";
?>
<?php if (isset($error)) { // Affiche un message d'erreur si le mot de passe ou le pseudo n'existe pas dans la BDD ?>
    <div class="alert alert-danger">
        <strong>Erreur !</strong> <?= $error ?>
    </div>
<?php } ?>

<body>
    <div class="container">
        <h2 class="text-center"><?= $pageTitle ?></h2>

        <div class="well">
            <form role="form" action="connexion.php" method="post">
                <div class="mb-3">
                    <label for="pseudo" class="form-label">Pseudo</label>
                    <input type="text" class="form-control" id="pseudo" aria-describedby="pseudo" required>
                </div>
                <div class="mb-3">
                    <label for="mdp" class="form-label">Mot de passe</label>
                    <input type="password" class="form-control" id="mdp" required>
                </div>
                <div>
                    <button type="submit" class="btn btn-info"> Se Connecter </button>
                </div>
            </form>
        </div>

        <?php require_once "includes/footer.php"; ?>
    </div>

     <!-- Bootstrap -->
     <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>


</body>

</html>
