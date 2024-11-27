<?php
namespace App\Models;
class ComArticle {
    private $id_com_article;
    private $commande;
    private $article;
    private $entree;
    private $sortie;

    public function __construct($id_com_article, $commande, $article, $entree, $sortie) {
        $this->id_com_article = $id_com_article;
        $this->commande = $commande;
        $this->article = $article;
        $this->entree = $entree;
        $this->sortie = $sortie;
    }

    public function getIdComArticle() {
        return $this->id_com_article;
    }

    public function getCommande() {
        return $this->commande;
    }

    public function getArticle() {
        return $this->article;
    }

    public function getEntree() {
        return $this->entree;
    }

    public function getSortie() {
        return $this->sortie;
    }
}
