<?php
namespace App\Http\Action\Blog;

use Zend\Diactoros\Response\JsonResponse;

/**
 * User: malkov alexey
 * Date: 09.04.2018
 * Time: 12:28
 */

class IndexAction
{
    public function __invoke()
    {
        return new JsonResponse([
            ['id' => 2, 'title' => 'Second page'],
            ['id' => 1, 'title' => 'first Page']
        ]);
    }
}