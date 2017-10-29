<html>
<head>
<title>Flux RSS</title>
<meta charset="UTF-8"/>
<meta http-equiv="content-type" content="text/html;" />
</head>

<body>
    <ul id="navigation">
        <li><a href="afficher_flux.ctrl.php" title="Liste des fluxs">Liste des fluxs</a></li>
        <li>Liste des nouvelles</li>
    </ul>

    <?php foreach($listeNouvelles as $nouvelles) { ?>
        <a href="afficher_nouvelle.ctrl.php?mode=<?php echo $mode?>&fluxId=<?php echo $fluxId?>&nouvelleId=<?php echo $nouvelles->getId();?>"><?php echo $nouvelles->getTitre();?></a> <br>
    <?php } ?>
</body>
</html>