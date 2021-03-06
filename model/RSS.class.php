<?php
      require_once("../model/Nouvelle.class.php");

      class RSS {
      private $id;    // Identifiant du flux
      private $titre; // Titre du flux
      private $url;   // Chemin URL pour télécharger un nouvel état du flux
      private $date;  // Date du dernier téléchargement du flux
      private $nouvelles; // Liste des nouvelles du flux dans un tableau d'objets Nouvelle
      private $dateMaj;   // Date de mise à jour du flux

      // Fonctions getter et setter

      function setUrl($url) {
        $this->url = $url; 
      }
      function getId() {
        return $this->id;
      }
      function getTitre() {
        return $this->titre;
      }
      function getUrl() {
        return $this->url;
      }
      function getDate() {
        return $this->date;
      }
      function getNouvelles() {
        return $this->nouvelles;
      }
      function getDateMaj() {
        return $this->dateMaj;
      }

      // Récupère un flux à partir de son URL

      function update() {
        // Cree un objet pour accueillir le contenu du RSS : un document XML
        $doc = new DOMDocument;
        //Telecharge le fichier XML dans $rss
        $doc->load($this->url);
        // Recupère la liste (DOMNodeList) de tous les elements de l'arbre 'title'
        $titleNodeList = $doc->getElementsByTagName('title');
        // Met à jour le titre dans l'objet
        $this->titre = $titleNodeList->item(0)->textContent;
        // Recupère la liste (DOMNodeList) de tous les elements de l'arbre 'title'
        $titleNodeList = $doc->getElementsByTagName('pubDate');
        // Met à jour le titre dans l'objet
        $this->date = $titleNodeList->item(0)->textContent;
        // Récupère tous les items du flux RSS
        foreach ($doc->getElementsByTagName('item') as $node) {
          // Création d'un objet Nouvelle à conserver dans la liste $this->nouvelles
          $nouvelle = new Nouvelle($this->id);
          // Modifie cette nouvelle avec l'information téléchargée
          $nouvelle->update($node);
          // Ajoute cette nouvelle dans la liste du flux
          $this->nouvelles[] = $nouvelle;
          // Initialise la date de mise à jour du flux
          $this->dateMaj = date("Y-m-d h:i",time());
        }
      }
      
    }
?>