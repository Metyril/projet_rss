<?php
    require_once('../model/DAO.class.php');
    $dao = new DAO();

    //$url[] = "http://www.lemonde.fr/m-actu/rss_full.xml";
    //$url[] = "http://www.lemonde.fr/rss/une.xml";
    //$url[] = "http://www.lemonde.fr/enseignement-superieur/rss_full.xml";

    //$dao->reinit();    

    $url = $dao->listeUrl();
    if($url == NULL) {
        $url = "http://www.lemonde.fr/rss/une.xml";
        $addFlux = $dao->createRSS($url);
        $addFlux->update();
        $dao->updateRSS($addFlux);
        foreach($addFlux->getNouvelles() as $n) {
            $dao->createNouvelle($n, $addFlux->getId());
            $dao->updateNouvelle($n, $addFlux->getId());
        }
        $url = $dao->listeUrl();
    }

    if(isset($_GET['addFlux']) && substr($_GET['addFlux'], 0, 22) == "http://www.lemonde.fr/" && substr($_GET['addFlux'], -13, 13) == "/rss_full.xml") {
        //$url[] = $_GET['addFlux'];
        $addFlux = $dao->createRSS($_GET['addFlux']);
        $addFlux->update();
        $dao->updateRSS($addFlux);
        foreach($addFlux->getNouvelles() as $n) {
            $dao->createNouvelle($n, $addFlux->getId());
            $dao->updateNouvelle($n, $addFlux->getId());
        }
        $url = $dao->listeUrl();
    } else if(isset($_GET['addFlux'])) {
        echo "ERREUR";
    }

    if(isset($_GET['deleteFlux'])) {
        $dao->deleteListeNouvelles($_GET['deleteFlux']);
        $dao->deleteRSS($_GET['deleteFlux']);
        //unset($url[$_GET['deleteFlux']-1]);
        $url = $dao->listeUrl();
    }

    if(isset($_GET['emptyFlux'])) {
        $dao->deleteListeNouvelles($_GET['emptyFlux']);
        $emptyFlux = $dao->lireRSS($_GET['emptyFlux']);
        $emptyFlux->update();
        $dao->updateRSS($emptyFlux);
        //var_dump($updateFlux);
        foreach($emptyFlux->getNouvelles() as $n) {
            $dao->createNouvelle($n, $emptyFlux->getId());
            $dao->updateNouvelle($n, $emptyFlux->getId());
        }
    }

    if(isset($_GET['updateFlux'])) {
        $updateFlux = $dao->lireRSS($_GET['updateFlux']);
        $updateFlux->update();
        $dao->updateRSS($updateFlux);
        foreach($updateFlux->getNouvelles() as $n) {
            $dao->createNouvelle($n, $updateFlux->getId());
            $dao->updateNouvelle($n, $updateFlux->getId());
        }
    }

    $i = 1;
    foreach($url as $u) {
        /*$fluxs[$i] = $dao->createRSS($u);
        $fluxs[$i]->update();
        $dao->updateRSS($fluxs[$i]);
        foreach($fluxs[$i]->getNouvelles() as $n) {
            $dao->createNouvelle($n, $fluxs[$i]->getId());
            $dao->updateNouvelle($n, $fluxs[$i]->getId());
        }*/
        $fluxs[$i] = $dao->readRSSfromURL($u);
        $i ++;
    }

include("../view/afficher_flux.view.php");

?>