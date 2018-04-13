<?php

namespace tests\App\Http\Action;


use App\Http\Action\HelloAction;
use PHPUnit\Framework\TestCase;
use Zend\Diactoros\ServerRequest;

/**
 * User: malkov alexey
 * Date: 09.04.2018
 * Time: 13:58
 */

class HelloActionTest extends TestCase
{
    /**
     *
     */
    public function testGuest()
    {
        $action = new HelloAction();
        $request = new ServerRequest();
        $response = $action($request);

        self::assertEquals(200, $response->getStatusCode());
        self::assertEquals('Hello, Guest!', $response->getBody()->getContents());
    }

    public function testJohn()
    {
        $action = new HelloAction();
        $request = (new ServerRequest())->withQueryParams(['name'=>'John']);

        $response = $action($request);

        self::assertEquals(200, $response->getStatusCode());
        self::assertEquals('Hello, John!', $response->getBody()->getContents());

    }
}