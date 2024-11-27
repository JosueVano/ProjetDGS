<?php
namespace App\controllers;

use App\Lib\View;
use config\Database;
use app\models\Agence;
use App\Repositories\AgenceRepository;

class AgenceController {
    
    private $conn;
    private $table_name = "agences";

    public function __construct() {
        $database = new Database();
        $this->conn = $database->getConnection();
    }

    public function index() {

        $agences = $this->getAllAgences();

        return View::make('agences/index', [
            'agences'   =>$agences,
        ]);

    }

    public function create()
    {

        return View::make('agences/create', []);

    }

    public function store()
    {

        $_agence = new AgenceRepository;

        $data = [
            'id_agence' =>$_POST['code'],
            'name' =>$_POST['name'],
            'email' =>$_POST['email'],
            'status'    =>'1'
        ];

        $_agence->create($data);

        header('Location: /agence');

    }

    

    public function getAllAgences() {

        $query = "SELECT * FROM " . $this->table_name;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        $agences = [];

        while ($row = $stmt->fetch(\PDO::FETCH_ASSOC)) {
            $agences[] = new Agence($row['id_agence'], $row['nom'], $row['email'], $row['status']);
        }

        return $agences;
    }

    public function getAgenceById($id_agence) {
        $query = "SELECT * FROM " . $this->table_name . " WHERE id_agence = :id_agence";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id_agence', $id_agence);
        $stmt->execute();

        if ($row = $stmt->fetch(\PDO::FETCH_ASSOC)) {
            return new Agence($row['id_agence'], $row['nom'], $row['email'], $row['status']);
        }
        return null;
    }

    public function createAgence() {
        $query = "INSERT INTO " . $this->table_name . " (nom, email, status) VALUES (:nom, :email, :status)";
        $stmt = $this->conn->prepare($query);
        
        // Liaison des paramètres
        $stmt->bindParam(':nom', $_POST['nom']);
        $stmt->bindParam(':email', $_POST['email']);
        $stmt->bindParam(':status', $_POST['status']);
        
        // Exécution de la requête
        if ($stmt->execute()) {
            // Redirection après succès
            header('Location: /agence');
            exit();
        } else {
            // Gérer l'erreur (facultatif)
            echo "Erreur lors de la création de l'agence.";
        }
    }

    public function updateAgence() {
        $query = "UPDATE " . $this->table_name . " SET nom = :nom, email = :email, status = :status WHERE id_agence = :id_agence";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id_agence', $_POST['id_agence']);
        $stmt->bindParam(':nom', $_POST['nom']);
        $stmt->bindParam(':email', $_POST['email']);
        $stmt->bindParam(':status', $_POST['status']);
        if ($stmt->execute()) {
            // Redirection après succès
            header('Location: /agence');
            exit();
        } else {
            // Gérer l'erreur (facultatif)
            echo "Erreur lors de la modification de l'agence.";
        }
    }

    public function deleteAgence() {
        $query = "DELETE FROM " . $this->table_name . " WHERE id_agence = :id_agence";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id_agence', $_POST['id_agence']);
        if ($stmt->execute()) {
            // Redirection après succès
            header('Location: /agence');
            exit();
        } else {
            // Gérer l'erreur (facultatif)
            echo "Erreur lors de la supression de l'agence.";
        }
    }
}
