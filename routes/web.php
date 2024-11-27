<?php

namespace Routes;

use app\controllers\AgenceController;
use app\controllers\ArticleController;
use app\controllers\ComArticleController;
use app\controllers\CommandeController;
use app\controllers\CommandeTmpController;
use App\controllers\ExpeditionController;
use App\controllers\HomeController;
use App\controllers\LoginController;
use App\controllers\UserController;


class Router {

    protected static $routes = [];

    public static function add($method, $uri, $controller) {
        self::$routes[] = compact('method', 'uri', 'controller');
    }

    public static function match($requestUri, $requestMethod) {

        foreach (self::$routes as $route) {
            
            if ($route['uri'] === $requestUri && $route['method'] === $requestMethod) {
                return explode('@', $route['controller']);
            }
        }

        return null;

    }
}

// Définir des routes
Router::add('GET', '/', HomeController::class .'@home');

Router::add('GET', '/login', LoginController::class .'@login');
Router::add('POST', '/login', LoginController::class .'@store'); // login d'un utilisateur
Router::add('GET', '/logout', LoginController::class .'@logout');


Router::add('GET', '/home', HomeController::class .'@index');

Router::add('GET', '/agence', AgenceController::class .'@index');
Router::add('GET', '/agence/show', AgenceController::class .'@show');

Router::add('POST', '/agence', AgenceController::class .'@index');//pour la zone de recherche
Router::add('GET', '/agence/create', AgenceController::class .'@create'); // Route pour traiter le formulaire d'ajout
Router::add('POST', '/agence/store', AgenceController::class .'@store'); // Route pour traiter le formulaire d'ajout
Router::add('POST', '/delete.agence', AgenceController::class .'@deleteAgence'); // Route pour traiter la suppression
Router::add('POST', '/update.agence', AgenceController::class .'@updateAgence'); // Route pour traiter la modification

Router::add('GET', '/article', ArticleController::class . '@index');
Router::add('POST', '/article', ArticleController::class . '@index');
Router::add('GET', '/article/create', ArticleController::class .'@create'); // Route pour traiter le formulaire d'ajout
Router::add('POST', '/article/store', ArticleController::class .'@store'); // Route pour traiter le formulaire d'ajout
Router::add('POST', '/delete.article', ArticleController::class .'@deleteArticle'); // Route pour traiter la suppression
Router::add('POST', '/update.article', ArticleController::class .'@updateArticle'); // Route pour traiter la modification

Router::add('GET', '/comArticle', ComArticleController::class.'@index');
Router::add('POST', '/comArticle', ComArticleController::class.'@index');
Router::add('POST', '/create.comArticle', ComArticleController::class .'@createComArticle'); // Route pour traiter le formulaire d'ajout
Router::add('POST', '/delete.comArticle', ComArticleController::class .'@deleteComArticle'); // Route pour traiter la suppression
Router::add('POST', '/update.comArticle', ComArticleController::class .'@updateComArticle'); // Route pour traiter la modification

Router::add('GET', '/commande', CommandeController::class .'@index');
Router::add('POST', '/commande', CommandeController::class.'@index');

Router::add('GET', '/commande/show', CommandeController::class.'@show');

Router::add('GET', '/commande/expedier', ExpeditionController::class.'@create');
Router::add('POST', '/commande/expedier/store', ExpeditionController::class.'@store');

Router::add('GET', '/commande/cart/create', CommandeTmpController::class .'@create'); // Route pour traiter le formulaire d'ajout
Router::add('GET', '/commande/cart', CommandeTmpController::class .'@cart'); // Route pour traiter le formulaire d'ajout
Router::add('POST', '/commande/cart/store', CommandeTmpController::class .'@store'); // Route pour traiter le formulaire d'ajout

Router::add('POST', '/commande/store', CommandeController::class .'@store'); // Route pour traiter le formulaire d'ajout
Router::add('POST', '/delete.commande', CommandeController::class .'@deleteCommande'); // Route pour traiter la suppression
Router::add('POST', '/update.commande', CommandeController::class .'@updateCommande'); // Route pour traiter la modification




