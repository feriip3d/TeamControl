<?php
namespace App\Persistence;
use App\Models\Local;
use Nautilus\Resources\Database;
use PDO;

class LocalDAL
{
    public static function getById(int $id) : ?Local
    {
        $sql = Database::getConnection()->prepare("SELECT
                id, nome, endereco
            FROM
                locais
            WHERE 
                id = :pID");
        $sql->bindParam(':pID', $id, PDO::PARAM_INT);
        $sql->execute();
        $result = $sql->fetch(PDO::FETCH_ASSOC);
        $local = null;
        if($result)
        {
            $local = new Local($result['id'], $result['nome'], $result['endereco']);
        }
        Database::closeConnection();
        return $local;
    }

    public static function getByStatement(string $where_statement, array $parameters) : ?array
    {
        $sql = Database::getConnection()->prepare("SELECT
                id, nome, endereco
            FROM
                locais
            WHERE 
                {$where_statement}");
        $sql->execute($parameters);
        $result = $sql->fetchAll(PDO::FETCH_ASSOC);
        $locais = array();
        if($result)
        {
            foreach($result as $row)
            {
                $locais[] = new Local($row['id'], $row['nome'], $row['endereco']);
            }
        }

        Database::closeConnection();
        return $locais;
    }
}