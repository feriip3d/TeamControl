<?php
namespace Nautilus\Resources;
use Nautilus\Util\EnvironmentHelper;
use PDO;

// Classe de configuração do banco de dados (Singleton/Postgres)
class Database
{
    private static $connection = null;
    public static function getConnection()
    {
        extract(EnvironmentHelper::getEnvByPrefix("DB"));
        if(is_null(self::$connection))
            self::$connection = new PDO(
                "pgsql:host={$DB_HOST};port={$DB_PORT};dbname={$DB_NAME};user={$DB_USER};password={$DB_PASS}"
            );

        return self::$connection;
    }
}