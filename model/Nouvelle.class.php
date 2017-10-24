<?php

class Nouvelle {
    static $id;      // L'identifiant de la nouvelle
    private $titre;   // Le titre
    private $date;    // Date de publication
    private $description; // Contenu de la nouvelle
    private $url;         // Le lien vers la ressource associée à la nouvelle
    private $urlImage;    // URL vers l'image

    function __construct() {
        if (self::$id == null) {
            self::$id = 1;
        } else {
            self::$id ++;
        }
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

    function staticValue() {
        return self::$id;
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
          var_dump(self::$id);
          
          $this->downloadImage($item,self::$id);
    }

    function downloadImage(DOMElement $item, $imageId) {
        // On suppose que $node est un objet sur le noeud 'enclosure' d'un flux RSS
        // On tente d'accéder à l'attribut 'url'
        $urlImageNodeList = $item->getElementsByTagName("enclosure")->item(0)->attributes->getNamedItem('url');
        if ($urlImageNodeList != NULL) {
            // L'attribut url a été trouvé : on récupère sa valeur, c'est l'URL de l'image
            $url = $urlImageNodeList->nodeValue;
            // On construit un nom local pour cette image : on suppose que $nomLocalImage contient un identifiant unique
            // On suppose que le dossier images existe déjà
            $imagePath = 'images/'.$imageId++.'.jpg'; // Pas besoin de "this"
            $file = file_get_contents($url);
            // Écrit le résultat dans le fichier
            file_put_contents($imagePath, $file);
        }
    }
}

?>