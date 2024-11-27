<?php
namespace App\Lib;

class Route
{


    public static function uri()
    {
        return $_SERVER['REQUEST_URI'];
    }

    public static function method()
    {
        return $_SERVER['REQUEST_METHOD'];
    }

    public static function path()
    {

        $parsedUrl = parse_url(self::uri());

        return key_exists('path', $parsedUrl) ? $parsedUrl['path'] : null;

    }

    public static function params()
    {

        $parsedUrl = parse_url(self::uri());

        if (isset($parsedUrl['query'])) {
            
            parse_str($parsedUrl['query'], $params);

            return (object)$params;

        }

        return null;

    }

}