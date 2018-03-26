<?php
/**
 * User: alexey
 * Date: 22.02.2018
 * Time: 12:58
 */

namespace Tests\Framework\Http;

//use Framework\Http\Request;
use PHPUnit\Framework\TestCase;
use Zend\Diactoros\Response;
use Zend\Diactoros\Response\HtmlResponse;

class RequestTest extends TestCase
{
/*    protected function setUp()
    {
        //эта ф-я в phpunit автоматом выполняется перед каждым тестом
        //в данном случае - просто обнуление суперглобальных переменных
        parent::setUp();

        $_GET = [];
        $_POST = [];
    }*/

    public function test200()
    {

        $response = new HtmlResponse($body = 'Body');

        self::assertEquals($body, $response->getBody()->getContents());
        self::assertEquals(200, $response->getStatusCode());
        self::assertEquals('OK', $response->getReasonPhrase());
        //self::assertNull($request->getParsedBody());
    }

    public function test404()
    {
            //$request = (new Request)->withQueryParams($data = ['name' => 'Vasiliy', 'age' => 28]);
        $response = new HtmlResponse($body = 'Empty', $status = 404);

        self::assertEquals($body, $response->getBody()->getContents());
        self::assertEquals(mb_strlen($body), $response->getBody()->getSize());
        self::assertEquals(404, $response->getStatusCode());
        self::assertEquals('Not Found', $response->getReasonPhrase());
            //self::assertEquals($data, $request->getQueryParams());
            //self::assertNull($request->getParsedBody());
    }

    public function testHeaders()
      {

            //$request = (new Request)->withParsedBody($data = ['title' => 'Заголовок']);
          $response = (new Response())
              ->withHeader($name1 = 'X-header-1', $value1 = 'value_1')
              ->withHeader($name2 = 'X-header-2', $value2 = 'value_2');

            self::assertEquals([$name1=>[$value1], $name2=>[$value2]], $response->getHeaders());
            //self::assertEquals($data, $request->getParsedBody());
    }
}