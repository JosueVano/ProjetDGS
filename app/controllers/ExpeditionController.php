<?php
namespace App\controllers;

use App\Lib\Route;
use App\Lib\View;
use config\Database;
use app\models\Article;
use App\Repositories\CommandeRepository;
use App\Repositories\ExpeditionRepository;
use App\Repositories\StockRepository;

class ExpeditionController
{

    public function create()
    {

        $_commande = new CommandeRepository;

        $params = Route::params();

        $commandeId = $params->id;

        $commande = $_commande->find($commandeId);
        
        $articles = $_commande->article($commandeId);

        return View::make('commandes/show', [
            'commande'  =>$commande,
            'articles'  =>$articles,
            'mode'  =>'send'
        ]);      

    }

    public function store()
    {

        $_exped = new ExpeditionRepository;

        $_stock = new StockRepository;

        $params = Route::params();

        $commandeId = $params->id;

        $data = [
            'commande_id' =>$commandeId, 
            'date_exp' =>$_POST['dateExp'], 
            'type_trans' =>$_POST['typeTrans'], 
            'ref_exp' =>$_POST['refTrans']
        ];

        $_exped->create($data);

        header('Location: /commande/show?id='.$commandeId);


    }

}