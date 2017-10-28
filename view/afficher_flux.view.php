<html>
<head>
<title>Flux RSS</title>
<meta charset="UTF-8"/>
<meta http-equiv="content-type" content="text/html;" />
</head>

<body>
    <?php foreach($fluxs as $f) { ?>
    <p>
        <?php echo $f->getTitre();?>
        <a href="afficher_nouvelles.ctrl.php?fluxId=<?php echo $f->getId();?>">Affichage textuel</a>
        <a href="afficher_nouvelles_img.ctrl.php?fluxId=<?php echo $f->getId();?>">Grille d'images</a>
    </p>
    <?php } ?>
</body>
</html>