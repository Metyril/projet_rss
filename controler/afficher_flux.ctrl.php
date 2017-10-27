<?php
    require_once('../model/DAO.class.php');
    $dao = new DAO();

$url[] = "http://www.lemonde.fr/m-actu/rss_full.xml";
$url[] = "http://www.lemonde.fr/rss/une.xml";
foreach($url as $u) {
    $fluxs[] = $dao->createRSS($u);
}

include("../view/afficher_flux.view.php");

?>