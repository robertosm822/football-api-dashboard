<?php
require_once __DIR__ . '/../vendor/autoload.php';


$protocol = stripos($_SERVER['SERVER_PROTOCOL'],'https') === 0 ? 'https://' : 'http://';
//pegar dinamicamente a URL do site e porta
putenv('SITE_URL='.$protocol.$_SERVER['HTTP_HOST']);

$username = "root";
$password = "";
$pdo = new PDO("mysql:host=localhost;dbname=php_oo", $username, $password);

require_once __DIR__ . '/../router/router.php';
//tratamento das rotas a serem criadas em /routes/router.php
try {
    $uri = parse_url($_SERVER["REQUEST_URI"])["path"];
    $request = $_SERVER["REQUEST_METHOD"];
  
    if (!isset($router[$request])) {
      throw new Exception("A rota não existe");
    }
  
    if (!array_key_exists($uri, $router[$request])) {
      throw new Exception("A rota não existe");
    }
  
    $controller = $router[$request][$uri];
    $controller();
  } catch (Exception $e) {
    $e->getMessage();
  }
  
//limpar objeto de conexao
$pdo = null;