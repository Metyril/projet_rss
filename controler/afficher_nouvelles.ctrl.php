<?php
    require_once('../model/DAO.class.php');
    
    $rss = new DAO();

    if (isset($_GET['fluxId'])) { 
        $fluxId = $_GET['fluxId'];
    }
    if (isset($_GET['mode'])) {
        $mode = $_GET['mode'];
        var_dump($mode);
    }
    
    $listeNouvelles = $rss->listeNouvelles($fluxId);

    if ($mode == "text") {
        include("../view/afficher_nouvelles.view.php");
    } else if ($mode == "img") {
        include("../view/afficher_nouvelles_img.view.php");
    }

?>