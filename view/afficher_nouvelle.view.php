<html>
<head>
<title>Flux RSS</title>
<meta charset="UTF-8"/>
<meta http-equiv="content-type" content="text/html;" />
</head>

<body>
    <header>
        <h1>Détails de la nouvelle</h1>
    </header>

    <ul id="navigation">    <!-- Menu en fil d'ariane -->
        <li><a href="afficher_flux.ctrl.php" title="Liste des fluxs">Liste des fluxs</a></li>
        <li><a href="afficher_nouvelles.ctrl.php?mode=<?php echo $mode?>&fluxId=<?php echo $fluxId?>" title="Liste des fluxs">Liste des nouvelles</a></li>
        <li>Nouvelle</li>
    </ul>

    <!-- Affichage des éléments d'une nouvelle et accès à l'article correspondant -->
    <p>
        <img src=<?php echo $nouvelle->getUrlImage();?>>
        <?php echo $nouvelle->getTitre();?> <br>
        <?php echo $nouvelle->getDate();?> <br>
        <?php echo $nouvelle->getDescription();?> <br>
        <a href=<?php echo $nouvelle->getUrl();?>>Voir l'article en intégralité</a> <br>
    </p>
</body>
</html>