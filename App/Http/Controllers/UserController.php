<?php

require_once __DIR__ ."/Controller.php";

class UserController extends Controller
{
    public function index()
    {

    }

    public function show(array|int $data)
    {
        $id = $data[0];

        $user = User::find($id);

        $this->view("users", [
            'user' => $user,
        ]);

    }
}
