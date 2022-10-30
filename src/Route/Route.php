<?php

namespace Mts\Route;


use Mts\Response\Response;

class Route
{
    public static function get($route, $class, $method)
    {
        if (self::checkUrl($route) && self::checkMethod('get')) {
            self::run($class, $method);
        }
    }

    public static function post($route, $class, $method)
    {
        if (self::checkUrl($route) && self::checkMethod('post')) {
            self::run($class, $method);
        }
    }

    public static function checkUrl($route)
    {
        $params = $_SERVER['REQUEST_URI'];
        $params = (stripos($params, "/") !== 0) ? "/" . $params : $params;
        $regex = str_replace('/', '\/', $route);
        $isMatch = preg_match('/^' . ($regex) . '$/', $params, $matches, PREG_OFFSET_CAPTURE);
        return $isMatch;
    }

    public static function checkMethod($method)
    {
        return strtolower($_SERVER['REQUEST_METHOD']) == strtolower($method);
    }

    public static function run($class, $method)
    {
        if (method_exists($class, $method)) {
            (new $class())->{$method}();
        } else {
            (new Response)->status(500)->toJson(['error' => 'method not found']);
        }

    }
}