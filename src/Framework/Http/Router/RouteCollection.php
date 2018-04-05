<?php
/**
 * User: alexey
 * Date: 27.03.2018
 * Time: 11:55
 */

namespace Framework\Http\Router;


class RouteCollection
{
    private $routes = [];

    /**
     * @param $name
     * @param $pattern   //шаблон пути
     * @param $handler   //обработчик
     * @param array $tokens  //доп. обработка(регулярные выражения)
     */
    public function any($name, $pattern, $handler, $tokens = [])
    {
        $this->routes[] = new Route($name, $pattern, $handler, [], $tokens);
    }

    public function get($name, $pattern, $handler, $tokens = [])
    {
        $this->routes[] = new Route($name, $pattern, $handler, ['GET'], $tokens);
    }

    public function post($name, $pattern, $handler, $tokens = [])
    {
        $this->routes[] = new Route($name, $pattern, $handler, ['POST'], $tokens);
    }

    /**
     * @return array Route[]
     */
    public function getRoutes()
    {
        return $this->routes;
    }
}