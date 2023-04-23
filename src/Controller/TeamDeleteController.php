<?php
declare(strict_types=1);

namespace Soccer\Api\Controller;

use PDOException;
use Soccer\Api\Repository\TeamsRepositoy;
use Soccer\Api\Controller\ErrorHandler;

class TeamDeleteController implements Controller
{
    public function __construct(private TeamsRepositoy $teamsRepository)
    {
    }
    
    public function processRequest(): void
    {
        header('Content-Type: application/json');
        $this->del();
        echo json_encode(['success'=> 'Apagado com sucesso']);
    }
    public function store(): void
    {
        
    }

    public function del(): void
    {
        try {
            $id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
            
            $this->teamsRepository->delete($id);
        } catch (PDOException $e) {
            ErrorHandler::WSErro("<b>Erro ao apagar:</b> {$e->getMessage()}", $e->getCode());
        }

        http_response_code(200);
    }

    
}