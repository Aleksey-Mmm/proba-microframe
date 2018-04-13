<?php
/**
 * User: malkov alexey
 * Date: 09.04.2018
 * Time: 10:30
 */

namespace Framework\Http\Router\Route;

use Psr\Http\Message\ServerRequestInterface;

interface Route
{
    public function match(ServerRequestInterface $request);

    public function generate($name, $params=[]);
}