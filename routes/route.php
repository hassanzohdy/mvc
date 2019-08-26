<?php




$router = new Core\Route();
// $router->get("home",'HomeController@index');
// $router->get("/home/aa",'HomeController@index');
$router->post("home",'HomeController@create');
$router->post("/test",'TestController@create');
// $router->get("mega",'PostController#index');
$router->post("home",'HomeController#index');
$router->get("/home/aa/:id",'HomeController@index');
$router->get("/alaa",'HomeController@index');


?>