<?php

class Nouvelle {
    private $titre;   // Le titre
    private $date;    // Date de publication
    private $description; // Contenu de la nouvelle
    private $url;         // Le lien vers la ressource associée à la nouvelle
    private $urlImage;    // URL vers l'image

    function __construct() {
    }

    // Fonctions getter

    function getTitre() {
        return $this->titre;
    }

    function getDate() {
        return $this->date;
    }

    function getDescription() {
        return $this->description;
    }

    function getUrl() {
        return $this->url;
    }

    function getUrlImage() {
        return $this->urlImage;
    }

    // Charge les attributs de la nouvelle avec les informations du noeud XML

    function update(DOMElement $item) {

        $titreNodeList = $item->getElementsByTagName('title');
        $titreNode = $titreNodeList->item(0);
        $this->titre = $titreNode->textContent;

        $dateNodeList = $item->getElementsByTagName('pubDate');
        $dateNode = $dateNodeList->item(0);
        $this->date = $dateNode->textContent;

        $descNodeList = $item->getElementsByTagName('description');
        $descNodeList = $descNodeList->item(0);
        $this->description = $descNodeList->textContent;

        $urlNodeList = $item->getElementsByTagName('link');
        $urlNodeList = $urlNodeList->item(0);
        $this->url = $urlNodeList->textContent;

        $urlImageNodeList = $item->getElementsByTagName('enclosure');
        if($urlImageNodeList->length != 0) {
            $urlImageNodeList = $urlImageNodeList->item(0)->attributes->getNamedItem("url")->nodeValue;
            $this->urlImage = $urlImageNodeList;
          } else {
            // Pas d'image
            $this->urlImage = "";
          }
    }
}

?>