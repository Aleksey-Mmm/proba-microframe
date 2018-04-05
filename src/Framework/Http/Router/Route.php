<?php
/**
 * User: alexey
 * Date: 27.03.2018
 * Time: 12:04
 *
 * используется вместо ассоциативного массива
 *
 */

namespace Framework\Http\Router;


class Route
{
    public $name;
    public $pattern;
    public $handler;
    public $tokens;
    public $methods;

    public function __construct($name, $pattern, $handler, $methods, $tokens=[])
    {
        $this->name = $name;
        $this->pattern = $pattern;
        $this->handler = $handler;
        $this->methods = $methods;
        $this->tokens = $tokens;
    }

}