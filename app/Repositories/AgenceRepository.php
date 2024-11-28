<?php
namespace App\Repositories;

use App\models\Agence;
use config\Database;

class AgenceRepository
{

    public function find($agenceId)
    { 
        
        $db = new Database;

        $conn = $db->getConnection();

        $query = "SELECT * FROM `agences` WHERE id_agence = :id_agence";

        $stmt = $conn->prepare($query);

        $stmt->bindParam(':id_agence', $agenceId);

        $stmt->execute();

        return (object)$stmt->fetch();


    }

    public function get()
    { 
        
        $db = new Database;

        $conn = $db->getConnection();

        $query = "SELECT * FROM `agences`";

        $stmt = $conn->prepare($query);

        $stmt->execute();

        $agences = [];

        while ($row = $stmt->fetch(\PDO::FETCH_ASSOC)) {
            $agences[] = new Agence($row['id_agence'], $row['nom'], $row['email'], $row['status']);
        }

        return $agences;


    }

    public function create($data)
    { 
        
        $db = new Database;

        $conn = $db->getConnection();

        $query = "REPLACE INTO `agences` (`id_agence`, `nom`, `email`, `status`) VALUES (:id_agence,:nom, :email, :statut)";

        $stmt = $conn->prepare($query);

        $stmt->bindParam(':id_agence', $data['id_agence']);
        $stmt->bindParam(':nom', $data['name']);
        $stmt->bindParam(':email', $data['email']);
        $stmt->bindParam(':statut', $data['status']);

        $stmt->execute();

    }
}