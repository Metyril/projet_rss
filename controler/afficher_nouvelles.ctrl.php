<?php

    // Ce contrôleur regroupe afficher_nouvelles et afficher nouvelles_img

    require_once('../model/DAO.class.php');
    
    $rss = new DAO();

    // Récupération du flux
    if (isset($_GET['fluxId'])) { 
        $fluxId = $_GET['fluxId'];
    }

    // Choix de l'affichage textuel ou de la grille d'images
    if (isset($_GET['mode'])) {
        $mode = $_GET['mode'];
    }
    
    // Récupération des nouvelles d'un flux et envoie à la vue choisie
    $listeNouvelles = $rss->listeNouvelles($fluxId);

    if ($mode == "text") {
        include("../view/afficher_nouvelles.view.php");
    } else if ($mode == "img") {
        include("../view/afficher_nouvelles_img.view.php");
    }

?>