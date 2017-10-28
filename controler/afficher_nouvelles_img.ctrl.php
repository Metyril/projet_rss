<?php
    require_once('../model/DAO.class.php');
    
    $rss = new DAO();

    if (isset($_GET['fluxId'])) { 
        $fluxId = $_GET['fluxId'];
    }
    
    $listeNouvelles = $rss->listeNouvelles($fluxId);

    include("../view/afficher_nouvelles_img.view.php");

?>