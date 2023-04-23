<?php

namespace Soccer\Api\Controller;

use PDOException;
use Soccer\Api\Entity\Team;
use Soccer\Api\Repository\TeamsRepositoy;

class TeamGetByIdController implements Controller
{

    public function __construct(private TeamsRepositoy $teamsRepositoy)
    {
    }

    public function processRequest(): void
    {
        $this->getById();
    }

    public function store(): void
    {
        
    }

    public function getById(): void
    {
        header('Content-Type: application/json');
        echo json_encode($this->teamsRepositoy->getById());
        http_response_code(200);
    }
}