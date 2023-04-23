<?php
declare(strict_types=1);

namespace Soccer\Api\Controller;

use PDOException;
use Soccer\Api\Entity\League;
use Soccer\Api\Repository\LeagueRepository;
use Soccer\Api\Controller\ErrorHandler;

class LeagueController implements Controller
{
    public function __construct(private LeagueRepository $leagueRepository)
    {
    }
    
    public function processRequest(): void
    {
        header('Content-Type: application/json');
        echo json_encode($this->leagueRepository->all());
        http_response_code(200);
    }

    public function store(): void
    {
        $request = file_get_contents('php://input');
        try {
            $leagueData = json_decode($request, true);
            $league = new League(
                $leagueData['referal_league_id'], 
                $leagueData['name'], 
                $leagueData['country'], 
                $leagueData['logo'], 
                $leagueData['flag'],
                $leagueData['createdAt']
            );
            $this->leagueRepository->add($league);
        } catch (PDOException $e) {
            ErrorHandler::WSErro("<b>Erro ao cadastrar:</b> {$e->getMessage()}", $e->getCode());
        }

        http_response_code(201);
    }

    
}