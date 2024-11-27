<?php
 function asset($path)
 {

    echo 'http://'.$_SERVER['HTTP_HOST'].'/'.$path;

 }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Stock</title>
    <link rel="stylesheet" href="<?php asset('css/style.css') ?>">
    <link rel="stylesheet" href="<?php asset('css/icons-font.css') ?>">
</head>
<body>
    <div class="flex flex-col min-h-screen">

        <div class="flex  items-center text-white text-opacity-40 h-12 bg-sky-800">
            <div class="flex justify-center h-12 items-center px-3 w-44 bg-black bg-opacity-10">
                <button id="btnModuleMenu">
                    <i class="fal fa-bars"></i>
                </button>
                <div class="hidden lg:ml-3 lg:block font-bold text-xl w-72 uppercase">
                    STOCK
                </div>
            </div>
        <div class="felx flex-1 px-10">
            <div class="flex items-center justify-between space-x-3">
                <div class="flex">
                    <div>
                        <a href="/" class="flex items-center dropdown-toggle h-12 hover:bg-opacity-70 px-3 uppercase">
                            Accueil
                        </a>
                    </div>
                    <div>
                        <a href="/agence" class="flex items-center dropdown-toggle h-12 hover:bg-opacity-70 px-3 uppercase">
                            Agences
                        </a>
                    </div>
                    <div>
                        <a href="/article" class="flex items-center dropdown-toggle h-12 hover:bg-opacity-70 px-3 uppercase">
                            Articles
                        </a>
                    </div>
                    <div>
                        <a href="/commande" class="flex items-center dropdown-toggle h-12 hover:bg-opacity-70 px-3 uppercase">
                            Commandes
                        </a>
                    </div>
                    <div>
                        <a href="/stock" class="flex items-center dropdown-toggle h-12 hover:bg-opacity-70 px-3 uppercase">
                            Stock
                        </a>
                    </div>
                </div>
                <div>
                    <a href="/logout">Déconnecter</a>
                </div>
            </div>
        </div>
    </div>