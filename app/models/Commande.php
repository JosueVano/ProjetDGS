<?php
namespace App\Models;
class Commande {
    private $id_commande;
    private $agence;
    private $date;
    private $status;

    public function __construct($id_commande, $agence, $date, $status) {
        $this->id_commande = $id_commande;
        $this->agence = $agence;
        $this->date = $date;
        $this->status = $status;
    }

    public function __get($name)
    {
        return $this->$name;
    }

    public function getIdCommande() {
        return $this->id_commande;
    }

    public function getAgence() {
        return $this->agence;
    }

    public function getDate() {
        return $this->date;
    }

    public function getStatus() {
        return $this->status;
    }
}
