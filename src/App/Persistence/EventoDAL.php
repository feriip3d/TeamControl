<?php
namespace App\Persistence;
use App\Models\Evento;
use Nautilus\Resources\Database;
use PDO;

class EventoDAL
{
    public static function getByStatement(string $where_statement, array $parameters) : ?array
    {
        $sql = Database::getConnection()->prepare("SELECT
                id, descricao, data_evento,
                qtde_pessoas, local_evento, categ_evento
            FROM
                eventos
            WHERE 
                {$where_statement}");
        $sql->execute($parameters);
        $result = $sql->fetchAll(PDO::FETCH_ASSOC);
        $eventos = array();
        if($result)
        {
            foreach($result as $row)
            {
                $eventos[] = new Evento($row['id'], $row['descricao'], $row['data_evento'],
                    $row['qtde_pessoas'], $row['local_evento'], $row['categ_evento']);
            }
        }

        Database::closeConnection();
        return $eventos;
    }

    public static function getById(int $id) : ?Evento
    {
        $sql = Database::getConnection()->prepare("SELECT
                id, descricao, data_evento,
                qtde_pessoas, local_evento, categ_evento
            FROM
                eventos
            WHERE 
                id = :pID");
        $sql->bindParam(':pID', $id, PDO::PARAM_INT);
        $sql->execute();
        $result = $sql->fetch(PDO::FETCH_ASSOC);
        $evento = null;
        if($result)
        {
            $evento = new Evento($result['id'], $result['descricao'], $result['data_evento'],
                $result['qtde_pessoas'], $result['local_evento'], $result['categ_evento']);
        }
        Database::closeConnection();
        return $evento;
    }
}