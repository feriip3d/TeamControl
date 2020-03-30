<?php
namespace App\Persistence;
use App\Models\ColabFuncao;
use App\Models\Colaborador;
use App\Models\Evento;
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
                colaboradores.celular, colaboradores.data_nascimento, colaboradores.cpf,
                eventos_colab.id_funcao
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
                    $row['celular'], $row['data_nascimento'], $row['cpf'], $row['id_funcao']);
            }
        }

        Database::closeConnection();
        return $colaboradores;
    }

    public static function getNotInEquipe(int $id) : ?array
    {
        $sql = Database::getConnection()->prepare("SELECT
                colab.id, colab.nome, colab.telefone,
                colab.celular, colab.data_nascimento, colab.cpf
            FROM
                colaboradores colab
            WHERE
                colab.id NOT IN (
                    SELECT
                		c.id
            		FROM
                		colaboradores c
                		INNER JOIN eventos_colab ON eventos_colab.id_colab = c.id
                		INNER JOIN equipes ON equipes.id = eventos_colab.id_equipe
            		WHERE
                		equipes.id = :pIDEquipe
                )");
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

    public static function insertIntoEquipe(Colaborador $colab, ColabFuncao $funcao, Evento $evento, int $valor) : bool
    {
        $colab = $colab->getId();
        $evento = $evento->getId();
        $funcao = $funcao->getId();

        $sql = Database::getConnection()->prepare("INSERT INTO eventos_colab
        (
            id_colab, id_funcao, id_equipe, valor_pago
        ) VALUES (
            :pIdColab, :pIdFuncao, :pIdEquipe, :pValorPago
        )");
        $sql->bindParam(':pIdColab', $colab, PDO::PARAM_INT);
        $sql->bindParam(':pIdFuncao', $funcao, PDO::PARAM_INT);
        $sql->bindParam(':pIdEquipe', $evento, PDO::PARAM_INT);
        $sql->bindParam(':pValorPago', $valor, PDO::PARAM_STR);

        $success = $sql->execute();
        Database::closeConnection();

        if($success)
            return true;

        return false;
    }

    public static function removeFromEquipe(int $colab_id, int $evento_id)
    {
        $sql = Database::getConnection()->prepare("DELETE FROM eventos_colab 
            INNER JOIN equipes ON equipes.id = eventos_colab.id_equipe
            WHERE id_colab = :pIdColab AND
            id_evento = :pIdEvento");
        $sql->bindParam(':pIdColab', $colab_id, PDO::PARAM_INT);
        $sql->bindParam(':pIdEvento', $evento_id, PDO::PARAM_INT);
        $success = $sql->execute();
        Database::closeConnection();

        if($success)
            return true;

        return false;
    }
}