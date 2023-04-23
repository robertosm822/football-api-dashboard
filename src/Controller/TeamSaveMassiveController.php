<?php

namespace Soccer\Api\Controller;

use Error;
use GuzzleHttp\Client;
use Soccer\Api\Entity\Team;
use Soccer\Api\Repository\LeagueRepository;
use Soccer\Api\Repository\TeamsRepositoy;
use PDO;

class TeamSaveMassiveController implements Controller
{

    public function __construct(private TeamsRepositoy $teamsRepositoy)
    {
    }

    public function processRequest(): void
    {
        $this->store();
    }

    public function store(): void
    {
        header('Content-Type: application/json');
        try {
            $id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
            //varrendo o banco para resgatar o referal_league_id
            $allTeamsArray = $this->teamsRepositoy->allLeague();
            $leagueDataArray = [];

                      
            foreach ($allTeamsArray as $dataArray) {
                array_push($leagueDataArray,$this->serviceFootballExternal($dataArray['referal_league_id']));
            }

            //varrer endpoint para gravar conteúdo em banco
            foreach ($leagueDataArray as $data) {
                $league = new Team(
                    $data['api']['teams'][0]['team_id'], 
                    $data['api']['teams'][0]['name'], 
                    $data['api']['teams'][0]['country'], 
                    $data['api']['teams'][0]['logo'], 
                    date('Y-m-d H:i:s')
                );
                $this->teamsRepositoy->add($league);
            }

            echo json_encode(['success' => 'Teams inseridas com sucesso!']);
            http_response_code(200);
        }catch (Error $e) {
            echo json_encode(['error' => 'Ocorreu um erro de implementação']);
            http_response_code(500);
            return;
        }
    }

    public function serviceFootballExternal($id)
    {
        
        $url = 'https://api-football-v1.p.rapidapi.com/v2/teams/league/'.$id;
        $headers = [
            'headers' => [
                'Accept'     => 'application/json',
                'x-rapidapi-key'=>'4e081b6d5dmsh213846c08567d5fp1151c8jsn53cc4b1d7139',
            ]
        ];
        $client = new Client(['base_uri' => $url,'verify' => false]);
        $response = $client->request('GET', '',$headers);
        
        return json_decode($response->getBody()->getContents(), true);
    }
}