<?php

class UserController
{
    public function index()
    {

    }

    public function show(array|int $data)
    {
        echo "Usuário nº{$data[0]}";
    }
}
