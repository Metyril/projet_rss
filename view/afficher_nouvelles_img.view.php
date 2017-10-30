<html>
<head>
<title>Flux RSS</title>
<meta charset="UTF-8"/>
<meta http-equiv="content-type" content="text/html;" />
<link rel="stylesheet" href="../view/afficher_nouvelles_img.css"/>
</head>

<body>
    <header>
        <h1>Flux RSS</h1>
    </header>

    <h2>Liste des nouvelles (Grille d'images)</h2>
    <ul id="navigation">    <!-- Menu en fil d'ariane -->
        <li><a href="afficher_flux.ctrl.php" title="Liste des fluxs">Liste des fluxs</a></li>
        <li>→</li>
        <li>Liste des nouvelles</li>
    </ul>

    <div>
        <?php foreach($listeNouvelles as $nouvelles) {      // Affichage des images des nouvelles d'un flux
        ?>
            <a href="afficher_nouvelle.ctrl.php?mode=<?php echo $mode?>&fluxId=<?php echo $fluxId?>&nouvelleId=<?php echo $nouvelles->getId();?>"><img src=<?php echo $nouvelles->getUrlImage();?>></a>
        <?php } ?>
    </div>
</body>
</html>