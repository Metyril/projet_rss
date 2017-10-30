<html>
<head>
<title>Flux RSS</title>
<meta charset="UTF-8"/>
<meta http-equiv="content-type" content="text/html;" />
<link rel="stylesheet" href="../view/afficher_nouvelles.css"/>
</head>

<body>
    <header>
        <h1>Flux RSS</h1>
    </header>

    <h2>Liste des nouvelles (Affichage textuel)</h2>
    <ul id="navigation">      <!-- Menu en fil d'ariane -->
        <li><a href="afficher_flux.ctrl.php" title="Liste des fluxs">Liste des fluxs</a></li>
        <li>→</li>
        <li>Liste des nouvelles</li>
    </ul>


    <form action ="afficher_nouvelles.ctrl.php">    <!-- Formulaire de recherche séquentiel -->
        Chercher un mot-clé :
        <input type="hidden" name="mode" value="<?php echo $mode?>"/>
        <input type="hidden" name="fluxId" value="<?php echo $fluxId?>"/>
        <input type="search" name="search"/>
        <input type="submit" value="Rechercher"/>
    </form>


    <?php foreach($listeNouvelles as $nouvelles) {
        if (isset($_GET['search']) && $_GET['search'] !== ''){
          if(strstr(strtolower($nouvelles->getTitre()),strtolower($_GET['search']))){   // Affichage des nouvelles qui contiennent la recherche
    ?>
            <a href="afficher_nouvelle.ctrl.php?mode=<?php echo $mode?>&fluxId=<?php echo $fluxId?>&nouvelleId=<?php echo $nouvelles->getId();?>"><?php echo $nouvelles->getTitre();?></a> <br>
    <?php
          }
        } else {    // Affichage de toutes les nouvelles
    ?>
            <a href="afficher_nouvelle.ctrl.php?mode=<?php echo $mode?>&fluxId=<?php echo $fluxId?>&nouvelleId=<?php echo $nouvelles->getId();?>"><?php echo $nouvelles->getTitre();?></a> <br>
    <?php
        }
      }
    ?>
</body>
</html>