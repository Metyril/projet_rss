<html>
<head>
<title>Flux RSS</title>
<meta charset="UTF-8"/>
<meta http-equiv="content-type" content="text/html;" />
</head>

<body>
    <header>
        <h1>Acceuil</h1>
    </header>

    <ul id="navigation">
        <li>Liste des fluxs</li>
    </ul>

    <?php foreach($fluxs as $f) { ?>
    <p>
        <?php echo $f->getTitre();?>
        <a href="afficher_nouvelles.ctrl.php?mode=text&fluxId=<?php echo $f->getId();?>">Affichage textuel</a>
        <a href="afficher_nouvelles.ctrl.php?mode=img&fluxId=<?php echo $f->getId();?>">Grille d'images</a>
    </p>
    <?php } ?>
</body>
</html>