<?php

namespace Soccer\Api\Controller;

use Error;
use Soccer\Api\Repository\LeagueRepository;

class LeagueGetInfoController implements Controller
{
    public function __construct(private LeagueRepository $leagueRepository)
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
        try {
            header('Content-Type: application/json');
            $league = $this->leagueRepository->getById();
            if ($league === false) {
                echo json_encode(['error' => 'Id inexistente.']);
                http_response_code(422);
                return;
            }
            echo json_encode($league);
            http_response_code(200);
        } catch (\PDOException $e) {
            echo json_encode(['error' => $e]);
            http_response_code(500);
            return;
        }catch (\Exception $e) {
            echo json_encode(['error' => $e]);
            http_response_code(500);
            return;
        }catch (Error $e) {
            echo json_encode(['error' => 'Ocorreu um erro de implementação']);
            http_response_code(500);
            return;
        }
        
    }
}