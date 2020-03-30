<?php
namespace Nautilus\Resources;
use Nautilus\Util\EnvironmentHelper;
use PDO;

// Classe de configuração do banco de dados (Singleton Postgres/MariaDB)
class Database
{
    private static $connection = null;
    public static function getConnection()
    {
        extract(EnvironmentHelper::getEnvByPrefix("DB"));
        if(is_null(self::$connection))
        {
            switch($DB_TYPE)
            {
                case "pgsql":
                    self::$connection = new PDO(
                        "pgsql:host={$DB_HOST};port={$DB_PORT};dbname={$DB_NAME};user={$DB_USER};password={$DB_PASS}"
                    );
                    break;

                case "mariadb":
                    self::$connection = new \PDO(
                        "mysql:dbname={$DB_NAME};host={$DB_HOST};port={$DB_PORT};charset=utf8",
                        $DB_USER, $DB_PASS
                    );

                    self::$connection->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
                    self::$connection->setAttribute(\PDO::ATTR_EMULATE_PREPARES, false);
                    break;
            }
        }

        return self::$connection;
    }

    public static function closeConnection()
    {
        if(!is_null(self::$connection))
        {
            // De acordo com a doc. do php, a conexao com o banco é encerrada assim que o objeto PDO deixa de existir
            self::$connection = null;
        }
    }
}