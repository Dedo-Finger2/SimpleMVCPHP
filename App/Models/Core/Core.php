<?php

final class Core
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
        $url = ($_SERVER['REQUEST_URI'] != "/") ? $url = rtrim($_SERVER['REQUEST_URI'], '/') : $_SERVER['REQUEST_URI'];

        // Identificador de rotas
        $routerFound = false;

        try {
            // Para cada rota, criar o padrão específico com a URI no array associativo
            foreach ($routes as $path => $controller) {
                
                // Expressão regular
                $pattern = "#^". preg_replace('/{id}/', '([\w-])', $path) ."$#";

                // Se encontrar um valor númerico, então ...
                if (preg_match($pattern, $url, $matches)) {
                    // Removendo a URI e deixando apenas o valor passado dentro de {id} no array
                    array_shift($matches);
                    
                    $routerFound = true;

                    // Desestruturando o array associativo com rotas e controller@método
                    [$controllerName, $method] = explode("@", $controller);

                    // Instanciando um novo objeto e chamando o método de acordo com o que tem no array $routes
                    require_once __DIR__."/../../Http/Controllers/$controllerName.php";
                    $controllerInstance = new $controllerName();
                    $controllerInstance->$method($matches);
                }
            }
            
            if (!$routerFound) {
                require_once __DIR__."/../../Http/Utils/ErrorHandle.php";

                ErrorHandle::ErrorRouteNotFound();
            }
        } catch (Exception $e) {
            LogErrors::log($e);
        }
    }
}
