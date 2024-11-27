<?php
namespace App\controllers;

use App\Lib\View;
use config\Database;
use app\models\Article;

class ArticleController {
    private $conn;
    private $table_name = "articles";

    public function __construct() {
        $database = new Database();
        $this->conn = $database->getConnection();
    }

    public function index() {
        // include __DIR__ . '/../../public/views/header.php';
        // Récupérer tous les articles
        $articles = $this->getAllArticles();
        // if (isset($_POST['id_article']))
        // {
        //     $articlesId = $this->getArticleById($_POST['id_article']); 
        // }
        
        // // Inclure la vue correspondante avec les données
        // include __DIR__ . '/../../public/views/admin/article_view.php';

        return View::make('articles/index', [
            'articles'  =>$articles,
        ]);

    }

    public function getAllArticles() {
        $query = "SELECT * FROM " . $this->table_name;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        $articles = [];
        while ($row = $stmt->fetch(\PDO::FETCH_ASSOC)) {
            $articles[] = new Article($row['id_article'], $row['nom'], $row['prix']);
        }
        return $articles;
    }

    public function getArticleById($id_article) {
        $query = "SELECT * FROM " . $this->table_name . " WHERE id_article = :id_article";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id_article', $id_article);
        $stmt->execute();

        if ($row = $stmt->fetch(\PDO::FETCH_ASSOC)) {
            return new Article($row['id_article'], $row['nom'], $row['prix']);
        }
        return null;
    }

    public function createArticle() {
        $query = "INSERT INTO " . $this->table_name . " (nom, prix) VALUES (:nom, :prix)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':nom', $_POST['nom']);
        $stmt->bindParam(':prix', $_POST['prix']);
        if ($stmt->execute()) {
            // Redirection après succès
            header('Location: /article');
            exit();
        } else {
            // Gérer l'erreur (facultatif)
            echo "Erreur lors de la creation de l'article.";
        }
    }

    public function updateArticle() {
        $query = "UPDATE " . $this->table_name . " SET nom = :nom, prix = :prix WHERE id_article = :id_article";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id_article', $_POST['id_article']);
        $stmt->bindParam(':nom', $_POST['nom']);
        $stmt->bindParam(':prix', $_POST['prix']);
        if ($stmt->execute()) {
            // Redirection après succès
            header('Location: /article');
            exit();
        } else {
            // Gérer l'erreur (facultatif)
            echo "Erreur lors de la modification de l'article.";
        }
    }

    public function deleteArticle() {
        $query = "DELETE FROM " . $this->table_name . " WHERE id_article = :id_article";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id_article', $_POST['id_article']);
        if ($stmt->execute()) {
            // Redirection après succès
            header('Location: /article');
            exit();
        } else {
            // Gérer l'erreur (facultatif)
            echo "Erreur lors de la suppression de l'article.";
        }
    }
}
