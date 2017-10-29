<html>
<head>
<title>Flux RSS</title>
<meta charset="UTF-8"/>
<meta http-equiv="content-type" content="text/html;" />
</head>

<body>
    <ul id="navigation">
        <li><a href="afficher_flux.ctrl.php" title="Liste des fluxs">Liste des fluxs</a></li>
        <li>Liste des nouvelles</li>
    </ul>


    <form action ="afficher_nouvelles.ctrl.php", class = "formulair">
        Chercher un mot-clé :
        <input type="hidden" name="mode" value="<?php echo $mode?>"/>
        <input type="hidden" name="fluxId" value="<?php echo $fluxId?>"/>
        <input type="textfield" name="search"/>
        <input type = "submit" value = "Rechercher"  />
    </form>


    <?php foreach($listeNouvelles as $nouvelles) {
        if (isset($_GET['search']) && $_GET['search'] !== ''){
          if(strstr(strtolower($nouvelles->getTitre()),strtolower($_GET['search']))){?>
            <a href="afficher_nouvelle.ctrl.php?mode=<?php echo $mode?>&fluxId=<?php echo $fluxId?>&nouvelleId=<?php echo $nouvelles->getId();?>"><?php echo $nouvelles->getTitre();?></a> <br>
    <?php
          }
        } else {
          ?>
            <a href="afficher_nouvelle.ctrl.php?mode=<?php echo $mode?>&fluxId=<?php echo $fluxId?>&nouvelleId=<?php echo $nouvelles->getId();?>"><?php echo $nouvelles->getTitre();?></a> <br>
          <?php
        }
      }
    ?>
</body>
</html>
