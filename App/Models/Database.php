<?php

class Database
{
    private static ?PDO $connection = null;

    public static function getConnection()
    {
        $config = require_once __DIR__ ."/../../database.config.php";

        try {
            if (self::$connection === null) {
                self::$connection = new PDO(
                    "mysql:dbname={$config['DB_NAME']};host={$config['HOST']}",
                    $config['DB_USER'],
                    $config['DB_PASS']
                );
                self::$connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            }

            return self::$connection;
        } catch (PDOException $e) {
            echo $e->getMessage();
            return null; // Retorna null se a conexão falhar
        }
    }
}
