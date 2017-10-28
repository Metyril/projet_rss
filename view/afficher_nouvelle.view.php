<html>
<head>
<title>Flux RSS</title>
<meta charset="UTF-8"/>
<meta http-equiv="content-type" content="text/html;" />
</head>

<body>
    <img src=<?php echo $nouvelle->getUrlImage();?>>
    <p>
        <?php echo $nouvelle->getTitre();?> <br>
        <?php echo $nouvelle->getDate();?> <br>
        <?php echo $nouvelle->getDescription();?> <br>
        <a href=<?php echo $nouvelle->getUrl();?>>Voir l'article entier</a> <br>
    </p>
</body>
</html>