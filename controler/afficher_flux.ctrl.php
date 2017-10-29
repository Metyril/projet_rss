<?php
    require_once('../model/DAO.class.php');
    $dao = new DAO();

$url[] = "http://www.lemonde.fr/m-actu/rss_full.xml";
//$url[] = "http://www.lemonde.fr/rss/une.xml";
$url[] = "http://www.lemonde.fr/enseignement-superieur/rss_full.xml";

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