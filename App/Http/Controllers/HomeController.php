<?php

require_once __DIR__ ."/Controller.php";
include_once __DIR__ ."/../Utils/functions.php";

class HomeController extends Controller
{
    public function index()
    {
        $users = User::all();
        
        dd($users);

        $this->view("home", [
            'title' => 'Home Page',
            'users' => $users,
        ]);
    }
}
