<?php
/**
 *
 * User: alexey
 * Date: 08.02.2018
 * Time: 13:15
 */

namespace Framework\Http;

class Request
{
    public function getQueryParams()
    {
        return $_GET;
    }

    public function getParsedBody()
    {
        return isset($_POST) ? $_POST : null;
    }
}