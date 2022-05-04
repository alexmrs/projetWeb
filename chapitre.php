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
        <?php if(isset($_GET["titre"])){
            $_SESSION["titre"]=escape($_GET["titre"]);
            $requete="SELECT * FROM histoire WHERE titre=?"; // Requête SQL
            $resultatHist=$BDD->prepare($requete); // Preparation de la requête SQL
            $resultatHist->execute(array($_SESSION["titre"])); // Execute la requête 
            $histoire=$resultatHist->fetch();
            $_SESSION["idHist"]=$histoire["id"]; // Définit l'id de l'histoire entrain d'être lu

            $requete="SELECT * FROM progression WHERE id_utilisateur=? AND id_histoire=?"; // Requête SQL
            $resultatProgr=$BDD->prepare($requete); // Preparation de la requête SQL
            $resultatProgr->execute(array($_SESSION["idUtil"], $_SESSION["idHist"])); // Execute la requête et récupère la ligne avec login et password égaux à ceux rentrés si elle existe
            $progressionHist=$resultatProgr->fetch();

            if($resultatProgr->rowCount()==0){
                // Ajoute une ligne de progression pour l'histoire en question si l'utilisateur n'en a pas
                $requeteAjout="INSERT INTO progression (id_utilisateur,id_histoire,id_chapitre) VALUES (:id_utilisateur,:id_histoire,id_chapitre)";
                $resultatReq=$BDD->prepare($requeteAjout);
                $resultatReq->execute(array(
                    'id_utilisateur'=>$_SESSION["idUtil"],
                    'id_histoire'=>$_SESSION["idHist"],
                    'id_chapitre'=>1
                ));
                // Rajoute +1 au nombre de lecture de l'histoire pour les statistiques
                $reqLecture="INSERT INTO histoire (nb_lecture) VALUES (:plusUn)";
                $resultatReq=$BDD->prepare($reqLecture);
                $resultatReq->execute(array('plusUn'=>$histoire["nb_lecture"]+1));
                $chapitreActuel=1;
            }
            else{
                $chapitreActuel=$progressionHist["id_chapitre"];
            }
            
            // Récupère les données du chapitre en cours de lecture
            $reqChap="SELECT * FROM chapitre WHERE id_histoire=? AND num_chapitre=?";
            $resReqChap=$BDD->prepare($reqChap);
            $resReqChap->execute(array($_SESSION["idHist"],$chapitreActuel));
            $chapitre= $resReqChap->fetch();

            // Récupère les choix possibles liés au chapitre
            $reqChoix="SELECT * FROM choix WHERE id_chapitre=?";
            $resReqChoix=$BDD->prepare($reqChoix);
            $resReqChoix->execute(array($chapitre["id"]));
            $choix= $resReqChoix->fetchAll();
        }?>
        <h1 class="centre"><?=$_SESSION["titre"] ?></h1>
        <div class="centre">
            <?=$chapitre["contenu"]?>
        </div>
        
        
        
        <?php include "includes/footer.php"; ?>
    </body>
</html>