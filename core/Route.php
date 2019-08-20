<?php

namespace Core;
use App\Controllers ;
class Route {
    public  $routes = array();
    public  $validTypes = array(
        "get",
        "post"
    );
    public $base = "/oop/";


    public  function __call($name , $args)
    {
        if(in_array(strtoupper($name), self::$validTypes))
        {
            print "okay";
        //   $this->invalidMethodHandler();
        }
    }

    public  function map($route,$type, $function, $name = null) 
    {
        $this->routes[] = array(
          "route" => $route,
          "type" =>$type,
          "function" => $function,
          "name" =>$name,
        );   
       

        $this->generate($_SERVER['REQUEST_URI'],$route,$function);

         
    }

    public function generate($uri,$route,$function)
    {
     
      if ($uri == $this->base.$route) {
        preg_match('/([A-z])\w+/', $function, $output_array);
        
        $class = $output_array[0];
        preg_match('/(#[A-z])\w+/', $function, $output_array);
        $classFunction = ltrim($output_array[0],"#");

        if(file_exists('./app/Controllers/'.$class.'.php')){
          
          require_once './app/Controllers/'.$class.'.php';
          $tempClass = new $class();
          try {
            $tempClass->$classFunction();
          } catch (\Throwable $th) {
           print $th;
          }
            
        } else {
          throw new \Exception("Error Wrong class name", 1);
          
        }

        
        
      }
      
    }

  
}