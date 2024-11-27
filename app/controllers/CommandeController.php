<?php
namespace App\controllers;

use config\Database;
use app\models\Commande;

use app\controllers\AgenceController;
use App\Lib\Route;
use App\Lib\View;
use app\models\User;
use App\Repositories\AgenceRepository;
use App\Repositories\ArticleRepository;
use App\Repositories\CommandeRepository;

class CommandeController {
    private $conn;
    private $table_name = "commandes";

    public function __construct() {
        $database = new Database();
        $this->conn = $database->getConnection();
    }

    // Fonction index pour afficher toutes les commandes
    public function index() {

        $commandes = (new CommandeRepository)->get();

        $agences = (new AgenceRepository)->get(); 

        $statusCommande = [
            '1' =>'En cours',
            '2' =>'Livrée',
            '3' =>'abandonnée',
        ];

        return View::make('commandes/index', [
            'commandes' =>$commandes,
            'statusCommande' =>$statusCommande,
            'agences' =>$agences,
        ]);

    }

    public function create()
    {
        
        $articles = (new ArticleRepository)->get();

        $cmdArticles = (new CommandeRepository)->getCmdArticle();

        $mode = 'create';

        return View::make('commandes/create', [
            'articles'  =>$articles,
            'mode'  =>$mode,
            'cmdArticles'  =>$cmdArticles,
        ]);
        
    }

    public function store()
    {

        $user = (object)(new User)->current();

        $data = [
            'agence_id' =>$user->agence_id,
            'dateCmd'    =>$_POST['dateCmd'],
            'status'    =>'1',
        ];

        $cmd = new CommandeRepository;

        $cmd->create($data);

        header('Location: /commande');

    }

    public function show()
    {

        $_commande = new CommandeRepository;

        $params = Route::params();

        $commandeId = $params->id;

        $commande = $_commande->find($commandeId);
        
        $articles = $_commande->article($commandeId);

        return View::make('commandes/show', [
            'commande'  =>$commande,
            'articles'  =>$articles,
            'mode'  =>'show',
        ]);      

    }

    public function getAllCommandes() {
        $query = "SELECT * FROM " . $this->table_name;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        $commandes = [];
        while ($row = $stmt->fetch(\PDO::FETCH_ASSOC)) {
            $commandes[] = new Commande($row['id_commande'], $row['agence'], $row['date'], $row['status']);
        }
        return $commandes;
    }

    public function getCommandeById($id_commande) {
        $query = "SELECT * FROM " . $this->table_name . " WHERE id_commande = :id_commande";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id_commande', $id_commande);
        $stmt->execute();

        if ($row = $stmt->fetch(\PDO::FETCH_ASSOC)) {
            return new Commande($row['id_commande'], $row['agence'], $row['date'], $row['status']);
        }
        return null;
    }

    public function createCommande() {
        $query = "INSERT INTO " . $this->table_name . " (agence, date, status) VALUES (:agence, :date, :status)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':agence', $_POST['agence']);
        $stmt->bindParam(':date', $_POST['date']);
        $stmt->bindParam(':status', $_POST['status']);
        
        if ($stmt->execute()) {
            // Redirection après succès
            header('Location: /commande');
            exit();
        } else {
            // Gérer l'erreur (facultatif)
            echo "Erreur lors de la création de la commande.";
        }
    }

    public function updateCommande() {
        $query = "UPDATE " . $this->table_name . " SET agence = :agence, date = :date, status = :status WHERE id_commande = :id_commande";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id_commande', $_POST['id_commande']);
        $stmt->bindParam(':agence', $_POST['agence']);
        $stmt->bindParam(':date', $_POST['date']);
        $stmt->bindParam(':status', $_POST['status']);
        
        if ($stmt->execute()) {
            // Redirection après succès
            header('Location: /commande');
            exit();
        } else {
            echo "Erreur lors de la modification de la commande.";
        }
    }

    public function deleteCommande() {
        $query = "DELETE FROM " . $this->table_name . " WHERE id_commande = :id_commande";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id_commande', $_POST['id_commande']);
        
        if ($stmt->execute()) {
            // Redirection après succès
            header('Location: /commande');
            exit();
        } else {
            // Gérer l'erreur (facultatif)
            echo "Erreur lors de la suppression de la commande.";
        }
    }
}