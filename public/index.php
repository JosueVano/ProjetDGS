<?php

namespace Public;

use App\Lib\Route;
use Vendor\Autoloader;
use Routes\Router;
use App\Lib\View;

// Chargement de l'autoloader 
require '../vendor/Autoloader.php';

Autoloader::register();

// Définir les constantes de l'application
define('APP_ROOT', dirname(__FILE__));


// Inclusion des fichiers de configuration
require_once APP_ROOT . '/../config.php';

// Chargement des routes
require_once APP_ROOT . '/../routes/web.php';


function asset($path)
{

   echo 'http://'.$_SERVER['HTTP_HOST'].'/'.$path;

}

// Récupération de la route correspondante
$route = Router::match(Route::path(), Route::method());

// Vérification si la route existe
if ($route) {

    list($controllerName, $methodName) = $route;
    
    // Instanciation du contrôleur
    $controller = new $controllerName();
    
    // Appel de la méthode du contrôleur
    call_user_func_array([$controller, $methodName], []);

} else {
    // Gérer l'erreur 404
    http_response_code(404);
    echo "404 - Page not found";
}
