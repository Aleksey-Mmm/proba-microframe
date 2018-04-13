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
use App\Http\Action\AboutAction;
use App\Http\Action\Blog\IndexAction;
use App\Http\Action\Blog\ShowAction;
use App\Http\Action\HelloAction;
use Framework\Http\ActionResolver;
use Framework\Http\Router\Exception\RequestNotMatchedException;
use Framework\Http\Router\RouteCollection;
use Framework\Http\Router\Router;
//use Psr\Http\Message\ServerRequestInterface;
//use Zend\Diactoros\Response\HtmlResponse;
use Zend\Diactoros\Response\JsonResponse;
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

//создаем и заполняем коллекцию маршрутов

$routes = new RouteCollection();


/*$routes->get('home', '/', function (ServerRequestInterface $request){
    $name = isset($request->getQueryParams()['name']) && ($request->getQueryParams()['name'] != '') ? $request->getQueryParams()['name'] : 'Guest';
    return new HtmlResponse('Hello, '. $name. '!');
});*/

$routes->get('home', '/', HelloAction::class);

$routes->get('about', '/about', new AboutAction());

$routes->get('blog', '/blog', IndexAction::class);

$routes->get('blog_show', '/blog/{id}', ShowAction::class, ['id' => '\d+']);

//включаем роутер
$router = new Router($routes);

#Running

$request =  ServerRequestFactory::fromGlobals();

try {
    //находим маршрут по паттерну переданному из строки запроса и вычисляем нужные нам атрибуты
    $result = $router->match($request);
    //добавляем эти атрибуты к строке запроса
    /** @var \Framework\Http\Router\Result $result */
    foreach ($result->getAttributes() as $attribute => $value) {
        $request = $request->withAttribute($attribute, $value);
    }
    //в $action загружаем функцию-обработчик этого маршрута
    $handler = $result->getHandler();
    $action = (new ActionResolver())->resolve($handler);
    //в ответ ($response) результат обработки маршрута этим обработчиком
    $response = $action($request);
} catch (RequestNotMatchedException $e) {
    $response = new JsonResponse(['Error'=>'Undefined page'], 404);
}

### action

//$path = $request->getUri()->getPath();

/*
if ($path === '/') {
    $name = isset($request->getQueryParams()['name']) && ($request->getQueryParams()['name'] != '') ? $request->getQueryParams()['name'] : 'Guest';
    $response = (new HtmlResponse('Hello, '. $name. '!'));
} elseif ($path === '/about') {
    $response = (new HtmlResponse('Это прсто сайт. Страница about.'));

} elseif ($path === '/blog') {
    $response = (new JsonResponse([
        ['id' => 2, 'title' => 'Second page'],
        ['id' => 1, 'title' => 'first Page']
    ]));
} elseif (preg_match('#^/blog/(?P<id>\d+)$#i', $path, $matches)) {
    $id = $matches['id'];
    if ($id > 2) {
        $response = new JsonResponse(['Error'=>'Undefined page'], 404);
    } else {
        $response = new JsonResponse(['id' => $id, 'title' => 'Page #'. $id]);
    }

} else {
    $response = (new JsonResponse(['Error'=>'Undefined page'], 404));
}
*/

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