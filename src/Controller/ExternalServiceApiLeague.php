<?php

namespace Soccer\Api\Controller;

use Error;
use GuzzleHttp\Client;
use Soccer\Api\Entity\League;
use Soccer\Api\Repository\LeagueRepository;

class ExternalServiceApiLeague implements Controller
{
    public function __construct(private LeagueRepository $leagueRepository)
    {
    }

    public function serviceSoccerExternal()
    {

        $url = 'https://api-football-v1.p.rapidapi.com/v2/leagues/type/league/brazil/2023?timezone=America/Sao_Paulo';
        $headers = [
            'headers' => [
                'Accept'     => 'application/json',
                'x-rapidapi-key' => '4e081b6d5dmsh213846c08567d5fp1151c8jsn53cc4b1d7139',
            ]
        ];
        $client = new Client(['base_uri' => $url,'verify' => false]);
        $response = $client->request('GET', '', $headers);

        return json_decode($response->getBody()->getContents(), true);
    }

    public function processRequest(): void
    {
        $this->store();
    }

    public function store(): void
    {
        //Fake result
        $leagueData =  [
            "api" =>
            [
                "leagues" => [
                    0 => [
                        "league_id" => 4883,
                        "name"  => "Gaúcho - 1",
                        "country" => "Brazil",
                        "logo" => "https://media-3.api-sports.io/football/leagues/477.png",
                        "flag" => "https://media-2.api-sports.io/flags/br.svg",
                    ],
                    1 =>
                    [
                        "league_id" => 4884,
                        "name" => "Carioca - 1",
                        "logo" => "https://media-1.api-sports.io/football/leagues/624.png",
                        "flag" => "https://media-3.api-sports.io/flags/br.svg",
                    ]
                ]
            ]
        ];
        header('Content-Type: application/json');
        try {
            //consumindo a API Football
            $leagueDataArray = $this->serviceSoccerExternal();

            //varrer endpoint para gravar conteúdo em banco
            foreach ($leagueDataArray['api']['leagues'] as $data) {
                //var_dump($data['league_id']);
                $league = new League(
                    $data['league_id'],
                    $data['name'],
                    $data['country'],
                    $data['logo'],
                    $data['flag'],
                    date('Y-m-d H:i:s')
                );
                $this->leagueRepository->add($league);
            }
            echo json_encode(['success' => 'Leagues inseridas com sucesso!']);
            http_response_code(500);
        } catch (Error $e) {
            echo json_encode(['error' => 'Ocorreu um erro de implementação']);
            http_response_code(500);
            return;
        }
    }
}
