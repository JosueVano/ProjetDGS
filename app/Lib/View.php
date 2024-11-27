<?php
namespace App\Lib;

class View
{

    public static function make($name, $params)
    {

        $view =  __DIR__ . '/../../views/'.$name.'.php';

        foreach ($params as $key => $value) {
            
            $$key = $value;
        }
        
        // $header = self::header();

        // $footer = self::footer();

        include $view;        

    }

    public static function header()
    {
        include __DIR__ . '/../../views/header.php';

    }

    public static function footer()
    {

        include __DIR__ . '/../../views/footer.php';

    }

}