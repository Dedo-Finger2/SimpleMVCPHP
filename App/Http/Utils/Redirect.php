<?php

final class Redirect
{
    private static string $url = "";
    private static array $data = [];

    public static function redirect(string $url)
    {
        self::$url = $url;

        return new self();
    }

    public static function with(array $data)
    {
        self::$data = $data;

        return new self();
    }

    public static function run()
    {
        session_start();
    
        foreach (self::$data as $var => $value) {
            $_SESSION[$var] = $value;
        }
    
        header("Location: " . self::$url);
    }
    
}
