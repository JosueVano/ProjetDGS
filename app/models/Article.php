<?php
namespace App\Models;
class Article {
    private $id_article;
    private $nom;

    private $prix;

    public function __construct($id_article, $nom, $prix) {
        $this->id_article = $id_article;
        $this->nom = $nom;
        $this->prix = $prix;
    }

    public function __get($name)
    {
        return $this->$name;
    }

    public function getIdArticle() {
        return $this->id_article;
    }

    public function getNom() {
        return $this->nom;
    }

    public function getPrix() {
        return $this->prix;
    }
}
