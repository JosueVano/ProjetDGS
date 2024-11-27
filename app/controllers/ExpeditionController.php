<?php
namespace App\controllers;

use App\Lib\Route;
use App\Lib\View;
use config\Database;
use app\models\Article;
use App\Repositories\CommandeRepository;

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

}