<?php

class ErrorHandle
{
    public static function ErrorRouteNotFound()
    {
        echo "Rota <b>{$_SERVER['REQUEST_URI']}</b> não foi encontrada!";
    }
}
