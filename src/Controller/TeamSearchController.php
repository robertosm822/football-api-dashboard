<?php

namespace Soccer\Api\Controller;

use Error;
use Soccer\Api\Entity\Team;
use Soccer\Api\Repository\TeamsRepositoy;

class TeamSearchController implements Controller
{

    public function __construct(private TeamsRepositoy $teamsRepositoy)
    {
    }

    public function processRequest(): void
    {
        $this->seachByName();
    }

    public function store(): void
    {
        
    }

    public function seachByName(): void
    {
        header('Content-Type: application/json');
        $name = filter_input(INPUT_GET, 'name');
        $team = $this->teamsRepositoy->seachByName($name);
        echo json_encode(['success' => $team]);
        http_response_code(200);
    }
}