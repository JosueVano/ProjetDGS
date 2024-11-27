<?php
namespace App\controllers;

use config\Database;
use app\models\ComArticle;

use app\controllers\ArticleController;
use app\controllers\CommandeController;


class ComArticleController {
    private $conn;
    private $table_name = "com_articles";

    public function __construct() {
        $database = new Database();
        $this->conn = $database->getConnection();
    }

    // Fonction index pour afficher tous les articles de commande
    public function index() {
        include __DIR__ . '/../../public/views/header.php';
        // Récupérer tous les articles de commande
        $com_articles = $this->getAllComArticles();
        if (isset($_POST['id_comArticle']))
        {
            $com_articlesId = $this->getComArticleById($_POST['id_comArticle']); 
        }

        $articleController = new ArticleController();
        $articles = $articleController->getAllArticles(); // Méthode pour récupérer tous les articles

        $commandeController = new CommandeController();
        $commandes = $commandeController->getAllCommandes(); // Méthode pour récupérer tous les Commandes
        
        // Inclure la vue correspondante avec les données
        include __DIR__ . '/../../public/views/admin/com_article_view.php';
    }

    public function getAllComArticles() {
        $query = "SELECT * FROM " . $this->table_name;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        $com_articles = [];
        while ($row = $stmt->fetch(\PDO::FETCH_ASSOC)) {
            $com_articles[] = new ComArticle(
                $row['id_com_article'],
                $row['commande'],
                $row['article'],
                $row['entree'],
                $row['sortie']
            );
        }
        return $com_articles;
    }

    public function getComArticleById($id_com_article) {
        $query = "SELECT * FROM " . $this->table_name . " WHERE id_com_article = :id_com_article";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id_com_article', $id_com_article);
        $stmt->execute();

        if ($row = $stmt->fetch(\PDO::FETCH_ASSOC)) {
            return new ComArticle($row['id_com_article'], $row['commande'], $row['article'],$row['entree'], $row['sortie']);
        }
        return null;
    }

    public function createComArticle() {
        $query = "INSERT INTO " . $this->table_name . " (commande, article, entree, sortie) VALUES (:commande, :article, :entree, :sortie)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':commande', $_POST['commande']);
        $stmt->bindParam(':article', $_POST['article']);
        $stmt->bindParam(':entree', $_POST['entree']);
        $stmt->bindParam(':sortie', $_POST['sortie']);
        if ($stmt->execute()) {
            // Redirection après succès
            header('Location: /comArticle');
            exit();
        } else {
            // Gérer l'erreur (facultatif)
            echo "Erreur lors de la creation de commande de  l'article.";
        }
    }

    public function updateComArticle() {
        $query = "UPDATE " . $this->table_name . " SET commande = :commande, article = :article, entree = :entree, sortie = :sortie WHERE id_com_article = :id_com_article";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id_com_article', $_POST['id_com_article']);
        $stmt->bindParam(':commande', $_POST['commande']);
        $stmt->bindParam(':article', $_POST['article']);
        $stmt->bindParam(':entree', $_POST['entree']);
        $stmt->bindParam(':sortie', $_POST['sortie']);
            if ($stmt->execute()) {
                // Redirection après succès
                header('Location: /comArticle');
                exit();
            } else {
                echo "Erreur lors de la modification de commande de l'article.";
            }
    }

    public function deleteComArticle() {
        $query = "DELETE FROM " . $this->table_name . " WHERE id_com_article = :id_com_article";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id_com_article', $_POST['id_com_article']);
        if ($stmt->execute()) {
            // Redirection après succès
            header('Location: /comArticle');
            exit();
        } else {
            // Gérer l'erreur (facultatif)
            echo "Erreur lors de la suppression de commande de  l'article.";
        }
    }
}
