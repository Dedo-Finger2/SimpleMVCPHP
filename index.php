<?php

require_once __DIR__."/App/Models/Core/Core.php";
require_once __DIR__."/App/Http/Router/routes.php";

Core::run($routes);
