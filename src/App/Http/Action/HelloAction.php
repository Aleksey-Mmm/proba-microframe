<?php

namespace App\Http\Action;

use Psr\Http\Message\ServerRequestInterface;
use Zend\Diactoros\Response\HtmlResponse;

/**
 * User: malkov alexey
 * Date: 09.04.2018
 * Time: 12:20
 */

class HelloAction
{
    public function __invoke(ServerRequestInterface $request)
    {
        $name = isset($request->getQueryParams()['name']) && ($request->getQueryParams()['name'] != '') ? $request->getQueryParams()['name'] : 'Guest';
        return new HtmlResponse('Hello, '. $name. '!');
    }
}