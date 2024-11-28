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

    public function entree()
    {

        $_stock = new StockRepository;

        

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