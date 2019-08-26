<?php

namespace Core;
use App\Controllers ;
use Core\Request;
/**
 * Route class responsiple for routing the app
 */
class Route {
   
    public $allRoutes = array();
    protected $postRoutes = array();
    protected $getRoutes = array();
    public $request;
    
    public $base = "/oop/";
    


    /**
     * Construct  of the class
     * making new request object
     */
    public function __construct(){
      $this->request = new Request();
    }
    
    /**
     * add the routes to array of all routes and every method array
     * call load method
     * @param [string] $type
     * @param [string] $route
     * @param [type] $action
     * @param [string] $name
     * @return void
     */
    public  function map(string $type,string $route, $action,string $name = null) 
    {            
        $type = ($type . "Routes");
        $pattern = $this->generatePattern($route);
        $this->allRoutes = array("route" => $pattern);
        $arguments =  $this->getArguments($pattern);
        $this->$type = array(
          "route" => $route,
          "action" => $action,
          "name" =>$name,
          "arg" => $arguments,
        );        
        $this->load($route,$action,$arguments,$type);        
    }


    /**
     * generate new pattern of the route 
     *
     * @param string $url
     * @return pattern
     */
    public function generatePattern(string $url)
    {
      $pattern  = "#^";
      $pattern .= str_replace([':text', ':id'], ['([a-zA-Z0-9z]+)','(\d+)'],$url);
      $pattern .="$#";
      return $pattern;
    }

    public function getArguments($pattern)
    {
      preg_match($pattern, $this->request->url(),$matches);
      array_shift($matches);
      return $matches;

     
    }

    /**
     *  check for correct route then load it's controller
     *
     * @param [string] $route
     * @param [type] $function
     * @param [array] $arguments
     * @param [string] $type
     * @return void
     */
    public function load(string $route,$function,array $arguments,string $type)
    {   
      if ($this->isMatching($route)){
        $controller = explode("@",$function);
        $class = $controller[0];
        $classFunction = $controller[1];          
        $this->callFunction($class,$classFunction,$arguments);     
      }     
    }

    /**
     * loking for the function of specific class in Controllers folder 
     *
     * @param [type] $class
     * @param [type] $classFunction
     * @param [array] $classFunction
     * @return void
     */
    public function callFunction($class,$classFunction,array $arguments)
    {
      if(file_exists('./app/Controllers/'.$class.'.php')){
          
        require_once './app/Controllers/'.$class.'.php';
        $tempClass = new $class();
        try {
          $r  = new Request();
          $tempClass->$classFunction($r,$arguments);
        } catch (\Throwable $th) {
         print $th;
        }
          
      } else {
        throw new \Exception("Error Wrong class name", 1);
        
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
          
           return $this->map("get",$route,$action,$name);

      }  
    }


    /**
     * Check if th current url match the pattern 
     *
     * @param string $route
     * @return boolean
     */
    public function isMatching(string $route)
    {
      $pattern =  $this->generatePattern($route);
      return preg_match($pattern, $this->request->url());
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
        
        return $this->map("post",$route,$action,$name);
      } 
    }

  
}