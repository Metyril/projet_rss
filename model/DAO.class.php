<?php
  require_once("../model/RSS.class.php");
  require_once("../model/Nouvelle.class.php");

  class DAO {
    private $db; // L'objet de la base de donnée
    // Ouverture de la base de donnée
    function __construct() {
      $dsn = 'sqlite:../model/data/rss.db'; // Data source name
      try {
        $this->db = new PDO($dsn);
      } catch (PDOException $e) {
        exit("Erreur ouverture BD : ".$e->getMessage());
      }
    }

    //////////////////////////////////////////////////////////
    // Methodes CRUD sur RSS
    //////////////////////////////////////////////////////////

    // Crée un nouveau flux à partir d'une URL
    // Si le flux existe déjà on ne le crée pas
    function createRSS($url) {
      $rss = $this->readRSSfromURL($url);
      if ($rss == NULL) {
        try {
          $q = "INSERT INTO RSS (url) VALUES ('$url')";
          $r = $this->db->exec($q);
          if ($r == 0) {
            die("createRSS error: no rss inserted\n");
          }
          return $this->readRSSfromURL($url);
        } catch (PDOException $e) {
          die("PDO Error :".$e->getMessage());
        }
      } else {
        // Retourne l'objet existant
        return $rss;
      }
    }

    // Acces à un objet RSS à partir de son URL
    function readRSSfromURL($url) {
        $req = "SELECT * FROM RSS WHERE url='$url'";
        $sth = $this->db->query($req) or die (print_r($this->db->errorInfo()));
        $tab = $sth->fetchAll(PDO::FETCH_CLASS,"RSS");
        if (array_filter($tab)) {
          return $tab[0];
        } else {
          return NULL;              
        }
    }

    // Met à jour un flux
    function updateRSS(RSS $rss) {
      $titre = $this->db->quote($rss->getTitre());
      $q = "UPDATE RSS SET titre=$titre, date='".$rss->getDate()."', dateMaj='".$rss->getDateMaj()."' WHERE url='".$rss->getUrl()."'";
      try {
        $r = $this->db->exec($q);
        if ($r == 0) {
          die("updateRSS error: no rss updated\n");
        }
      } catch (PDOException $e) {
        die("PDO Error :".$e->getMessage());
      }
    }

    // Supprime un flux
    function deleteRSS($RSS_id) {
      $req1 = "DELETE FROM RSS WHERE id='$RSS_id'";
      $sth1 = $this->db->exec($req1) or die (print_r($this->db->errorInfo()));

      // Réinitialise l'auto-incrémentation de l'identifiant au dernier élément présent dans la base
      $req2 = "DELETE FROM sqlite_sequence WHERE name='RSS'";
      $sth2 = $this->db->exec($req2) or die (print_r($this->db->errorInfo()));
    }

    // Accès à un flux depuis son identifiant
    function lireRSS($RSS_id) {
      $req = "SELECT * FROM RSS where id = '$RSS_id'";
      $sth = $this->db->query($req) or die (print_r($this->db->errorInfo()));
      $result = $sth->fetchAll(PDO::FETCH_CLASS, "RSS");
      if (array_filter($result)) {
        return $result[0];
      } else {
        return NULL;              
      }
    }

    // Accès aux URLs des flux présents dans la base
    function listeUrl() {
      $req = "SELECT url FROM RSS";
      $sth = $this->db->query($req) or die (print_r($this->db->errorInfo()));
      $result = $sth->fetchAll(PDO::FETCH_COLUMN);
      if (array_filter($result)) {
        return $result;
      } else {
        return NULL;              
      }
    }

    //////////////////////////////////////////////////////////
    // Methodes CRUD sur Nouvelle
    //////////////////////////////////////////////////////////

    // Acces à une nouvelle à partir de son titre et l'ID du flux
    function readNouvellefromTitre($titre,$RSS_id) {
      $req = "SELECT * FROM nouvelle where titre = '$titre' and RSS_id = '$RSS_id'";
      $sth = $this->db->query($req) or die (print_r($this->db->errorInfo()));
      $result = $sth->fetchAll(PDO::FETCH_CLASS| PDO::FETCH_PROPS_LATE,"Nouvelle", array('RSS_id'));
      if (array_filter($result)) {
        return $result[0];
      } else {
        return NULL;              
      }
    }

    // Crée une nouvelle dans la base à partir d'un objet nouvelle
    // et de l'id du flux auquelle elle appartient
    function createNouvelle(Nouvelle $n, $RSS_id) {
      $nouvelle = $this->readNouvellefromTitre($n->getTitre(), $RSS_id);
      if ($nouvelle == NULL) {
        try {
          $req = "INSERT INTO nouvelle (titre, RSS_id) VALUES ('".$n->getTitre()."', '$RSS_id')";
          $sth = $this->db->exec($req);
          if ($sth == 0) {
            die("createNouvelle error: no nouvelle inserted\n");
          }
        } catch (PDOException $e) {
          die("PDO Error :".$e->getMessage());
        }
      }
    }

    // Met à jour une nouvelle
    function updateNouvelle(Nouvelle $n, $RSS_id) {
      $desc = $this->db->quote($n->getDescription());
      $titre = $this->db->quote($n->getTitre());
      $q = "UPDATE nouvelle SET description=$desc, date='".$n->getDate()."', url='".$n->getUrl()."', image='".$n->getUrlImage()."' WHERE titre=$titre AND RSS_id=$RSS_id";
      try {
        $r = $this->db->exec($q);
        if ($r == 0) {
          die("updateNouvelle error: no nouvelle updated\n");
        }
      } catch (PDOException $e) {
        die("PDO Error :".$e->getMessage());
      }
    }

    // Supprime une nouvelle
    function deleteListeNouvelles($RSS_id) {
      $req1 = "DELETE FROM nouvelle WHERE RSS_id='$RSS_id'";
      $sth1 = $this->db->exec($req1) or die (print_r($this->db->errorInfo()));

      // Réinitialise l'auto-incrémentation de l'identifiant au dernier élément présent dans la base
      $req2 = "DELETE FROM sqlite_sequence WHERE name='nouvelle'";
      $sth2 = $this->db->exec($req2) or die (print_r($this->db->errorInfo()));
    }

    // Renvoie la liste de nouvelles d'un flux
    function listeNouvelles($RSS_id) {
      $req = "SELECT * FROM nouvelle where RSS_id = '$RSS_id'";
      $sth = $this->db->query($req) or die (print_r($this->db->errorInfo()));
      $result = $sth->fetchAll(PDO::FETCH_CLASS| PDO::FETCH_PROPS_LATE,"Nouvelle", array('RSS_id'));
      if (array_filter($result)) {
        return $result;
      } else {
        return NULL;              
      }
    }

    // Accès à une nouvelle depuis son identifiant et celui de son flux
    function lireNouvelle($id, $RSS_id) {
      $req = "SELECT * FROM nouvelle where id = '$id' and RSS_id='$RSS_id'";
      $sth = $this->db->query($req) or die (print_r($this->db->errorInfo()));
      $result = $sth->fetchAll(PDO::FETCH_CLASS| PDO::FETCH_PROPS_LATE,"Nouvelle", array('RSS_id'));
      if (array_filter($result)) {
        return $result[0];
      } else {
        return NULL;              
      }
    }



    // Réinitialise la base de données
    function reinit() {
      $q1 = "DELETE FROM RSS";
      $r1 = $this->db->exec($q1);
  
      $q2 = "DELETE FROM nouvelle";
      $r2 = $this->db->exec($q2);

      $q3 = "DELETE FROM utilisateur";
      $r3 = $this->db->exec($q3);
  
      $q4 = "DELETE FROM abonnement";
      $r4 = $this->db->exec($q4);
  
      $q5 = "DELETE FROM sqlite_sequence WHERE name='RSS'";
      $r5 = $this->db->exec($q5);
  
      $q6 = "DELETE FROM sqlite_sequence WHERE name='nouvelle'";
      $r6 = $this->db->exec($q6); 
    }


  }
?>