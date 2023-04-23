<?php

namespace Soccer\Api\Controller;

use PDOException;
use Soccer\Api\Entity\Team;
use Soccer\Api\Repository\TeamsRepositoy;

class TeamSaveController implements Controller
{
    public function __construct(private TeamsRepositoy $teamsRepositoy)
    {
    }

    public function processRequest(): void
    {
        header('Content-Type: application/json');
        $this->store();
    }

    public function store(): void
    {
        $request = file_get_contents('php://input');
        try {
            $leagueData = json_decode($request, true);
            $league = new Team(
                $leagueData['referal_team_id'],
                $leagueData['name'],
                $leagueData['country'],
                $leagueData['logo'],
                $leagueData['createdAt']
            );
            $this->teamsRepositoy->add($league);
            echo json_encode(['sucess' => 'Criado com sucesso']);
            http_response_code(201);
        } catch (PDOException $e) {
            ErrorHandler::WSErro("<b>Erro ao cadastrar:</b> {$e->getMessage()}", $e->getCode());
            http_response_code(422);
            exit();
        }
    }
}
