<?php
namespace Core;

class AlaaRoute {

    public $routes = array();

    public function map($route,$type,$action,$name= null){
        $this->routes[] = array($route,$type,$action,$name);
        


    }

}
?>