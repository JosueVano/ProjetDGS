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
use App\Repositories\StockRepository;

class StockController
{

    public function index()
    {

        $user = (object)(new User)->current();

        $_stock = new StockRepository;

        $stocks = $_stock->get($user->agence_id);

        return View::make('stock/index', [
            'stocks'    =>$stocks
        ]);

    }

    public function create()
    {

        $articles = (new ArticleRepository)->get();

        $cmdArticles = (new CommandeRepository)->getCmdArticle();

        $mode = 'create';

        return View::make('stock/create', [
            'articles'  =>$articles,
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

        header('Location: /stock/create');

    }

    public function cart()
    {

        $cmdArticles = (new CommandeRepository)->getCmdArticle();

        $mode = 'cart';

        return View::make('stock/create', [
            'mode'  =>$mode,
            'cmdArticles'  =>$cmdArticles,
        ]);
        
    }

    public function input()
    {

        $user = (object)(new User)->current();

        $data = [
            'agence_id' =>$user->agence_id,
            'dateCmd'    =>$_POST['dateCmd'],
            'status'    =>'4',
        ];

        $_stock = new StockRepository;

        $_stock->input($data);

        header('Location: /stock');

    }


    public function sortie()
    {

        $_stock = new StockRepository;

        $params = Route::params();

        $data = [
            'id_commande' =>$params->id,
        ];

        $_stock->sortie($data);

        header('Location: /commande');

    }

}