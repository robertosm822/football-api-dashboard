<?php
declare(strict_types=1);

namespace Soccer\Api\Repository;

use Soccer\Api\Entity\Team;
use PDO;

class TeamsRepositoy
{
    public function __construct(private PDO $pdo)
    {
    }

    public function add(Team $team): bool
    {
        $sql = 'INSERT INTO teams (`referal_team_id`, `name`, `country`, `logo`, `createdAt`) VALUES (:referal_team_id, :name, :country, :logo, :createdAt)';
        $statement = $this->pdo->prepare($sql);
        $statement->bindValue(':referal_team_id', $team->referalTeamId);
        $statement->bindValue(':name', $team->name);
        $statement->bindValue(':country', $team->country);
        $statement->bindValue(':logo', $team->logo);
        $statement->bindValue(':createdAt', date('Y-m-d H:i:s'));

        $result = $statement->execute();

        return $result;
    }

    /**
     * @return []
     */
    public function all(): array
    {
        $teamList = $this->pdo
            ->query('SELECT * FROM teams;')
            ->fetchAll(\PDO::FETCH_ASSOC);
        return $teamList;
    }

    /**
     * @return []
     */
    public function allLeague(): array
    {
        $allLeague = $this->pdo
            ->query('SELECT * FROM leagues;')
            ->fetchAll(\PDO::FETCH_ASSOC);
        return $allLeague;
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
        $statement = $this->pdo->prepare('SELECT * FROM teams WHERE id = ?;');
        $statement->bindValue(1, $id, \PDO::PARAM_INT);
        $statement->execute();

        return $statement->fetch(\PDO::FETCH_ASSOC);
    }

    public function seachByName($name)
    {
        $name = "%$name%";
        $statement = $this->pdo->prepare('SELECT * FROM teams WHERE name like ?;');
        $statement->bindValue(1, $name, \PDO::PARAM_STR);
        $statement->execute();

        return $statement->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function update()
    {
        
    }
    public function edit(int $id, array $dataArray)
    {
        $statement = $this->pdo->prepare('UPDATE teams SET updatedAt = :updatedAt, `name` = :name, country = :country, logo = :logo, league = :league WHERE id = :id;');
        $statement->bindValue(':id', (int)$id,PDO::PARAM_INT);
        $statement->bindValue(':name', $dataArray['name'], PDO::PARAM_STR);
        $statement->bindValue(':country', $dataArray['country'],PDO::PARAM_STR);
        $statement->bindValue(':logo', $dataArray['logo'],PDO::PARAM_STR);
        $statement->bindValue(':league', $dataArray['league'],PDO::PARAM_STR);
        $statement->bindValue(':updatedAt', date('Y-m-d H:i:s'),PDO::PARAM_STR);
        $result = $statement->execute();
        if ($result) {
            return ['sucess'=> 'Editado com sucesso'];
        }
        return ['error'=> 'Ocorreu um erro na edição'];
        
    }

    public function delete(int $id)
    {
        $statement = $this->pdo->prepare('DELETE FROM teams WHERE id = ?;');
        $statement->bindValue(1, (int)$id, \PDO::PARAM_INT);
        $result = $statement->execute();
        if ($result) {
            return ['sucess'=> 'Apagado com sucesso'];
        }
        return ['error'=> 'Ocorreu um erro na edição'];
    }
}