<?php

trait View
{
    /**
     * Método que rederiza a view e trata as variáveis dinâmicas enviadas à ela
     *
     * @param string $view - Nome da view
     * @param array $args - Argumentos (variáveis dinâmicas que serão passadas para a view)
     * @return void
     */
    public function view(string $view, array $args)
    {
        if (!file_exists(__DIR__."/../../Views/$view.php")) {
            ErrorHandle::ErrorViewNotFound($view);
        }
        
        extract($args);

        require_once __DIR__ ."/../../Views/$view.php";
    }
}
