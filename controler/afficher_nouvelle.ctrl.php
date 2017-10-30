<?php
    require_once('../model/DAO.class.php');
    
    $rss = new DAO();

    // Récupération de l'identifiant de la nouvelle
    if (isset($_GET['nouvelleId'])) { 
        $nouvelleId = $_GET['nouvelleId'];
    }

    // Récupération de l'identifiant du flux
    if (isset($_GET['fluxId'])) {
        $fluxId = $_GET['fluxId'];
    }

    // Récupération du mode d'affichage pour la navigation
    if (isset($_GET['mode'])) {
        $mode = $_GET['mode'];
    }
    
    // Récupère les informations de la nouvelle et l'envoie dans un flux;
    $nouvelle = $rss->lireNouvelle($nouvelleId, $fluxId);

    include("../view/afficher_nouvelle.view.php");

?>