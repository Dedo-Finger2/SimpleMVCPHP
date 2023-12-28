<?php

class Model extends Database
{
    // Nome da tabela que modelo representa
    protected static string $table = "";

    /**
     * Método que retorna todas as ocorrências da tabela
     *
     * @return array
     */
    public static function all()
    {
        $stm = Database::getConnection()->query("SELECT * FROM ". static::$table);

        if ($stm->rowCount() > 0) {
            return $stm->fetchAll(PDO::FETCH_OBJ);
        } else {
            return [];
        }
    }

    /**
     * Método usado para encontrar uma ocorrência específica através de um ID no banco de dados
     *
     * @param integer $id - ID da ocorrẽncia sendo buscada
     * @return array
     */
    public static function find(int $id)
    {
        // Tenta primeiro com um padrão de id seguindo o nome da tabela _id
        try {
            $stm = Database::getConnection()->prepare("SELECT * FROM ". static::$table . " WHERE ". static::$table."_id = ?");
            $stm->execute([$id]);

        } catch (Exception) {
            // Caso não dê certo, usar apenas o nome ID para representar o id da tabela
            try {
                $stm = Database::getConnection()->prepare("SELECT * FROM ". static::$table . " WHERE id = ?");
                $stm->execute([$id]);
            } catch (PDOException $e) {
                LogErrors::log($e);
                echo $e->getMessage();
                die();
            }
        }

        return $stm->fetch(PDO::FETCH_OBJ);
    }

}
