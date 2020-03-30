<?php
namespace App\Persistence;
use App\Models\Categoria;
use Nautilus\Resources\Database;
use PDO;

class CategoriaDAL
{
    public static function getById(int $id) : ?Categoria
    {
        $sql = Database::getConnection()->prepare("SELECT
                id, descricao, valor
            FROM
                categorias
            WHERE 
                id = :pID");
        $sql->bindParam(':pID', $id, PDO::PARAM_INT);
        $sql->execute();
        $result = $sql->fetch(PDO::FETCH_ASSOC);
        $categoria = null;
        if($result)
        {
            $categoria = new Categoria($result['id'], $result['descricao'], $result['valor']);
        }
        Database::closeConnection();
        return $categoria;
    }

    public static function getByStatement(string $where_statement, array $parameters) : ?array
    {
        $sql = Database::getConnection()->prepare("SELECT
                id, descricao, valor
            FROM
                categorias
            WHERE 
                {$where_statement}");
        $sql->execute($parameters);
        $result = $sql->fetchAll(PDO::FETCH_ASSOC);
        $categorias = array();
        if($result)
        {
            foreach($result as $row)
            {
                $categorias[] = new Categoria($row['id'], $row['descricao'], $row['valor']);
            }
        }

        Database::closeConnection();
        return $categorias;
    }
}