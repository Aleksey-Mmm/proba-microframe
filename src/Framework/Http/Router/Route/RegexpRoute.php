<?php
/**
 * User: alexey
 * Date: 27.03.2018
 * Time: 12:04
 *
 * используется вместо ассоциативного массива
 *
 */

namespace Framework\Http\Router\Route;


use Framework\Http\Router\Result;
use InvalidArgumentException;
use Psr\Http\Message\ServerRequestInterface;

class RegexpRoute implements Route
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

    public function match(ServerRequestInterface $request)
    {

        if ($this->methods && !in_array($request->getMethod(), $this->methods, true)) {
            return null;
        }
        $pattern = preg_replace_callback('~\{([^\}]+)\}~', function ($matches) {
            $argument = $matches[1];
            $replace = $this->tokens[$argument] ? $this->tokens[$argument] : '[^}]+';
            return '(?P<' . $argument . '>' . $replace . ')';
        }, $this->pattern);

        $path = $request->getUri()->getPath();
        if (preg_match('~^' . $pattern . '$~i', $path, $matches)) {
            $res = new Result(
                $this->name,
                $this->handler,
                $m = array_filter($matches, 'is_string', ARRAY_FILTER_USE_KEY)
            );
            // var_dump($m);
            return $res;
        }
        return null;
    }

    public function generate($name, $params = [])
    {
        $arguments = array_filter($params);

        if ($name !== $this->name) {
            return null;
        }

        $url = preg_replace_callback('~\{([^\}]+)\}~', function ($matches) use (&$arguments) {
            $argument = $matches[1];
            if (!array_key_exists($argument, $arguments)) {
                throw new InvalidArgumentException('Missing parameter "' . $argument . '"');
            }
            return $arguments[$argument];
        }, $this->pattern);

        if ($url !== null) {
            return $url;
        }

        return null;
    }

}