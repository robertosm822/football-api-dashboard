<?php

use Soccer\Api\Services\LoadRoutesService;

$router = [
  "GET" => [
    "/api/teams/list" => fn () => LoadRoutesService::loadTeamRoutes('TeamListController', 'processRequest', $pdo),
    "/api/leagues" => fn () => LoadRoutesService::loadLeagues('LeagueController', 'processRequest', $pdo),
    "/api/leagues-by-id/" => fn () => LoadRoutesService::loadLeagues('LeagueGetInfoController', 'processRequest', $pdo),
    "/api/leagues-save-massive" => fn () => LoadRoutesService::loadLeagues('ExternalServiceApiLeague', 'processRequest', $pdo),
    "/api/leagues/search/" => fn () => LoadRoutesService::loadLeagues('LeagueSearchController', 'processRequest', $pdo),
    "/league/index" => fn () => LoadRoutesService::loadFrontEnd('HomeController','indexLeague'),
    "/teams/index" => fn () => LoadRoutesService::loadFrontEnd('HomeController','indexTeams'),
    "/api/teams/save-massive" => fn () => LoadRoutesService::loadTeamRoutes('TeamSaveMassiveController', 'processRequest', $pdo),
    "/api/teams/list/" => fn () => LoadRoutesService::loadTeamRoutes('TeamListController','processRequest', $pdo),
    "/api/teams/search/" => fn () => LoadRoutesService::loadTeamRoutes('TeamSearchController','processRequest', $pdo),
    "/api/teams/get-by-id/" => fn () => LoadRoutesService::loadTeamRoutes('TeamGetByIdController','processRequest', $pdo),
    
  ],
  "POST" => [
    "/api/leagues" => fn () => LoadRoutesService::loadLeagues('LeagueSaveController', 'processRequest', $pdo),
    "/api/leagues/edit/" => fn () => LoadRoutesService::loadLeagues('LeagueEditController', 'processRequest', $pdo),
    "/api/teams/save" => fn () => LoadRoutesService::loadTeamRoutes('TeamSaveController','processRequest', $pdo),
    "/api/teams/edit/" => fn () => LoadRoutesService::loadTeamRoutes('TeamEditController', 'processRequest', $pdo),
  ],
  "DELETE" => [
    "/api/leagues/delete/" => fn () => LoadRoutesService::loadLeagues('LeagueDeleteController', 'processRequest', $pdo),
    "/api/teams/delete/" => fn () => LoadRoutesService::loadTeamRoutes('TeamDeleteController', 'processRequest', $pdo),    
  ],
];