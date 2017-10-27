<?php
    include_once("../model/DAO.class.php");
    
    $rss = new DAO("../model/data");

    if (isset($_GET['fluxId'])) { 
        $flux = $_GET['fluxId'];
    }

    foreach($titre as $t) {
        $flux->
    }