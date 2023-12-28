<?php

require_once __DIR__ ."/Controller.php";

class HomeController extends Controller
{
    public function index()
    {
        $this->view("home", [
            'title' => 'Home Page',
            'user' => 'Greg',
        ]);
    }
}
