<?php

declare(strict_types=1);

return [
    'GET|/api/teams/list/' => \Soccer\Api\Controller\TeamListController::class,
    'GET|/api/teams/save-massive' => \Soccer\Api\Controller\TeamSaveMassiveController::class,
    'GET|/api/teams/search' => \Soccer\Api\Controller\TeamSearchController::class,
    'GET|/league/index' => \Soccer\Api\Controller\HomeController::class,
]; 