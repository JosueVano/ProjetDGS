<?php
namespace App\controllers;

use config\Database;
use app\models\Commande;

use app\controllers\AgenceController;
use App\Lib\View;
use app\models\User;
use App\Repositories\AgenceRepository;
use App\Repositories\ArticleRepository;
use App\Repositories\CommandeRepository;

class CommandeTmpController {
    private $conn;
    private $table_name = "commandes";

    public function __construct() {
        $database = new Database();
        $this->conn = $database->getConnection();
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

    public function cart()
    {

        $cmdArticles = (new CommandeRepository)->getCmdArticle();

        $mode = 'cart';

        return View::make('commandes/create', [
            'mode'  =>$mode,
            'cmdArticles'  =>$cmdArticles,
        ]);
        
    }

    public function store()
    {

        $user = (object)(new User)->current();

        $article = (new ArticleRepository)->find($_POST['article']);

        $data = [
            'agence_id' =>$user->agence_id,
            'article_id'    =>$_POST['article'],
            'qte'    =>$_POST['qte'],
            'prix'    =>$article->prix,
        ];

        $cmd = new CommandeRepository;

        $cmd->cmdArticle($data);

        header('Location: /commande/cart/create');

    }

}