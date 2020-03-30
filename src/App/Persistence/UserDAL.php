<?php
namespace App\Persistence;
use Nautilus\Resources\Database;
use App\Models\User;
use PDO;

class UserDAL
{
    public static function getByUsername(string $username, int $limit=0) : ?User
    {
        if($limit > 0)
            $limit = " LIMIT $limit";
        else
            $limit = '';

        $sql = Database::getConnection()->prepare("
            SELECT
                id, full_name, username,
                pass_hash, email, email_verified_at,
                created_at
            FROM
                users
            WHERE 
                username = :pUsername AND 
                deleted_at IS NULL
            {$limit}");
        $sql->bindParam(':pUsername', $username, PDO::PARAM_STR);
        $sql->execute();
        $result = $sql->fetch(PDO::FETCH_ASSOC);
        $user = null;
        if($result)
        {
            $user = new User($result['id'], $result['full_name'], $result['username'],
                $result['pass_hash'], $result['email'], $result['email_verified_at'], $result['created_at']);
        }
        Database::closeConnection();
        return $user;
    }

    public static function getByEmail(string $email) : ?User
    {
        $sql = Database::getConnection()->prepare("
            SELECT
                id, full_name, username,
                pass_hash, email, email_verified_at,
                created_at
            FROM
                users
            WHERE 
                email = :pEmail AND 
                deleted_at IS NULL
            LIMIT 1");
        $sql->bindParam(':pEmail', $email, PDO::PARAM_STR);
        $sql->execute();
        $result = $sql->fetch(PDO::FETCH_ASSOC);
        $user = null;
        if($result)
        {
            $user = new User($result['id'], $result['full_name'], $result['username'],
                $result['pass_hash'], $result['email'], $result['email_verified_at'], $result['created_at']);
        }

        Database::closeConnection();
        return $user;
    }

    public static function getByStatement(string $where_statement, array $parameters) : ?array
    {
        $sql = Database::getConnection()->prepare("
            SELECT
                id, full_name, username,
                pass_hash, email, email_verified_at,
                created_at
            FROM
                users
            WHERE 
                {$where_statement}");
        $sql->execute($parameters);
        $result = $sql->fetchAll(PDO::FETCH_ASSOC);
        $users = array();
        if($result)
        {
            foreach($result as $row)
            {
                $users[] = new User($row['id'], $row['full_name'], $row['username'],
                    $row['pass_hash'], $row['email'], $row['email_verified_at'], $row['created_at']);
            }
        }

        Database::closeConnection();
        return $users;
    }
}