<?php

namespace Soccer\Api\Controller;

use Soccer\Api\Repository\LeagueRepository;

class LeagueSearchController implements Controller
{

    public function __construct(private LeagueRepository $leagueRepositoy)
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
        $league = $this->leagueRepositoy->seachByName($name);
        echo json_encode(['success' => $league]);
        http_response_code(200);
    }
}