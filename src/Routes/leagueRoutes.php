<?php

declare(strict_types=1);

return [
    'GET|/api/leagues' => \Soccer\Api\Controller\LeagueController::class,
    'POST|/api/leagues' => \Soccer\Api\Controller\LeagueSaveController::class,
    'GET|/api/leagues-by-id/' => \Soccer\Api\Controller\LeagueGetInfoController::class,
    'GET|/api/leagues-save-massive' => \Soccer\Api\Controller\ExternalServiceApiLeague::class,
    'POST|/api/leagues/edit/' => \Soccer\Api\Controller\LeagueEditController::class,
    'DELETE|/api/leagues/delete/' => \Soccer\Api\Controller\LeagueDeleteController::class,
    'GET|/api/leagues/search/' => \Soccer\Api\Controller\LeagueSearchController::class,
    
];  
