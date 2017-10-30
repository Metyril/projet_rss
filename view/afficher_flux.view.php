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

    <form>
        <fieldset>
            <legend>Controle des fluxs</legend>
            Ajouter un flux RSS (de la forme "http://www.lemonde.fr/[NOM_FLUX]/rss_full.xml":
            <input type="textfield" name="addFlux"/><br>
        </fieldset>
    </form> 

    <?php foreach($fluxs as $f) { ?>
    <p>
        <a href="afficher_nouvelles.ctrl.php?mode=text&fluxId=<?php echo $f->getId();?>"> <?php echo $f->getTitre();?></a>
        <a href="afficher_nouvelles.ctrl.php?mode=img&fluxId=<?php echo $f->getId();?>"><img src="http://icons.iconarchive.com/icons/tristan-edwards/sevenesque/1024/Preview-icon.png" height=25 width=25></a>
        Date de mise à jour : <?php echo $f->getDateMaj();?>
        <form>
            <input type="submit" value="Mettre à jour le flux"/>
            <input type="hidden" name="updateFlux" value="<?php echo $f->getId() ?>"/>
        </form>
        <form>
            <input type="submit" value="Vider le flux"/>
            <input type="hidden" name="emptyFlux" value="<?php echo $f->getId() ?>"/>
        </form>
        <form>
            <input type="submit" value="Supprimer le flux"/>
            <input type="hidden" name="deleteFlux" value="<?php echo $f->getId() ?>"/>
        </form> 
    </p>
    <?php } ?>
</body>
</html>