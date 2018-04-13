<?php
/**
 * User: malkov alexey
 * Date: 13.04.2018
 * Time: 12:12
 */

namespace Framework\Http;


class ActionResolver
{
    public function resolve($handler)
    {
        return is_string($handler) ? new $handler : $handler;
    }
}