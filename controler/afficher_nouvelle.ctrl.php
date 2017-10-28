<?php
    require_once('../model/DAO.class.php');
    
    $rss = new DAO();

    if (isset($_GET['nouvelleId'])) { 
        $nouvelleId = $_GET['nouvelleId'];
    }
    
    $nouvelle = $rss->lireNouvelle($nouvelleId);

    include("../view/afficher_nouvelle.view.php");

?>