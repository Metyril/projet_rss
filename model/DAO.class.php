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
      // Met à jour uniquement le titre et la date
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

    //////////////////////////////////////////////////////////
    // Methodes CRUD sur Nouvelle
    //////////////////////////////////////////////////////////
    // Acces à une nouvelle à partir de son titre et l'ID du flux
    function readNouvellefromTitre($titre,$RSS_id) {
      $req = "SELECT * FROM nouvelle where titre = '$titre' and RSS_id = '$RSS_id'";
      $sth = $this->db->query($req) or die (print_r($this->db->errorInfo()));
      $result = $sth->fetchAll(PDO::FETCH_CLASS,"Nouvelle");
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
          $q = "INSERT INTO nouvelle (titre) VALUES ('".$n->getTitre()."')";
          $r = $this->db->exec($q);
          //return $n;
          if ($r == 0) {
            die("createNouvelle error: no nouvelle inserted\n");
          }
        } catch (PDOException $e) {
          die("PDO Error :".$e->getMessage());
        }
      }
    }

    function updateNouvelle(Nouvelle $n, $RSS_id) {
      $desc = $this->db->quote($n->getDescription());
      $titre = $this->db->quote($n->getTitre());
      $q = "UPDATE nouvelle SET description=$desc, date='".$n->getDate()."', url='".$n->getUrl()."', image='".$n->getUrlImage()."', RSS_id=$RSS_id WHERE titre=$titre";
      try {
        $r = $this->db->exec($q);
        if ($r == 0) {
          die("updateNouvelle error: no nouvelle updated\n");
        }
      } catch (PDOException $e) {
        die("PDO Error :".$e->getMessage());
      }
    }




    function reinit() {
      $q1 = "DELETE FROM RSS WHERE id>0";
      $r1 = $this->db->exec($q1);
  
      $q2 = "DELETE FROM nouvelle WHERE id>0";
      $r2 = $this->db->exec($q2);
  
      $q3 = "DELETE FROM sqlite_sequence WHERE name='RSS';";
      $r3 = $this->db->exec($q3);
  
      $q4 = "DELETE FROM sqlite_sequence WHERE name='nouvelle'";
      $r4 = $this->db->exec($q4); 
    }

    function listeNouvelles($RSS_id) {
      $req = "SELECT * FROM nouvelle where RSS_id = '$RSS_id'";
      $sth = $this->db->query($req) or die (print_r($this->db->errorInfo()));
      $result = $sth->fetchAll(PDO::FETCH_CLASS,"Nouvelle");
      if (array_filter($result)) {
        return $result;
      } else {
        return NULL;              
      }
    }

    function lireNouvelle($id) {
      $req = "SELECT * FROM nouvelle where id = '$id'";
      $sth = $this->db->query($req) or die (print_r($this->db->errorInfo()));
      $result = $sth->fetchAll(PDO::FETCH_CLASS,"Nouvelle");
      if (array_filter($result)) {
        return $result[0];
      } else {
        return NULL;              
      }
    }
  }
?>