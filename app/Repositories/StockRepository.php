<?php
namespace App\Repositories;

use App\models\Commande;
use app\models\User;
use config\Database;

class StockRepository
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