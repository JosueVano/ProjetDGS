<?php
namespace App\Repositories;

use App\models\Article;
use config\Database;

class ArticleRepository
{

    public function get()
    { 
        
        $db = new Database;

        $conn = $db->getConnection();

        $query = "SELECT * FROM `articles`";

        $stmt = $conn->prepare($query);

        $stmt->execute();

        return $db->result($stmt->fetchAll());


    }

    public function find($articleId)
    { 
        
        $db = new Database;

        $conn = $db->getConnection();

        $query = "SELECT * FROM `articles` WHERE id_article = :id_article";

        $stmt = $conn->prepare($query);

        $stmt->bindParam(':id_article', $articleId);

        $stmt->execute();

        return (object)$stmt->fetch();

    }

    
}