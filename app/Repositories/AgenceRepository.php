<?php
namespace App\Repositories;

use App\models\Agence;
use config\Database;

class AgenceRepository
{

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
}