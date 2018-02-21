<?php
/**
 * User: Alex
 * Date: 31.01.2018
 * Time: 21:41
 */

use Framework\Http\Request;

chdir(dirname(__DIR__)); //поднялись в корневую директорию
require 'vendor/autoload.php';

###  initialization
$request = new Request();

### action
$name = isset($request->getQueryParams()['name']) ? $request->getQueryParams()['name'] : 'Guest';

header('X-Developer: AlexMMM');
echo 'Hello, '. $name . '!';