<?php

namespace Core;
use App\Controllers ;
use Core\Request;
class Route {
    /**
     * Undocumented variable
     *
     * @var array
     */
    public $allRoutes = array();
    protected $postRoutes = array();
    protected $getRoutes = array();
    
    public $base = "/oop/";
    

    
    /**
     * add the routes to array of all routes and every method array
     *
     * @param [type] $type
     * @param [type] $uri
     * @param [type] $route
     * @param [type] $action
     * @param [type] $name
     * @return void
     */
    public  function map($type, $uri, $route, $action, $name = null) 
    {    
        
        $type = ($type . "Routes");
        $this->allRoutes = array("route" => $route);
        $this->$type = array(
          "route" => $route,
          "action" => $action,
          "name" =>$name,
        );  
       
        $this->generate($uri,$route,$action,$type);

         
    }

    /**
     *  check for correct route then load it's controller
     *
     * @param [type] $uri
     * @param [type] $route
     * @param [type] $function
     * @param [type] $type
     * @return void
     */
    public function generate($uri,$route,$function,$type)
    { 
      if (in_array($route, $this->$type) && $uri == $this->base.$route){
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
    
    /**
     * get  function  check the methof of the request
     * then call map function
     * 
     * @param string $route
     * @param string $action
     * @param string $name
     * @return void
     */
    public function get (string $route,string $action,string $name = NULL){

        if ($_SERVER["REQUEST_METHOD"] == "GET"){         
           $uri =  $_SERVER['REQUEST_URI'];
           return $this->map("get",$uri,$route,$action,$name);

        }
        
      
    }

    /**
     * post  function  check the methof of the request
     * then call map function
     *
     * @param string $route
     * @param string $action
     * @param string $name
     * @return void
     */
    public function post (string $route,string $action,string $name = NULL){
      if ($_SERVER["REQUEST_METHOD"] == "POST"){  
        $uri =  $_SERVER['REQUEST_URI'];
        return $this->map("post",$uri,$route,$action,$name);
      } 
    }

  
}