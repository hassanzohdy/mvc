<?php




$router = new Core\Route();
$router->map("post","get",'PostController#index');
$router->map("home","get",'HomeController#index');


?>