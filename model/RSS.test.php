<?php
      // Test de la classe RSS
      require_once('RSS.class.php');
      // Une instance de RSS
      $rss = new RSS('http://www.lemonde.fr/m-actu/rss_full.xml');
      // Charge le flux depuis le réseau
      $rss->update();
      // Affiche le titre
      //var_dump($rss->getTitre());
      echo "<h3>".$rss->getTitre()."</h3><br>";
      // Affiche le titre et la description de toutes les nouvelles
      //$nouvelles = $rss->getNouvelles();
      //var_dump($nouvelles);
      foreach($rss->getNouvelles() as $nouvelle) {
        echo ' '.$nouvelle->getTitre().' '.$nouvelle->getDate()."<br>";
        echo '  '.$nouvelle->getDescription()."<br>";
        echo '<img src='.$nouvelle->getUrlImage().'><br>';
      }
?>