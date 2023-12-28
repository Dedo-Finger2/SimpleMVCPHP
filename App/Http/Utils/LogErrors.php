<?php

class LogErrors
{
    /**
     * Método que trata a exceção pelo seu tipo
     *
     * @param Exception|PDOException $e - Objeto do tipo exeption ou pdoexception
     * @return void
     */
    public static function log(Exception|PDOException $e)
    {
        if ($e instanceof PDOException) {
            self::pdoLog($e);
        } else {
            self::regularLog($e);
        }
    }

    /**
     * Método que trata o log de erros Exception
     *
     * @param Exception $e - Objeto
     * @return void
     */
    private static function regularLog(Exception $e)
    {
        $logMessage = sprintf(
            "[%s] %s in %s on line %d. Code: %d\n%s\n",
            date('Y-m-d H:i:s'),
            $e->getMessage(),
            $e->getFile(),
            $e->getLine(),
            $e->getCode(),
            $e->getTraceAsString()
        );

        file_put_contents(__DIR__."/../../Log/log.txt", $logMessage, FILE_APPEND);
    }

    /**
     * Método que trata o log de erros PDOException
     *
     * @param PDOException $e - Objeto
     * @return void
     */
    private static function pdoLog(PDOException $e)
    {
        $logMessage = sprintf(
            "[%s] %s in %s on line %d. Code: %d\n%s\n",
            date('Y-m-d H:i:s'),
            $e->getMessage(),
            $e->getFile(),
            $e->getLine(),
            $e->getCode(),
            $e->getTraceAsString()
        );

        file_put_contents(__DIR__."/../../Log/pdoLog.txt", $logMessage, FILE_APPEND);
    }
}
