<?php

class Database
{
    // Conexão com o banco de dados
    private static ?PDO $connection = null;

    /**
     * Método que retorna/cria uma conexão com o banco de dados usando as variáveis de configuração
     * no arquivo database.config.php
     *
     * @return null|PDO
     */
    public static function getConnection() 
    {
        // Arquivo de configuração
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
            LogErrors::log($e);
            ErrorHandle::ErrorConnectionFailed($e->getMessage(), $e->getCode());
        }
    }
}
