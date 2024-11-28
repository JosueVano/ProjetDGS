<?php
namespace App\Repositories;

use App\models\Commande;
use app\models\User;
use config\Database;

class ExpeditionRepository
{

    public function create($data)
    {
        
        $db = new Database;

        $conn = $db->getConnection();

        $commandeId = $data['commande_id'];

        $query_1 = "INSERT INTO expeditions(`commande_id`, `date_exp`, `type_trans`, `ref_exp`) VALUES (:commande_id, :date_exp, :type_trans, :ref_exp); ";

        $query_2 = "UPDATE commandes SET `status` = '2'  WHERE id_commande = :id_commande;";

        $query_3 = "INSERT INTO stocks(`commande_id`, `article_id`, `entree`, `sortie`, `prix`)
                    SELECT '$commandeId',`article_id`,'0' `entree`, `qte` `sortie`, `prix` FROM com_articles WHERE commande_id = '$commandeId';";

        $stmt = $conn->prepare($query_1);

        $stmt2 = $conn->prepare($query_2);

        $stmt3 = $conn->prepare($query_3);

        $stmt->bindParam(':commande_id', $data['commande_id']);
        $stmt->bindParam(':date_exp', $data['date_exp']);
        $stmt->bindParam(':type_trans', $data['type_trans']);
        $stmt->bindParam(':ref_exp', $data['ref_exp']);

        $stmt2->bindParam(':id_commande', $data['commande_id']);

        $stmt->execute();

        $stmt2->execute();

        $stmt3->execute();

    }
}
