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


    <form action ="super_bien.php", class = "formulair">
      <textarea name = "search"></textarea>
      <input type = "submit" value = "Rechercher"  />
    </form>


    <?php foreach($listeNouvelles as $nouvelles) {
        if (isset($_POST['search'])){
          if(strstr($nouvelles->getTitre()),$_POST['search']){?>
            <a href="afficher_nouvelle.ctrl.php?mode=<?php echo $mode?>&fluxId=<?php echo $fluxId?>&nouvelleId=<?php echo $nouvelles->getId();?>"><?php echo $nouvelles->getTitre();?></a> <br>
    <?php
          }
        } else {
          ?>
            <a href="afficher_nouvelle.ctrl.php?mode=<?php echo $mode?>&fluxId=<?php echo $fluxId?>&nouvelleId=<?php echo $nouvelles->getId();?>"><?php echo $nouvelles->getTitre();?></a> <br>
          <?php
        }
      }
      if (count($listeNouvelles) == 0){
        echo "<p> Aucune nouvelle ne correspond au critère de recherche ... </p>"
      } ?>
</body>
</html>
