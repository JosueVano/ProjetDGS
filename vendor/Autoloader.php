<?php
namespace Vendor;
class Autoloader{
    static function register(){
        spl_autoload_register(array(__CLASS__, 'autoload'));
    

    }

    static function autoload($class) {
        $basePath = __DIR__ . '\..\\'; // Chemin de base vers le répertoire app
        $file = $basePath . str_replace('/', '\\', $class) . '.php';
    
        if (file_exists($file)) {
            require_once $file;
        } else {
            echo 'Erreur du chargement de la classe';
        }
    }
    
}