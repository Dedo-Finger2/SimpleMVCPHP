<?php

trait View
{
    public function view(string $view, array $args)
    {
        extract($args);

        require_once __DIR__ ."/../../Views/$view.php";
    }
}
