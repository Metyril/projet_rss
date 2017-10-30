<?php
    require_once('../model/DAO.class.php');
    $dao = new DAO();

    //$dao->reinit();   // Réinitialisation de la base en cas de problème

    // Ajout d'un flux par URL et vérification de sa validité
    if(isset($_GET['addFlux']) && substr($_GET['addFlux'], 0, 22) == "http://www.lemonde.fr/" && substr($_GET['addFlux'], -4, 4) == ".xml") {
        $addFlux = $dao->createRSS($_GET['addFlux']);
        $addFlux->update();
        $dao->updateRSS($addFlux);

        foreach($addFlux->getNouvelles() as $n) {
            $dao->createNouvelle($n, $addFlux->getId());
            $dao->updateNouvelle($n, $addFlux->getId());
        }
        $url = $dao->listeUrl();
    } else if(isset($_GET['addFlux'])) {    // Envoi d'une erreur à l'utilisateur pour les liens non valides
        echo "/!\ Cette adresse n'est pas valide.";
    }

    // Supression d'un flux passé en paramètre, ainsi que de ses nouvelles et leurs images associées
    if(isset($_GET['deleteFlux'])) {
        foreach(glob("../model/images/flux".$_GET['deleteFlux']."_*.jpg") as $imgPath) {
            unlink($imgPath);
        }

        $dao->deleteListeNouvelles($_GET['deleteFlux']);
        $dao->deleteRSS($_GET['deleteFlux']);
        $url = $dao->listeUrl();
    }

    // Vide un flux passé en paramètre et ne conserve que les dernières nouvelles et images
    if(isset($_GET['emptyFlux'])) {
        $dao->deleteListeNouvelles($_GET['emptyFlux']);
        foreach(glob("../model/images/flux".$_GET['deleteFlux']."_*.jpg") as $imgPath) {
            unlink($imgPath);
        }

        $emptyFlux = $dao->lireRSS($_GET['emptyFlux']);
        $emptyFlux->update();
        $dao->updateRSS($emptyFlux);

        foreach($emptyFlux->getNouvelles() as $n) {
            $dao->createNouvelle($n, $emptyFlux->getId());
            $dao->updateNouvelle($n, $emptyFlux->getId());
        }
    }

    // Mise à jour des nouvelles d'un flux passé en paramètre
    if(isset($_GET['updateFlux'])) {
        $updateFlux = $dao->lireRSS($_GET['updateFlux']);
        $updateFlux->update();
        $dao->updateRSS($updateFlux);

        foreach($updateFlux->getNouvelles() as $n) {
            $dao->createNouvelle($n, $updateFlux->getId());
            $dao->updateNouvelle($n, $updateFlux->getId());
        }
    }

    // Récupération des fluxs existants dans la base
    $url = $dao->listeUrl();
    if($url == NULL) {      // S'il n'y a pas de fluxs préexistants, on en crée un par défaut
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

    // Récupération des fluxs RSS et envoie à la vue
    foreach($url as $u) {
        $fluxs[] = $dao->readRSSfromURL($u);
    }

include("../view/afficher_flux.view.php");

?>