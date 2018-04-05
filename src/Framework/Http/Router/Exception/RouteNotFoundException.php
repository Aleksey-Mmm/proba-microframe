<?php
/**
 * User: malkov alexey
 * Date: 02.04.2018
 * Time: 12:19
 */

namespace Framework\Http\Router\Exception;


use Throwable;

class RouteNotFoundException extends \LogicException
{
    private $name;
    private $params;

    public function __construct($name, $params)
    {
        parent::__construct('Route '. $name. ' not found');

        $this->name = $name;
        $this->params = $params;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getParams()
    {
        return $this->params;
    }
}