<?php
namespace App\Http\Action\Blog;

use Psr\Http\Message\ServerRequestInterface;
use Zend\Diactoros\Response\JsonResponse;

/**
 * User: malkov alexey
 * Date: 09.04.2018
 * Time: 12:30
 */

class ShowAction
{
    public function __invoke(ServerRequestInterface $request)
    {
        $id = $request->getAttribute('id');
        if ($id > 5) {
            return new JsonResponse(['Error'=>'Undefined blog'], 404);
        }
        return new JsonResponse(['id' => $id, 'title' => 'Page #'. $id]);
    }
}