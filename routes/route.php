<?php

use Core\Route;


$route = new Route();
$route->add("get","/home","HomeController@index");
$route->add("get","/posts/:id","PostController@index");
$route->add("get", "/test","HomeController@test")




?>