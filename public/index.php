<?php
require_once __DIR__ . '/../vendor/autoload.php';

use PDO;
use Soccer\Api\Repository\LeagueRepository;
use Soccer\Api\Controller\Error404Controller;
use Soccer\Api\Repository\TeamsRepositoy;

$routes = require_once __DIR__ . '/../src/Routes/leagueRoutes.php';
$routesTeam = require_once __DIR__ . '/../src/Routes/teamRoutes.php';
$protocol = stripos($_SERVER['SERVER_PROTOCOL'],'https') === 0 ? 'https://' : 'http://';
//pegar dinamicamente a URL do site e porta
putenv('SITE_URL='.$protocol.$_SERVER['HTTP_HOST']);

$username = "root";
$password = "";
$pdo = new PDO("mysql:host=localhost;dbname=php_oo", $username, $password);

$leagueRepository = new LeagueRepository($pdo);



$pathInfo = $_SERVER['PATH_INFO'] ?? '/';
$httpMethod = $_SERVER['REQUEST_METHOD'];

$key = "$httpMethod|$pathInfo";


if (array_key_exists($key, $routes)) {
    $controllerClass = $routes["$httpMethod|$pathInfo"];
    $controller = new $controllerClass($leagueRepository);
    $controller->processRequest();
} else {
    $controller = new Error404Controller();
}



//tratamento de rotas para teams
require_once (__DIR__.'/../src/app/Utils/TraitsRoutes.php');
$pdo = null;