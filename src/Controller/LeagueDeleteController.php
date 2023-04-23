<?php

declare(strict_types=1);

namespace Soccer\Api\Controller;

use PDOException;
use Soccer\Api\Repository\LeagueRepository;
use Soccer\Api\Controller\ErrorHandler;

class LeagueDeleteController implements Controller
{
    public function __construct(private LeagueRepository $leagueRepository)
    {
    }

    public function processRequest(): void
    {
        header('Content-Type: application/json');
        $this->del();
        echo json_encode(['success' => 'Apagado com sucesso']);
    }
    public function store(): void
    {
    }

    public function del(): void
    {
        try {
            $id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
            $this->leagueRepository->delete($id);
        } catch (PDOException $e) {
            ErrorHandler::WSErro("<b>Erro ao apagar:</b> {$e->getMessage()}", $e->getCode());
        }

        http_response_code(200);
    }
}
