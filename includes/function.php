<?php

// Vérifie si l'utilisateur est connecté
function UtilisateurConnecte() {
    return isset($_SESSION["pseudo"]);
}

// Verifie si l'utilisateur est un administrateur
function UtilisateurAdministrateur() {
    return $_SESSION["admin"]==1;
}

// Protection contre l'ajout de code non voulu
function escape($value) {
    return htmlspecialchars($value, ENT_QUOTES, 'UTF-8', false);
}

// Récupère l'histoire sélectionnée dans le formulaire de modification
function contenuChapSelect($ligne){
    $_SESSION["contenuChap"]=$ligne["contenu"];
}
?>