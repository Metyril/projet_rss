<?php
    require_once('../model/DAO.class.php');
    
    $rss = new DAO();

    if (isset($_GET['nouvelleId'])) { 
        $nouvelleId = $_GET['nouvelleId'];
    }
    if (isset($_GET['fluxId'])) {
        $fluxId = $_GET['fluxId'];
    }
    if (isset($_GET['mode'])) {
        $mode = $_GET['mode'];
    }
    
    $nouvelle = $rss->lireNouvelle($nouvelleId, $fluxId);

    include("../view/afficher_nouvelle.view.php");

?>