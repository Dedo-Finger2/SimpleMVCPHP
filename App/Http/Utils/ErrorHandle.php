<?php

class ErrorHandle
{
    /**
     * Erro a ser mostrado caso uma rota não seja encontrada
     *
     * @return void
     */
    public static function ErrorRouteNotFound()
    {
        echo "<h1>Rota ({$_SERVER['REQUEST_URI']}) não foi encontrada!</h1>";
        die();
    }

    /**
     * Erro a ser mostrado caso a conexão com o banco falhe
     *
     * @param string $message - Menssagem de erro
     * @param integer $code - Código de erro
     * @return void
     */
    public static function ErrorConnectionFailed(string $message, int $code)
    {
        echo "<h1>Ocorreu algum erro na conexão com o banco de dados: $message | $code</h1>";
        die();
    }

    /**
     * Erro a ser mostrado caso não encontre uma view específica
     *
     * @param string $view - Nome da view que não foi encontrada
     * @return void
     */
    public static function ErrorViewNotFound(string $view)
    {
        echo "<h1>A view $view não foi encontrada.</h1>";
        die();
    }
}
