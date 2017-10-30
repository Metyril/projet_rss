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

    <ul id="navigation">    <!-- Menu en fil d'ariane -->
        <li>Liste des fluxs</li>
    </ul>

    <form>      <!-- Formulaire d'ajout de flux -->
        <fieldset>
            <legend>Vous souhaitez ajouter de nouveaux fluxs?</legend>
            Entrez vos fluxs RSS préférés (liste des fluxs disponibles <a href="http://www.lemonde.fr/rss/">ici</a>):
            <input type="textfield" name="addFlux"/>
            <input type="submit" value="Ajouter"/>
        </fieldset>
    </form> 

    <?php foreach($fluxs as $f) {       // Affichage des fluxs, d'une icône pour accéder à leur galerie et leur date de mise à jour
    ?>
    <p>
        <a href="afficher_nouvelles.ctrl.php?mode=text&fluxId=<?php echo $f->getId();?>"> <?php echo $f->getTitre();?></a>
        <a href="afficher_nouvelles.ctrl.php?mode=img&fluxId=<?php echo $f->getId();?>"><img src="http://icons.iconarchive.com/icons/tristan-edwards/sevenesque/1024/Preview-icon.png" height=25 width=25></a>
        Date de mise à jour : <?php echo $f->getDateMaj();?>

        <form>      <!-- Bouton de mise à jour de flux -->
            <input type="submit" value="Mettre à jour le flux"/>
            <input type="hidden" name="updateFlux" value="<?php echo $f->getId() ?>"/>
        </form>

        <form>      <!-- Bouton de vidage de flux -->
            <input type="submit" value="Vider le flux"/>
            <input type="hidden" name="emptyFlux" value="<?php echo $f->getId() ?>"/>
        </form>

        <form>      <!-- Bouton de suppression de flux -->
            <input type="submit" value="Supprimer le flux"/>
            <input type="hidden" name="deleteFlux" value="<?php echo $f->getId() ?>"/>
        </form> 
    </p>
    <?php } ?>
</body>
</html>