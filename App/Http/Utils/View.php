<?php

class View
{
    public static function render(string $view, array $args)
    {
        extract($args);

        require_once __DIR__ ."/../../Views/$view.php";
    }
}
