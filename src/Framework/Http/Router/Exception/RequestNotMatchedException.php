<?php
/**
 * User: malkov alexey
 * Date: 02.04.2018
 * Time: 11:32
 */

namespace Framework\Http\Router\Exception;


use Psr\Http\Message\ServerRequestInterface;

class RequestNotMatchedException extends \LogicException
{
    private $request;

    public function __construct(ServerRequestInterface $request)
    {
        parent::__construct('Matches not found.');
        $this->request = $request;
    }

    public function getRequest()
    {
        return $this->request;
    }
}