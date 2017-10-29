<html>
<head>
<title>Flux RSS</title>
<meta charset="UTF-8"/>
<meta http-equiv="content-type" content="text/html;" />
</head>

<body>
    <ul id="navigation">
        <li><a href="afficher_flux.ctrl.php" title="Liste des fluxs">Liste des fluxs</a></li>
        <li><a href="afficher_nouvelles.ctrl.php?mode=<?php echo $mode?>&fluxId=<?php echo $fluxId?>" title="Liste des fluxs">Liste des nouvelles</a></li>
        <li>Nouvelle</li>
    </ul>

    <img src=<?php echo $nouvelle->getUrlImage();?>>
    <p>
        <?php echo $nouvelle->getTitre();?> <br>
        <?php echo $nouvelle->getDate();?> <br>
        <?php echo $nouvelle->getDescription();?> <br>
        <a href=<?php echo $nouvelle->getUrl();?>>Voir l'article entier</a> <br>
    </p>
</body>
</html>