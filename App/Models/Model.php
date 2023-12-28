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

    public static function create(array $data)
    {
        try {
            $fields = array_keys($data);
            $fieldsString = implode(",", $fields);
        
            $values = array_values($data);
        
            // Crie uma string com o número correto de marcadores de posição (?)
            $prepareValuesString = implode(",", array_fill(0, count($values), "?"));
        
            $stm = Database::getConnection()->prepare("INSERT INTO " . static::$table . " ($fieldsString) VALUES ($prepareValuesString)");
        
            // Execute a consulta preparada com os valores correspondentes
            $stm->execute($values);

            return true;
        } catch (PDOException $e) {
            LogErrors::log($e);
            echo "Erro ao inserir dados: " . $e->getMessage();
        }
    }

    public static function update(array $data)
    {
        try {
            $id = $data['id'];
            unset($data['id']);
    
            $fields = array_keys($data);
            $values = array_values($data);
    
            // Crie uma string para a parte SET da instrução UPDATE
            $setClause = implode("=?, ", $fields) . "=?";
    
            $stm = Database::getConnection()->prepare("UPDATE " . static::$table . " SET $setClause WHERE id = ?");
    
            // Adicione o valor do campo de condição (ID) ao final do array $values
            $values[] = $id;
    
            // Execute a consulta preparada com os valores correspondentes
            $stm->execute($values);

            return true;
        } catch (PDOException $e) {
            LogErrors::log($e);
            echo "Erro ao atualizar dados: " . $e->getMessage();
        }
    }

    public static function delete(array $data)
    {
        try {
            $stm = Database::getConnection()->prepare("DELETE FROM " . static::$table . " WHERE id = ?");
            $stm->bindParam(1, $data[0], PDO::PARAM_INT);
            $stm->execute();

            return true;
        } catch (PDOException $e) {
            LogErrors::log($e);
            echo "Erro ao excluir dados: " . $e->getMessage();
        }
    }
}
