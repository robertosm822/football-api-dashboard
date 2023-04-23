<?php
declare(strict_types=1);

namespace Soccer\Api\Controller;

use PDOException;
use Soccer\Api\Repository\TeamsRepositoy;
use Soccer\Api\Controller\ErrorHandler;

class TeamEditController implements Controller
{
    public function __construct(private TeamsRepositoy $teamRepository)
    {
    }
    
    public function processRequest(): void
    {
        header('Content-Type: application/json');
        $this->store();
        echo json_encode(['success'=> 'Editado com sucesso']);
    }

    public function store(): void
    {
        $request = file_get_contents('php://input');
        try {
            $teamData = json_decode($request, true);
            $id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
            $team = [
                'referal_team_id' => (int)$teamData['referal_team_id'], 
                'name' => $teamData['name'], 
                'country' => $teamData['country'], 
                'logo' => $teamData['logo'], 
                'league' => $teamData['league'],
            ];
            $this->teamRepository->edit($id, $team);
        } catch (PDOException $e) {
            ErrorHandler::WSErro("<b>Erro ao cadastrar:</b> {$e->getMessage()}", $e->getCode());
        }

        http_response_code(200);
    }

    
}