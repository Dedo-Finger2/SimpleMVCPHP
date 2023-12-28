<?php

error_reporting(E_ALL);
ini_set("display_errors",1);

require_once __DIR__."/App/Models/Core/Core.php";
require_once __DIR__."/App/Http/Router/routes.php";

Core::run($routes);
