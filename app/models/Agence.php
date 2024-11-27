<?php
namespace App\models;
class Agence {

    private $id_agence;
    private $nom;
    private $email;
    private $status;

    public function __construct($id_agence, $nom, $email, $status) {
        $this->id_agence = $id_agence;
        $this->nom = $nom;
        $this->email = $email;
        $this->status = $status;
    }

    public function __get($name)
    {
        return $this->$name;
    }

    public function getIdAgence() {
        return $this->id_agence;
    }

    public function getNom() {
        return $this->nom;
    }

    public function getEmail() {
        return $this->email;
    }

    public function getStatus() {
        return $this->status;
    }
}
