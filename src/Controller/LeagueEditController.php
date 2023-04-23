<?php
declare(strict_types=1);

namespace Soccer\Api\Controller;

use PDOException;
use Soccer\Api\Repository\LeagueRepository;
use Soccer\Api\Controller\ErrorHandler;

class LeagueEditController implements Controller
{
    public function __construct(private LeagueRepository $leagueRepository)
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
            $leagueData = json_decode($request, true);
            $id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
            $league = [
                'referal_league_id' => (int)$leagueData['referal_league_id'], 
                'name' => $leagueData['name'], 
                'country' => $leagueData['country'], 
                'logo' => $leagueData['logo'], 
                'flag' => $leagueData['flag'],
            ];
            $this->leagueRepository->edit($id, $league);
        } catch (PDOException $e) {
            ErrorHandler::WSErro("<b>Erro ao cadastrar:</b> {$e->getMessage()}", $e->getCode());
        }

        http_response_code(200);
    }

    
}