<html>
<head>
<title>Flux RSS</title>
<meta charset="UTF-8"/>
<meta http-equiv="content-type" content="text/html;" />
<link rel="stylesheet" href="../view/afficher_nouvelle.css"/>
</head>

<body>
    <header>
        <h1>Flux RSS</h1>
    </header>

    <h2>Détails de la nouvelle</h2>
    <ul id="navigation">    <!-- Menu en fil d'ariane -->
        <li><a href="afficher_flux.ctrl.php" title="Liste des fluxs">Liste des fluxs</a></li>
        <li>→</li>
        <li><a href="afficher_nouvelles.ctrl.php?mode=<?php echo $mode?>&fluxId=<?php echo $fluxId?>" title="Liste des fluxs">Liste des nouvelles</a></li>
        <li>→</li>
        <li>Nouvelle</li>
    </ul>

    <!-- Affichage des éléments d'une nouvelle et accès à l'article correspondant -->
    <div>
        <img src=<?php echo $nouvelle->getUrlImage();?>>
        <p>
            <?php echo $nouvelle->getTitre();?> <br>
            <?php echo $nouvelle->getDate();?> <br>
            <?php echo $nouvelle->getDescription();?> <br>
        </p>
        <a href=<?php echo $nouvelle->getUrl();?>>Voir l'article en intégralité</a> <br>
    </div>
</body>
</html>