<?php
/**
 * User: Alex
 * Date: 31.01.2018
 * Time: 21:41
 */

//use Framework\Http\Request;
//use Framework\Http\RequestFactory;
//use Zend\Diactoros\Response;
//use Framework\Http\ResponseSender;
use Zend\Diactoros\Response\HtmlResponse;
use Zend\Diactoros\Response\SapiEmitter;
use Zend\Diactoros\ServerRequestFactory;

chdir(dirname(__DIR__)); //поднялись в корневую директорию
require 'vendor/autoload.php';

###  initialization
//$request = new Request($_GET, $_POST);
//==========
//$request = (new Request())->withQueryParams($_GET)->withParsedBody($_POST);
//$request->withQueryParams($_GET);
//$request->withParsedBody($_POST);
//==========
$request =  ServerRequestFactory::fromGlobals();

### action
$name = isset($request->getQueryParams()['name']) && ($request->getQueryParams()['name'] != '') ? $request->getQueryParams()['name'] : 'Guest';

$response = (new HtmlResponse('Hello, '. $name. '!'));
    //->withHeader('X-Developer', 'AlexMmm');
//header('X-Developer: AlexMMM');

### postprocessing

$response = $response->withHeader('X-Developer', 'AlexMmm');

### sending

//header('HTTP/1.0 '. $response->getStatusCode(). ' '. $response->getReasonPhrase());

//echo 'Hello, '. $name . '!';
//echo $response->getBody();

//(new ResponseSender())->send($response);

$emitter = new SapiEmitter();
$emitter->emit($response);