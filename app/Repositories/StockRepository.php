<?php
namespace App\Repositories;

use App\models\Commande;
use app\models\User;
use config\Database;

class StockRepository
{

    public function get()
    { 
        
        $db = new Database;

        $conn = $db->getConnection();

        $query = "SELECT a.nom, SUM(entree)-SUM(sortie) qte  FROM `stocks` s INNER JOIN `articles` a ON s.`article_id` = a.`id_article` GROUP BY a.nom";

        $stmt = $conn->prepare($query);

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

    public function input($data)
    { 
        
        $db = new Database;

        $conn = $db->getConnection();

        $refCmd = date('ymdHis');

        $agenceId = $data['agence_id'];

        $query_1 = "INSERT INTO commandes(`id_commande`, `agence_id`, `date`, `status`) VALUES (:id_commande, :agence, :dateCmd, :cmdStatus); ";

        $query_2 = "INSERT INTO stocks(`commande_id`, `article_id`, `entree`, `prix`)
                    SELECT '$refCmd',`article_id`, `qte`, `prix` FROM com_articles_tmp WHERE agence_id = '$agenceId';";

        $query_3 = "DELETE FROM com_articles_tmp WHERE agence_id = '$agenceId'";

        $stmt = $conn->prepare($query_1);

        $stmt2 = $conn->prepare($query_2);

        $stmt3 = $conn->prepare($query_3);

        $stmt->bindParam(':id_commande', $refCmd);
        $stmt->bindParam(':agence', $data['agence_id']);
        $stmt->bindParam(':dateCmd', $data['dateCmd']);
        $stmt->bindParam(':cmdStatus', $data['status']);

        $stmt->execute();

        $stmt2->execute();

        $stmt3->execute();
        

    }


}