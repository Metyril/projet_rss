<html>
<head>
<title>Flux RSS</title>
<meta charset="UTF-8"/>
<meta http-equiv="content-type" content="text/html;" />
</head>

<body>
    <?php foreach($listeNouvelles as $nouvelles) { ?>
        <a href="afficher_nouvelle.ctrl.php?nouvelleId=<?php echo $nouvelles->getId();?>"><img src=<?php echo $nouvelles->getUrlImage();?>></a>
    <?php } ?>
</body>
</html>