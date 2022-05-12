<?php include("includes/function.php");
require_once("includes/connect.php"); 
session_start();
?>
<?php

// Récupère l'url
if(isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on')
{
    $url = "https";
}
else
{
    $url = "http"; 
}  
$url .= "://"; 
$url .= $_SERVER['HTTP_HOST']; 
$url .= $_SERVER['PHP_SELF']; 
$newUrl= rtrim($url,"recommencer_histoire.php");
echo $newUrl;

if(isset($_GET["id"]) and isset($_GET["titre"])){
    $id=escape($_GET["id"]);
    $titre=escape($_GET["titre"]);
    // Suppression de la progression pour que l'utilisateur puisse recommencer l'histoire
    $reqSupProgr="DELETE FROM progression WHERE id_utilisateur=? AND id_histoire=?";
    $suppr=$BDD->prepare($reqSupProgr);
    $suppr->execute(array(
    $_SESSION["idUtil"],
    $id
    )); 
    echo "Location:".$newUrl."chapitre.php?titre=".$titre;
    header("Location:".$newUrl."chapitre.php?titre=".$titre);
}
?>