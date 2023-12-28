<?php

class Model extends Database
{
    protected static string $table = "";

    public static function all()
    {
        $stm = Database::getConnection()->query("SELECT * FROM ". static::$table);

        if ($stm->rowCount() > 0) {
            return $stm->fetchAll(PDO::FETCH_ASSOC);
        } else {
            return [];
        }
    }

    public static function find(int $id)
    {
        try {
            $stm = Database::getConnection()->prepare("SELECT * FROM ". static::$table . " WHERE ". static::$table."_id = ?");
            $stm->execute([$id]);

        } catch (PDOException) {
            try {
                $stm = Database::getConnection()->prepare("SELECT * FROM ". static::$table . " WHERE id = ?");
                $stm->execute([$id]);
            } catch (PDOException $e) {
                echo $e->getMessage();
                die();
            }
        }

        return $stm->fetch(PDO::FETCH_ASSOC);
    }

}
