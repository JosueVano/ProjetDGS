<?php
namespace App\Repositories;

use App\models\Commande;
use app\models\User;
use config\Database;

class CommandeRepository
{



    public function find($commandeId)
    { 
        
        $db = new Database;

        $conn = $db->getConnection();

        $query = "SELECT c.*, a.id_agence, a.nom FROM `commandes` c INNER JOIN `agences` a ON c.`agence_id` = a.`id_agence` WHERE id_commande = :id_commande";

        $stmt = $conn->prepare($query);


        $stmt->bindParam(':id_commande', $commandeId);

        $stmt->execute();

        return (object)$stmt->fetch();

    }

    public function get()
    { 
        
        $db = new Database;

        $conn = $db->getConnection();

        $query = "SELECT c.*, a.id_agence, a.nom FROM `commandes` c INNER JOIN `agences` a ON c.`agence_id` = a.`id_agence`";

        $stmt = $conn->prepare($query);

        $stmt->execute();

        return $db->result($stmt->fetchAll());

    }

    public function cmdArticle($data)
    { 
        
        $db = new Database;

        $conn = $db->getConnection();

        $query = "REPLACE INTO com_articles_tmp (`agence_id`,`article_id`,`qte`, `prix`) VALUES (:agence_id, :article_id, :qte, :prix)";

        $stmt = $conn->prepare($query);

        $stmt->bindParam(':agence_id', $data['agence_id']);
        $stmt->bindParam(':article_id', $data['article_id']);
        $stmt->bindParam(':qte', $data['qte']);
        $stmt->bindParam(':prix', $data['prix']);

        $stmt->execute();

    }

    public function getCmdArticle()
    {

        $user = (object)(new User)->current();

        $agenceId = $user->agence_id;
        
        $db = new Database;

        $conn = $db->getConnection();

        $query = "SELECT c.*, a.nom, a.prix FROM `com_articles_tmp` c INNER JOIN `articles` a ON c.`article_id` = a.`id_article` WHERE agence_id = $agenceId";

        $stmt = $conn->prepare($query);

        $stmt->execute();

        return $db->result($stmt->fetchAll());

    }

    public function article($commandeId)
    {

        $user = (object)(new User)->current();

        $agenceId = $user->agence_id;
        
        $db = new Database;

        $conn = $db->getConnection();

        $query = "SELECT c.*, a.nom, a.prix FROM `com_articles` c INNER JOIN `articles` a ON c.`article_id` = a.`id_article` WHERE commande_id = $commandeId";

        $stmt = $conn->prepare($query);

        $stmt->execute();

        return $db->result($stmt->fetchAll());

    }

    public function create($data)
    { 
        
        $db = new Database;

        $conn = $db->getConnection();

        $refCmd = date('ymdHis');

        $agenceId = $data['agence_id'];

        $query_1 = "INSERT INTO commandes(`id_commande`, `agence_id`, `date`, `status`) VALUES (:id_commande, :agence, :dateCmd, :cmdStatus); ";

        $query_2 = "INSERT INTO com_articles(`commande_id`, `article_id`, `qte`, `prix`)
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