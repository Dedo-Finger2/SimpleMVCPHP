<?php

class Database
{
    private static ?PDO $connection = null;

    public static function getConnection()
    {
        $config = require_once __DIR__ ."/../../database.config.php";
        extract($config);

        try {
            if (self::$connection === null) {
                self::$connection = new PDO(
                "mysql:dbname=$DB_NAME; host=$HOST",
                $DB_USER, 
                $DB_PASS
            );
            }

            return self::$connection;
        } catch (PDOException $e) {
            echo $e->getMessage();
            die();
        }
    }
}
