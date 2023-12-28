<?php

require_once __DIR__ ."/Controller.php";

class HomeController extends Controller
{
    public function index()
    {
        $users = User::all();
        
        $this->view("home", [
            'title' => 'Home Page',
            'users' => $users,
        ]);
    }
}
