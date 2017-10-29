<?php
    require_once('../model/DAO.class.php');
    $dao = new DAO();

    $url[] = "http://www.lemonde.fr/m-actu/rss_full.xml";
    //$url[] = "http://www.lemonde.fr/rss/une.xml";
    $url[] = "http://www.lemonde.fr/enseignement-superieur/rss_full.xml";

    if(isset($_GET['url']) && substr($_GET['url'], 0, 22) == "http://www.lemonde.fr/" && substr($_GET['url'], -13, 13)) {
        $url[] = $_GET['url'];
    } else if(isset($_GET['url'])) {
        echo "ERREUR";
    }

    $dao->reinit();

    $i = 1;
    foreach($url as $u) {
        $fluxs[$i] = $dao->createRSS($u);
        $fluxs[$i]->update();
        $dao->updateRSS($fluxs[$i]);
        foreach($fluxs[$i]->getNouvelles() as $n) {
            $dao->createNouvelle($n, $fluxs[$i]->getId());
            $dao->updateNouvelle($n, $fluxs[$i]->getId());
        }
        $i ++;
    }

include("../view/afficher_flux.view.php");

?>