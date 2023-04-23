<?php


if($key == 'GET|/api/teams/save-massive' || $key == 'GET|/api/teams/save-massive/'){
    $controllerTeamClass =  $routesTeam["$httpMethod|$pathInfo"];
    $controllerTeams = new $controllerTeamClass($teamRepository);
    $controllerTeams->processRequest($pdo);
}
if($key === 'GET|/api/teams/list' || $key === 'GET|/api/teams/list/'){
    $teamRepository = new Soccer\Api\Repository\TeamsRepositoy($pdo); 
    $controllerTeams = new Soccer\Api\Controller\TeamListController($teamRepository);
    $controllerTeams->processRequest();
    exit();
}

if($key === 'POST|/api/teams/save' || $key === 'POST|/api/teams/save/'){
    $teamRepository = new Soccer\Api\Repository\TeamsRepositoy($pdo); 
    $controllerTeams = new \Soccer\Api\Controller\TeamSaveController($teamRepository);
    $controllerTeams->processRequest();
    exit();
}
if($key === 'GET|/api/teams/get-by-id' || $key === 'GET|/api/teams/get-by-id/'){
    $teamRepository = new Soccer\Api\Repository\TeamsRepositoy($pdo);
    $controllerTeams = new \Soccer\Api\Controller\TeamGetByIdController($teamRepository);
    $controllerTeams->processRequest();
    exit();
}
if($key === 'GET|/league/index'){
    $controllerTeams = new Soccer\Api\Controller\HomeController();
    $controllerTeams->indexLeague();
    exit();
}
if($key === 'GET|/teams/index'){
    $controllerTeams = new Soccer\Api\Controller\HomeController();
    $controllerTeams->indexTeams();
    exit();
}

if($key === 'POST|/api/teams/edit/' || $key === 'POST|/api/teams/edit'){
    $teamRepository = new Soccer\Api\Repository\TeamsRepositoy($pdo);
    $controllerTeams = new \Soccer\Api\Controller\TeamEditController($teamRepository);
    $controllerTeams->processRequest();
}
if($key === 'DELETE|/api/teams/delete/' || $key === 'DELETE|/api/teams/delete'){
    $teamRepository = new Soccer\Api\Repository\TeamsRepositoy($pdo);
    $controllerTeams = new \Soccer\Api\Controller\TeamDeleteController($teamRepository);
    $controllerTeams->processRequest();
}

if($key === 'GET|/api/teams/search/' || $key === 'GET|/api/teams/search/'){
    $teamRepository = new Soccer\Api\Repository\TeamsRepositoy($pdo);
    $controllerTeams = new \Soccer\Api\Controller\TeamSearchController($teamRepository);
    $controllerTeams->processRequest();
}




