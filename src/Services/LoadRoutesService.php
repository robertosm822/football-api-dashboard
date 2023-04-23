<?php
namespace Soccer\Api\Services;

use Exception;

class LoadRoutesService
{

  public static function loadTeamRoutes(string $controller, string $action, \PDO $pdo)
  {
    try {
      // se controller existe
      $controllerNamespace = self::classNameSpace($controller);

      if (!class_exists(self::classNameSpace($controller))) {
          throw new Exception("O controller {$controller} não existe");
      }
      $teamRepository = new \Soccer\Api\Repository\TeamsRepositoy($pdo); 
      $controllerInstance = new $controllerNamespace($teamRepository);

      if (!method_exists($controllerInstance, $action)) {
          throw new Exception(
              "O método {$action} não existe no controller {$controller}"
          );
      }

      $controllerInstance->$action((object) $_REQUEST);
    } catch (Exception $e) {
          echo $e->getMessage();
    }
  }

  public static function loadLeagues(string $controller, string $action, \PDO $pdo)
  {
    try {
      // se controller existe
      $controllerNamespace = self::classNameSpace($controller);

      if (!class_exists($controllerNamespace)) {
          throw new Exception("O controller {$controller} não existe");
      }
      $leagueRepository = new \Soccer\Api\Repository\LeagueRepository($pdo); 
      $controllerInstance = new $controllerNamespace($leagueRepository);

      if (!method_exists($controllerInstance, $action)) {
          throw new Exception(
              "O método {$action} não existe no controller {$controller}"
          );
      }

      $controllerInstance->$action((object) $_REQUEST);
    } catch (Exception $e) {
          echo $e->getMessage();
    }
  }

  public static function loadFrontEnd(string $controller, string $action)
  {
    try {
      // se controller existe
      $controllerNamespace = self::classNameSpace($controller);

      if (!class_exists($controllerNamespace)) {
          throw new Exception("O controller {$controller} não existe");
      }
       
      $controllerInstance = new $controllerNamespace();

      if (!method_exists($controllerInstance, $action)) {
          throw new Exception(
              "O método {$action} não existe no controller {$controller}"
          );
      }

      $controllerInstance->$action((object) $_REQUEST);
    } catch (Exception $e) {
          echo $e->getMessage();
    }
  }

  public static function classNameSpace($controller)
  {
    return "Soccer\\Api\\Controller\\{$controller}";
  }
}