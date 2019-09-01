<?php
use Core\Request;

function redirect($url)
{
    // print_r("{$_SERVER['SERVER_NAME']}/oop{$url}");
    header("Location: /oop{$url}");
    die();
}

function view(string $path , $data = null) {
        
    require "./static/views/".$path.".php";
}









