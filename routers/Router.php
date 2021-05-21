<?php

namespace App\routers;

class Router {

    private static array $routes = [];
    private static $default;

    public function __construct() {
    }

    public static function setDefault($path, $function) {
        $e = array(
            'path' => $path,
            'function' => $function
        );
        self::$routes[] = $e;
        self::$default = $e;
    }

    public static function set($path, $function) {
        self::$routes[] = array(
            'path' => $path,
            'function' => $function
        );
    }

    public static function dispatch($uri) {
        foreach (self::$routes as $route) {
            if ($route['path'] === parse_url($uri, PHP_URL_PATH)) {
                $route['function']();
                return;
            }
        }
        self::$default['function']();
    }
}