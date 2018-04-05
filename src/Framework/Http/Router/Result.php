<?php
/**
 * User: malkov alexey
 * Date: 27.03.2018
 * Time: 13:29
 *
 * используем вместо асоциативного массива с результатами.
 */

namespace Framework\Http\Router;


class Result
{
    private $name;
    private $handler;
    private $attributes;

    public function __construct($name, $handler, $attributes)
    {
        $this->name = $name;
        $this->handler = $handler;
        $this->attributes = $attributes;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getHandler()
    {
        return $this->handler;
    }

    public function getAttributes()
    {
        return $this->attributes;
    }
}