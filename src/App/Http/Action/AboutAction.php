<?php
namespace App\Http\Action;

use Zend\Diactoros\Response\HtmlResponse;

/**
 * User: malkov alexey
 * Date: 09.04.2018
 * Time: 12:25
 */

class AboutAction
{
    public function __invoke()
    {
        return new HtmlResponse('Это прсто сайт. Страница about.');
    }
}