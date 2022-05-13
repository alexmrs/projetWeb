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
    </head>
    <?php include "includes/header.php"; ?>

    <body>
        <?php 
        if(isset($_GET["titre"])){
            $_SESSION["titre"]=escape($_GET["titre"]);
            $requete="SELECT * FROM histoire WHERE titre=?"; // Requête SQL
            $resultatHist=$BDD->prepare($requete); // Preparation de la requête SQL
            $resultatHist->execute(array($_SESSION["titre"])); // Execute la requête 
            $histoire=$resultatHist->fetch();
            $_SESSION["idHist"]=$histoire["id"]; // Définit l'id de l'histoire entrain d'être lu
            

            // Modifie la progression de l'utilisateur
            if(isset($_GET["chapitre"])){
                $chapitre=escape($_GET["chapitre"]);
                $updateProgr="UPDATE progression SET id_chapitre=? WHERE id_utilisateur=? AND id_histoire=?";
                $resultatReq=$BDD->prepare($updateProgr);
                $resultatReq->execute(array(
                    $chapitre,
                    $_SESSION["idUtil"],
                    $_SESSION["idHist"]
                ));

            }

            $requete="SELECT * FROM progression WHERE id_utilisateur=? AND id_histoire=?"; // Requête SQL
            $resultatProgr=$BDD->prepare($requete); // Preparation de la requête SQL
            $resultatProgr->execute(array($_SESSION["idUtil"], $_SESSION["idHist"])); // Execute la requête et récupère la ligne avec login et password égaux à ceux rentrés si elle existe
            $progressionHist=$resultatProgr->fetch();

            if($resultatProgr->rowCount()==0){
                // Récupère l'id du premier chapitre de l'histoire
                $num_chapitre=1;
                $reqchapDebut="SELECT * FROM chapitre WHERE  num_chapitre=1 AND id_histoire=?";
                $reschapDebut=$BDD->prepare($reqchapDebut);
                $reschapDebut->execute(array($_SESSION["idHist"]));
                $idChapDebut=$reschapDebut->fetch();


                // Ajoute une ligne de progression pour l'histoire en question si l'utilisateur n'en a pas
                $requeteAjout="INSERT INTO progression (id_utilisateur,id_histoire,id_chapitre) VALUES (:id_utilisateur,:id_histoire,:id_chapitre)";
                $resultatReq=$BDD->prepare($requeteAjout);
                $resultatReq->execute(array(
                    'id_utilisateur'=>$_SESSION["idUtil"],
                    'id_histoire'=>$_SESSION["idHist"],
                    'id_chapitre'=>$idChapDebut["id"],
                ));

                // Rajoute +1 au nombre de lecture de l'histoire pour les statistiques
                $reqLecture="UPDATE histoire SET nb_lecture=? WHERE titre=?";
                $resultatReq=$BDD->prepare($reqLecture);
                $resultatReq->execute(array(
                    $histoire["nb_lecture"]+1,
                    $_SESSION["titre"]
                ));
                $chapitreActuel=$idChapDebut["id"];
            }
            else{   
                $chapitreActuel=$progressionHist["id_chapitre"];
            }

            // Récupère les données du chapitre en cours de lecture
            $reqChap="SELECT * FROM chapitre WHERE id_histoire=? AND id=?";
            $resReqChap=$BDD->prepare($reqChap);
            $resReqChap->execute(array($_SESSION["idHist"],$chapitreActuel));
            $chapitre= $resReqChap->fetch();
            // Récupère les choix possibles liés au chapitre
            $reqChoix="SELECT * FROM choix WHERE id_chapitre=?";
            $resReqChoix=$BDD->prepare($reqChoix);
            $resReqChoix->execute(array($chapitre["id"]));
            $choix= $resReqChoix->fetchAll(); 


            // Récupère le chemin effectué durant l'histoire
            $reqSupProgr="SELECT suivi_histoire FROM progression WHERE id_utilisateur=? AND id_histoire=?";
            $suivi=$BDD->prepare($reqSupProgr);
            $suivi->execute(array(
            $_SESSION["idUtil"],
            $_SESSION["idHist"]
            ));
            $suiviRes=$suivi->fetch();
                    
            // Met à jour le contenu du suivi
            $reqMajSuivi="UPDATE progression SET suivi_histoire=? WHERE id_utilisateur=? AND id_histoire=?";
            $resMajSuivi=$BDD->prepare($reqMajSuivi);
            $resMajSuivi->execute(array(
                $suiviRes["suivi_histoire"].$chapitre["contenu"]."->",
                $_SESSION["idUtil"],
                $_SESSION["idHist"]
            ));


        }?>
        
        <h2 class="centre"><?=$_SESSION["titre"] ?></h2>
        <br/>
        <br/>
        <div class="contenuChap">
            <?=$chapitre["contenu"]?>
        </div>
    </br>
        <div class="container">
            <?php
                foreach($choix as $key =>$ligne){ ?>
                    </br>
                    </br>
                    <a class="btn btn-primary btn-success" href="chapitre.php?titre=<?=$_SESSION["titre"]?>&chapitre=<?=$ligne["id_chapitre_vise"]?>" ><?=$ligne["contenu_choix"]?> </a>
            <?php
                } 
                // Lorsqu'un chapitre est perdant ou gagnant dans une histoire
                if($chapitre["gagnant_perdant"]==2 or $chapitre["gagnant_perdant"]==1){?>
                    <div class="centre">
                    <?php // Récupère le chemin effectué durant l'histoire
                        $reqSupProgr="SELECT suivi_histoire FROM progression WHERE id_utilisateur=? AND id_histoire=?";
                        $suivi=$BDD->prepare($reqSupProgr);
                        $suivi->execute(array(
                        $_SESSION["idUtil"],
                        $_SESSION["idHist"]
                        ));
                        $suiviRes=$suivi->fetch(); 
                    ?>
                    <p> Voici ton histoire : </p>
                    <?=$suiviRes["suivi_histoire"] ?>
                    <p>L'histoire est terminé pour vous, vous pouvez la recommencer</p>
                    <?php // Suppression de la progression pour que l'utilisateur puisse recommencer l'histoire
                    $reqSupProgr="DELETE FROM progression WHERE id_utilisateur=? AND id_histoire=?";
                    $suppr=$BDD->prepare($reqSupProgr);
                    $suppr->execute(array(
                    $_SESSION["idUtil"],
                    $_SESSION["idHist"]
                    ));
                    if($chapitre["gagnant_perdant"]==2){
                        $reqLecture="UPDATE histoire SET nb_perdu=? WHERE titre=?";
                        $resultatReq=$BDD->prepare($reqLecture);
                        $resultatReq->execute(array(
                        $histoire["nb_perdu"]+1,
                        $_SESSION["titre"]
                        ));
                    }
                    if($chapitre["gagnant_perdant"]==1){
                        $reqLecture="UPDATE histoire SET nb_gagne=? WHERE titre=?";
                        $resultatReq=$BDD->prepare($reqLecture);
                        $resultatReq->execute(array(
                        $histoire["nb_gagne"]+1,
                        $_SESSION["titre"]
                        ));
                    }?>

                    <!-- Bouton qui renvoie au premier chapitre de l'histoire  -->
                    <a class="btn btn-secondary" href="chapitre.php?titre=<?=$_SESSION["titre"]?>">Rejouer</a>

                    <!-- Bouton qui renvoie à la page index  -->
                    <a class="btn btn-secondary centre" href="index.php">Revenir à l'acceuil</a>
                    </div>
                <?php
                }
            ?>
            
        </div>
        <?php include "includes/footer.php"; ?>
    </body>
</html>