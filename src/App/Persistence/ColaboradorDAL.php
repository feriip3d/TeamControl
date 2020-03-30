<?php
namespace App\Persistence;
use App\Models\Colaborador;
use Nautilus\Resources\Database;
use PDO;

class ColaboradorDAL
{
    public static function getById(int $id) : ?Colaborador
    {
        $sql = Database::getConnection()->prepare("SELECT
                id, nome, telefone,
                celular, data_nascimento, cpf
            FROM
                colaboradores
            WHERE 
                id = :pID");
        $sql->bindParam(':pID', $id, PDO::PARAM_INT);
        $sql->execute();
        $result = $sql->fetch(PDO::FETCH_ASSOC);
        $colaborador = null;
        if($result)
        {
            $colaborador = new Colaborador($result['id'], $result['nome'], $result['telefone'],
                $result['celular'], $result['data_nascimento'], $result['cpf']);
        }
        Database::closeConnection();
        return $colaborador;
    }

    public static function getByStatement(string $where_statement, array $parameters) : ?array
    {
        $sql = Database::getConnection()->prepare("SELECT
                id, nome, telefone,
                celular, data_nascimento, cpf
            FROM
                colaboradores
            WHERE 
                {$where_statement}");
        $sql->execute($parameters);
        $result = $sql->fetchAll(PDO::FETCH_ASSOC);
        $colaboradores = array();
        if($result)
        {
            foreach($result as $row)
            {
                $colaboradores[] = new Colaborador($row['id'], $row['nome'], $row['telefone'],
                    $row['celular'], $row['data_nascimento'], $row['cpf']);
            }
        }

        Database::closeConnection();
        return $colaboradores;
    }

    public static function getInEquipe(int $id) : ?array
    {
        $sql = Database::getConnection()->prepare("SELECT
                colaboradores.id, colaboradores.nome, colaboradores.telefone,
                colaboradores.celular, colaboradores.data_nascimento, colaboradores.cpf
            FROM
                colaboradores
                INNER JOIN eventos_colab ON eventos_colab.id_colab = colaboradores.id
                INNER JOIN equipes ON equipes.id = eventos_colab.id_equipe
            WHERE
                equipes.id = :pIDEquipe");
        $sql->bindParam(':pIDEquipe', $id, PDO::PARAM_INT);
        $sql->execute();
        $result = $sql->fetchAll(PDO::FETCH_ASSOC);
        $colaboradores = array();
        if($result)
        {
            foreach($result as $row)
            {
                $colaboradores[] = new Colaborador($row['id'], $row['nome'], $row['telefone'],
                    $row['celular'], $row['data_nascimento'], $row['cpf']);
            }
        }

        Database::closeConnection();
        return $colaboradores;
    }
}