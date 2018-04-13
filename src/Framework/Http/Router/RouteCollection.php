<?php
/**
 * User: alexey
 * Date: 27.03.2018
 * Time: 11:55
 */

namespace Framework\Http\Router;




use Framework\Http\Router\Route\RegexpRoute;
use Framework\Http\Router\Route\Route;

class RouteCollection
{
    private $routes = [];

    public function addRoute(Route $route)
    {
        $this->routes[] = $route;
    }

    /**
     * @param $name
     * @param $pattern   //шаблон пути
     * @param $handler   //обработчик
     * @param array $tokens  //доп. обработка(регулярные выражения)
     */
    public function any($name, $pattern, $handler, $tokens = [])
    {
        $this->addRoute(new RegexpRoute($name, $pattern, $handler, [], $tokens));
        //$this->routes[] = new Route($name, $pattern, $handler, [], $tokens);
    }

    public function get($name, $pattern, $handler, $tokens = [])
    {
        $this->addRoute(new RegexpRoute($name, $pattern, $handler, ['GET'], $tokens));
    }

    public function post($name, $pattern, $handler, $tokens = [])
    {
        $this->addRoute(new RegexpRoute($name, $pattern, $handler, ['POST'], $tokens));
    }

    /**
     * @return array Route[]
     */
    public function getRoutes()
    {
        return $this->routes;
    }
}