<?php

error_reporting(E_ALL);
ini_set("display_errors",1);

require_once __DIR__."/App/Models/Core/Core.php";
require_once __DIR__."/App/Http/Router/routes.php";

// Carregando tudo que precisa ser carregado
spl_autoload_register(function ($file) {
    if (file_exists(__DIR__."/App/Http/Utils/$file.php")) {
        require_once __DIR__."/App/Http/Utils/$file.php";
    } else if (file_exists(__DIR__."/App/Models/$file.php")) {
        require_once __DIR__."/App/Models/$file.php";
    }
});

// Executando as rotas
Core::run($routes);
