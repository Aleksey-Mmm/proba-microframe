<?php
/**
 * User: alexey
 * Date: 27.03.2018
 * Time: 12:40
 */

namespace Framework\Http\Router;


use Framework\Http\Router\Exception\RequestNotMatchedException;
use Framework\Http\Router\Exception\RouteNotFoundException;
use Framework\Http\Router\Route\RegexpRoute;
//use http\Exception\InvalidArgumentException;
use Psr\Http\Message\ServerRequestInterface;

class Router
{
    private $routes;

    public function __construct(RouteCollection $routes)
    {
        $this->routes = $routes;
    }

    public function match(ServerRequestInterface $request)
    {
        /** @var RegexpRoute $route */
        foreach ($this->routes->getRoutes() as $route) {
            $result = $route->match($request);
            if ($result) {
                return $result;
            }
        }
        throw new RequestNotMatchedException($request);
    }

    public function generate($name, $params = [])
    {
        /** @var RegexpRoute $route */
        foreach ($this->routes->getRoutes() as $route) {
            $res = $route->generate($name, $params);
            if ($res) {
                return $res;
            }
        }

        throw new RouteNotFoundException($name, $params);
    }
}