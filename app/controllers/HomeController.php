<?php

namespace App\controllers;

use App\Lib\View;

class HomeController {
    public function home() 
    {
        
        return View::make('home', [

        ]);
        
    }
}