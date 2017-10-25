<?php
require_once("../model/RSS.class.php");
require_once("../model/Nouvelle.class.php");

class DAO {
        private $db; // L'objet de la base de donnée

        // Ouverture de la base de donnée
        function __construct() {
          $dsn = 'sqlite:data/rss.db'; // Data source name
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
            //$q = $this->db->prepare("SELECT * FROM RSS WHERE url='$url'");// var_dump("SELECT * FROM RSS WHERE url = '$url'");
            //$r = $q->execute(); var_dump($q); var_dump($r);
            //$r = $this->db->exec("SELECT * FROM RSS WHERE url='$url'");
            //$result = $r->fetchAll(PDO::FETCH_CLASS,"RSS"); var_dump($result);
            $req = "SELECT * FROM RSS WHERE url='$url'";
            $sth = $this->db->query($req) or die (print_r($thid->db->errorInfo()));
            $tab = $sth->fetchAll(PDO::FETCH_ASSOC);
            return $tab;
        }

        // Met à jour un flux
        function updateRSS(RSS $rss) {
          // Met à jour uniquement le titre et la date
          $titre = $this->db->quote($rss->titre());
          $q = "UPDATE RSS SET titre=$titre, date='".$rss->date()."' WHERE url='".$rss->url()."'";
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
          $q = "SELECT * FROM nouvelle where titre = $titre and RSS_id = $RSS_id";
          $r = $this->db->exec($q);
          $result = $r->fetchAll(PDO::FETCH_CLASS, "Nouvelle");
          return $result;
        }

        // Crée une nouvelle dans la base à partir d'un objet nouvelle
        // et de l'id du flux auquelle elle appartient
        function createNouvelle(Nouvelle $n, $RSS_id) {

          if ($n == NULL) {
              $q = "INSERT INTO nouvelle (RSS_id) VALUES ('$RSS_id')";
              $r = $this->db->exec($q);
              return $n;
          }

        }
      }
?>
