<?php
$host = "localhost";
$dbname = "storytime";
$username = "root";
$password = "root";

try { 
    $BDD = new PDO( "mysql:host=". $host .";dbname=". $dbname .";charset=utf8",
        $username,
        $password, 
        array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
}
catch (Exception $e) {
    die('Erreur fatale : ' . $e->getMessage());
}
?>