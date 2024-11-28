<?php
namespace App\Repositories;

use App\models\Commande;
use app\models\User;
use config\Database;

class StockRepository
{

    public function get($agenceId)
    { 
        
        $db = new Database;

        $conn = $db->getConnection();

        $query = "SELECT agence_id, a.nom, SUM(entree)-SUM(sortie) qte  FROM `stocks` s INNER JOIN `commandes` c ON s.commande_id = c.id_commande
            INNER JOIN `articles` a ON s.`article_id` = a.`id_article`
            WHERE agence_id = :agence_id GROUP BY agence_id, a.nom";

        $stmt = $conn->prepare($query);

        $stmt->bindParam(':agence_id', $agenceId);

        $stmt->execute();

        return $db->result($stmt->fetchAll());

    }

    public function sortie($data)
    { 
        
        $db = new Database;

        $conn = $db->getConnection();

        $commandeId = $data['id_commande'];

        $query_1 = "INSERT INTO stocks(`commande_id`, `article_id`, `entree`, `sortie`, `prix`)
                    SELECT '$commandeId',`article_id`,'0' `entree`, `qte` `sortie`, `prix` FROM com_articles WHERE commande_id = :id_commande;";

        $query_2 = "UPDATE commandes SET `status` = '4' WHERE id_commande = '$commandeId'";

        $stmt = $conn->prepare($query_1);

        $stmt2 = $conn->prepare($query_2);

        $stmt->bindParam(':id_commande', $data['id_commande']);

        $stmt->execute();

        $stmt2->execute();        

    }

    public function recu($commandeId)
    { 
        
        $db = new Database;

        $conn = $db->getConnection();

        $query = "UPDATE commandes SET `status` = '4' WHERE id_commande = :id_commande";

        $stmt = $conn->prepare($query);

        $stmt->bindParam(':id_commande', $commandeId);

        $stmt->execute();
        

    }
}