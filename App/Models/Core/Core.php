<?php

class Core
{
    /**
     * Método responsável por executar as rotas
     *
     * @param array $routes - Um array com rotas 'rota' => [Controller]
     * @return void
     */
    public static function run(array $routes)
    {
        // URL sendo requisitada
        $url = $_SERVER['REQUEST_URI'];

        // Para cada rota, criar o padrão específico com a URI no array associativo
        foreach ($routes as $path => $controller) {
            
            // Expressão regular
            $pattern = "#^". preg_replace('/{id}/', '([\w-])', $path) ."$#";

            // Se encontrar um valor númerico, então ...
            if (preg_match($pattern, $url, $matches)) {
                // Removendo a URI e deixando apenas o valor passado dentro de {id} no array
                array_shift($matches);
                
                // Desestruturando o array associativo com rotas e controller@método
                [$controllerName, $method] = explode("@", $controller);

                // Instanciando um novo objeto e chamando o método de acordo com o que tem no array $routes
                require_once __DIR__."/../../Http/Controllers/$controllerName.php";
                $controllerInstance = new $controllerName();
                $controllerInstance->$method();
            }
        }

    }
}
