<?php 
require_once("connect.php");
require_once("function.php");
?>
<nav class="navbar navbar-expand-lg navbar-light bg-light" id="navbar">
  <div class="container-fluid">
    <a class="navbar-brand" href="index.php">
        <img src="images/icones/iconeHistoire.jpg" alt="image Histoire" width="30px" height="30px">
        StoryTime
    </a>

    <div class="collapse navbar-collapse" id="navbarScroll">
      <ul class="navbar-nav me-auto my-2 my-lg-0 navbar-nav-scroll" style="--bs-scroll-height: 100px;">
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarScrollingDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Toutes les histoires
          </a>
          <ul class="dropdown-menu" aria-labelledby="navbarScrollingDropdown">
            <?php 
             $requete="SELECT * FROM histoire"; // Requête SQL pour récupèrer toutes les informations concernant les histoires
             $resultat=$BDD->prepare($requete); // Prépare la requête
             $resultat->execute(array()); // Récupère toutes les informations concernant les histoires
             $tab=$resultat->fetchAll(); // Crée un   tableau avec les informations 
             foreach($tab as $key => $ligne){ // Parcourt le tableau?> 
              <li><a class="dropdown-item" <?php if(UtilisateurConnecte()){?>href="chapitre.php?titre=<?=$ligne['titre']?>" <?php } ?> ><?=$ligne["titre"]?></a></li> <!--Comment récupérer le numéro de chapitre? POST ? GET? faire du java? nope requete PHP-->
            <?php }?>
          </ul>
        </li>
        <?php if(UtilisateurConnecte() and $_SESSION["admin"]==1){ ?>
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="administrateur.php">Administrateur</a>
        </li>
        <?php } ?>
      </ul>
    </div>

    <div class="navbar-right">
        <ul class="navbar-nav me-auto my-2 my-lg-0 navbar-nav-scroll" style="--bs-scroll-height: 100px;">
        <li class="nav-item dropdown">
          <?php if(UtilisateurConnecte()){ // Vérifie si l'utilisateur est connecté ?>
            <a class="nav-link dropdown-toggle" href="#" id="navbarScrollingDropdown" role="button" data-bs-toggle="dropdown">
              Bonjour, <?=$_SESSION['pseudo']?>
            </a>
            <ul class="dropdown-menu" aria-labelledby="navbarScrollingDropdown">
              <li><a class="dropdown-item" href="deconnexion.php">Déconnexion</a></li>
            </ul>
          <?php } else{ // Si non, menu de connexion ou d'inscription ?>
            <a class="nav-link dropdown-toggle" href="#" id="navbarScrollingDropdown" role="button" data-bs-toggle="dropdown">
              Non connecté
            </a>
              <ul class="dropdown-menu" aria-labelledby="navbarScrollingDropdown">
                <li><a class="dropdown-item" href="connexion.php">Se connecter</a></li>
                <li><a class="dropdown-item" href="inscription.php">Inscription</a></li>
              </ul>
            <?php } ?>
        </li>
      </ul>
    </div>

  </div>
  
</nav>