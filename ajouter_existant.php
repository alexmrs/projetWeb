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
    if(isset($_GET["idChap"]))
    {
        $_SESSION["idChap"]=escape($_GET["idChap"]);
        $reqchap="SELECT id,num_chapitre,contenu,SUBSTRING(contenu,1,30) FROM chapitre WHERE id=?";
        $resReq=$BDD->prepare($reqchap);
        $resReq->execute(array($_SESSION["idChap"]));
        $chapSelect=$resReq->fetch();

    }
    else
    {   
        $_SESSION["idChap"]=$chapitre[0]["id"]; // je viens de découvrir ça et je suis triste de pas y avoir pensé avant
    }
    
    // Récupère les liens entre les chapitres
    $reqChoix="SELECT * FROM choix WHERE id_chapitre=?";
    $resChoix=$BDD->prepare($reqChoix);
    $resChoix->execute(array($_SESSION["idChap"]));
    $choixChap=$resChoix->fetchAll();

    ?>
    <body>
       <div class="centre">
            <h2>Modifier <?=$_SESSION["titre"] ?></h2>
            <br/>
            <br/>
            <h3>Modifier un chapitre</h3>
            <br/>
            <form action="modifier.php?id=<?=$id ?>&<?=$_SESSION["idChap"]?>" method="post" class="form">
                <div class="mb-3">
                    <br>
                    <label for="chapitre" class="form-label">Chapitre à Ajouter</label>
                    <br/>
                    <br/>
                    <label for="nv_contenu" class="form-label">Nouveau Contenu du chapitre</label>
                    <textarea class="form-control" id="nv_contenu" name="nv_contenu" rows="7" cols="80"><?php if(isset($_GET["idChap"])){ echo $chapSelect["contenu"];}?></textarea>
                    <br/>
                    
                    <br/>
                    <h3>Ajouter des liens entre les chapitres existants</h3>
                    <br/>
                    <span>Le chapitre <?=$_SESSION["idChap"] ?> donne sur les chapitres <?php foreach($choixChap as $key=>$choix){?><?=$choix["id_chapitre_vise"];?> <?php } ?></span>
                    <br/>
                    <br/>
                    <label for="choixDep" class="form-label">Chapitre de départ : </label>
                    <select id="chapitre" name="choixDep"> <!-- onchange="location = this.value;" permet d'envoyer sur la page liée au chapitre sélectionné -->
                        <?php
                            foreach($chapitre as $key =>$ligne){ ?>
                                <option <?php if(isset($_GET["idChap"]) and $chapSelect["id"]==$ligne["id"]){?> selected <?php ;} ?> value="<?=$ligne["id"] ?>"><?=$ligne["num_chapitre"] ?>-<?=$ligne["SUBSTRING(contenu,1,30)"] ?>...</option>
                            <?php }
                        ?>
                    </select>
                    <br/>
                    <label for="contenu_choix" class="form-label">Contenu du choix</label>
                    <textarea class="form-control" id="nv_contenu" name="nv_contenu" rows="2" cols="80"><?php if(isset($_GET["idChap"])){ echo $chapSelect["contenu"];}?></textarea>
                    <br/>
                    <label for="choixArr" class="form-label">vers Chapitre d'arrivée : </label>
                    <select id="choixArr" name="choixArr"> <!-- onchange="location = this.value;" permet d'envoyer sur la page liée au chapitre sélectionné -->
                        <?php
                            foreach($chapitre as $key =>$ligne){ ?>
                                <option value="<?=$ligne["id"] ?>"><?=$ligne["num_chapitre"] ?>-<?=$ligne["SUBSTRING(contenu,1,30)"] ?>...</option>
                            <?php }
                        ?>
                    </select>
                </div>
                <div>
                    <button type="submit" class="btn btn-info"> Modifier </button>
                </div>
            </form>
       </div>
       <br/>
       <br/>
       <br/>
       <br/>
       <br/>
       <br/>
        <?php include "includes/footer.php"; ?>
    </body>
</html>