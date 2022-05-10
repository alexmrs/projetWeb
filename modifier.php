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
    <?php 
    
    if(isset($_GET["id"]))
    {
        $id=escape($_GET["id"]);
        $reqtitre="SELECT titre FROM histoire WHERE id=$id";
        $resReq=$BDD->prepare($reqtitre);
        $resReq->execute(array());
        $histoire=$resReq->fetch();
        $_SESSION["titre"]=$histoire["titre"];

        // Permet de récuperer les informations concernant tous les chapitres de la BDD
        $reqchap="SELECT id,num_chapitre,contenu,SUBSTRING(contenu,1,30) FROM chapitre WHERE id_histoire=$id";
        $resReqChap=$BDD->prepare($reqchap);
        $resReqChap->execute(array());
        $chapitre=$resReqChap->fetchAll();
    }

    // Permet de récuperer le contenu du chapitre sélectionné
    if(isset($_GET["idChap"]))//ça modif que le 1er chapitre, faire en sorte que ça modif le bon
    {
        $_SESSION["idChap"]=escape($_GET["idChap"]);
        $reqchap="SELECT id,num_chapitre,contenu,SUBSTRING(contenu,1,30) FROM chapitre WHERE id=?";
        $resReq=$BDD->prepare($reqchap);
        $resReq->execute(array($_SESSION["idChap"]));
        $chapSelect=$resReq->fetch();
    }
    else
    {   
        if(!isset($_POST["nv_contenu"])){ // Définit l'ID de chapitre si il n'y a pas de méthode POST appelée
            $_SESSION["idChap"]=$chapitre[0]["id"];
        }
    }

    if(isset($_POST["id_chapitre"])){}
    
    // Récupère les liens entre les chapitres
    $reqChoix="SELECT *, SUBSTRING(contenu_choix,1,30) FROM choix WHERE id_chapitre=?";
    $resChoix=$BDD->prepare($reqChoix);
    $resChoix->execute(array($_SESSION["idChap"]));
    $choixChap=$resChoix->fetchAll();

    // Modifie le contenu du chapitre
    if(isset($_POST["nv_contenu"]) and $_POST["nv_contenu"]!="") // Pas super efficace car modif la BDD dès qu'un texte est écrit
    {
        $nvContenu=escape($_POST["nv_contenu"]);
        $reqModif="UPDATE chapitre SET contenu=? WHERE id=?";
        $resModif=$BDD->prepare($reqModif);
        $resModif->execute(array($nvContenu,$_SESSION["idChap"]));
    }

    // Modifie le contenu du choix
    if(isset($_POST["contenu_choix"]) and isset($_POST["choixArr"])) {
        $contenuChoix=escape($_POST["contenu_choix"]);
        $chapVise=escape($_POST["choixArr"]);
        if($_POST["contenu_choix"]!="")
        {
            $reqModifChoix="UPDATE choix SET contenu_choix=? WHERE id_chapitre=? AND id_chapitre_vise=? ";
            $resModifChoix=$BDD->prepare($reqModifChoix);
            $resModifChoix->execute(array($contenuChoix,$_SESSION["idChap"],$chapVise));
        }
        if($_POST["changerArr"]=="oui"){
            $chapArr=escape($_POST["chapArr"]);
            $reqModifChoix="UPDATE choix SET id_chapitre_vise=? WHERE id_chapitre=? AND id_chapitre_vise=? ";
            $resModifChoix=$BDD->prepare($reqModifChoix);
            $resModifChoix->execute(array($chapArr,$_SESSION["idChap"],$chapVise)); 
        }
    }   

    ?>
    <body>
       <div class="modifHist">
            <h2>Modifier <?=$_SESSION["titre"] ?></h2>
            <br/>
            <br/>
            <h3>Modifier un chapitre</h3>
            <br/>
            <form action="modifier.php?id=<?=$id ?>&<?=$_SESSION["idChap"]?>" method="post" class="form_creation">
                <div class="mb-3">
                    <br>
                    <label for="chapitre" class="form-label">Chapitre à modifier</label>

                    <select id="chapitre" name="chapitre" onchange="location = this.value;" > <!-- onchange="location = this.value;" permet d'envoyer sur la page liée au chapitre sélectionné -->
                        <?php
                            foreach($chapitre as $key =>$ligne){ ?>
                                <option <?php if(isset($_GET["idChap"]) and $chapSelect["id"]==$ligne["id"]){?> selected <?php ;} ?> value="modifier.php?id=<?=$id ?>&idChap=<?=$ligne["id"] ?>"><?=$ligne["num_chapitre"] ?>-<?=$ligne["SUBSTRING(contenu,1,30)"] ?>...</option>
                            <?php }
                        ?>
                    </select>
                    <br/>
                    <br/>
                    <label for="nv_contenu" class="form-label">Nouveau Contenu du chapitre</label>
                    <textarea class="form-control" id="nv_contenu" name="nv_contenu" rows="7" cols="80"><?php if(isset($_GET["idChap"])){ echo $chapSelect["contenu"];}else{ echo $chapitre[0]["contenu"];}?></textarea>
                    <br/>
                    
                    <br/>
                    <h3>Modifier les liens  existants entre les chapitres</h3>
                    <br/>
                    <span>Le chapitre <?=$_SESSION["idChap"] ?> donne sur les chapitres <?php foreach($choixChap as $key=>$choix){?><?=$choix["id_chapitre_vise"];?> <?php } ?></span>
                    <br/>
                    <h4>Choisir le choix à modifier</h4>
                    <fieldset>
                        <?php foreach($choixChap as $key=>$ligne){?>
                            <input type="radio" name="choixArr" value="<?=$ligne["id_chapitre_vise"] ?>">
                            <label><?=$ligne["contenu_choix"] ?></label>
                            <br/>
                        <?php } ?>
                    
                        <br/>
                        <label for="contenu_choix" class="form-label">Nouveau contenu du choix</label>
                        <textarea class="form-control" id="contenu_choix" name="contenu_choix" rows="5" cols="80"></textarea>
                        <br/>
                        <h5>Modifier le chapitre d'arrivée du choix ?</h5>
                        <br/>
                        <input type="radio" name="changerArr" value="oui">
                        <label>Oui</label>
                        <input type="radio" name="changerArr" value="non" checked>
                        <label>Non</label>
                        <select id="chapArr" name="chapArr" >
                        <?php
                            foreach($chapitre as $key =>$ligne){ ?>
                                <option value="<?=$ligne["id"] ?>"><?=$ligne["num_chapitre"] ?>-<?=$ligne["SUBSTRING(contenu,1,30)"] ?>...</option>
                            <?php }
                        ?>
                        </select>
                    </fieldset>
                    <br/>

                </div>
                <div>
                    <button type="submit" class="btn btn-info"> Modifier </button>
                </div>
            </form>
            <br/>
            <br/>
            <br/>
            <br/>
            <br/>
            <br/>
        </div>
       
        <?php include "includes/footer.php"; ?>
    </body>
</html>