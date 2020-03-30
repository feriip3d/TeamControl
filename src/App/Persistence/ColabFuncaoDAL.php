<?php
namespace App\Persistence;
use App\Models\ColabFuncao;
use Nautilus\Resources\Database;
use PDO;


class ColabFuncaoDAL
{
    public static function getById(int $id) : ?ColabFuncao
    {
        $sql = Database::getConnection()->prepare("SELECT
                id, nome
            FROM
                colab_funcoes
            WHERE 
                id = :pID");
        $sql->bindParam(':pID', $id, PDO::PARAM_INT);
        $sql->execute();
        $result = $sql->fetch(PDO::FETCH_ASSOC);
        $funcao = null;
        if($result)
        {
            $funcao = new ColabFuncao($result['id'], $result['nome']);
        }
        Database::closeConnection();
        return $funcao;
    }

    public static function getByStatement(string $where_statement, array $parameters) : ?array
    {
        $sql = Database::getConnection()->prepare("SELECT
                id, nome
            FROM
                colab_funcoes
            WHERE 
                {$where_statement}");
        $sql->execute($parameters);
        $result = $sql->fetchAll(PDO::FETCH_ASSOC);
        $funcoes = array();
        if($result)
        {
            foreach($result as $row)
            {
                $funcoes[] = new ColabFuncao($row['id'], $row['nome']);
            }
        }

        Database::closeConnection();
        return $funcoes;
    }
}