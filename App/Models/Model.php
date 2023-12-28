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

}
