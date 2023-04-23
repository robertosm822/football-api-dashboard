<?php

declare(strict_types=1);

namespace Soccer\Api\Repository;

use Soccer\Api\Entity\League;
use PDO;

class LeagueRepository
{
    public function __construct(private PDO $pdo)
    {
    }

    public function add(League $league): bool
    {
        $sql = 'INSERT INTO leagues (referal_league_id, `name`, country, logo, flag, createdAt) VALUES (:referal_league_id, :name, :country, :logo, :flag, :createdAt)';
        $statement = $this->pdo->prepare($sql);
        $statement->bindValue(':referal_league_id', $league->referalLeagueId);
        $statement->bindValue(':name', $league->name);
        $statement->bindValue(':country', $league->country);
        $statement->bindValue(':logo', $league->logo);
        $statement->bindValue(':flag', $league->flag);
        $statement->bindValue(':createdAt', date('Y-m-d H:i:s'));

        $result = $statement->execute();
        $id = $this->pdo->lastInsertId();

        $league->setId(intval($id));

        return $result;
    }

    /**
     * @return []
     */
    public function all(): array
    {
        $leagueList = $this->pdo
            ->query('SELECT * FROM leagues;')
            ->fetchAll(\PDO::FETCH_ASSOC);
        return $leagueList;
    }

    public function getById()
    {
        
        $id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
       
        if ($id == false && $id == null) {
            return ['error' => 'Id de League inválido'];
        }
        $league = $this->find($id);

        return $league;
    }

    public function find(int $id)
    {
        $statement = $this->pdo->prepare('SELECT * FROM leagues WHERE id = ?;');
        $statement->bindValue(1, $id, \PDO::PARAM_INT);
        $statement->execute();

        return $statement->fetch(\PDO::FETCH_ASSOC);
    }

    public function edit(int $id, array $dataArray)
    {
        $statement = $this->pdo->prepare('UPDATE leagues SET updatedAt = :updatedAt, `name` = :name, country = :country, logo = :logo, flag = :flag WHERE id = :id;');
        $statement->bindValue(':id', (int)$id,PDO::PARAM_INT);
        $statement->bindValue(':name', $dataArray['name'], PDO::PARAM_STR);
        $statement->bindValue(':country', $dataArray['country'],PDO::PARAM_STR);
        $statement->bindValue(':logo', $dataArray['logo'],PDO::PARAM_STR);
        $statement->bindValue(':flag', $dataArray['flag'],PDO::PARAM_STR);
        $statement->bindValue(':updatedAt', date('Y-m-d H:i:s'),PDO::PARAM_STR);
        $result = $statement->execute();
        if ($result) {
            return ['sucess'=> 'Editado com sucesso'];
        }
        return ['error'=> 'Ocorreu um erro na edição'];
        
    }

    public function seachByName($name)
    {
        $name = "%$name%";
        $statement = $this->pdo->prepare('SELECT * FROM leagues WHERE name like :name;');
        $statement->bindValue(':name', $name, \PDO::PARAM_STR);
        $statement->execute();
        $data = $statement->fetchAll(\PDO::FETCH_ASSOC);
      
        return $data;
    }

    public function delete(int $id)
    {
        $statement = $this->pdo->prepare('DELETE FROM leagues WHERE id = ?;');
        $statement->bindValue(1, (int)$id, \PDO::PARAM_INT);
        $result = $statement->execute();
        if ($result) {
            return ['sucess'=> 'Apagado com sucesso'];
        }
        return ['error'=> 'Ocorreu um erro na edição'];
    }
}
