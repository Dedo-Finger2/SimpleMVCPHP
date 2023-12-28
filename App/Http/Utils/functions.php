<?php

function dd(mixed $data)
{
    echo "<h3>Debug</h3>";
    echo "<hr>";
    echo "<pre>";
    var_dump($data);
    echo "</pre>";
    echo "<hr>";
    die();
}
