<?php
namespace Core;
use Core\Request;
use Core\AppReflector;
class Route
{   
    public $routes = [];

     /**
     * Construct  of the class
     * making new request object
     */
    public function __construct()
    {
        $this->request = new Request();
    }
    
    /**
     * add route to array of the routes of the app 
     *
     * @param string $method
     * @param string $route
     * @param string $action
     * @return void
     */
    public function add (string $method,string $route,string $action )
    {   
        $this->routes[]= [$method,$route,$action];
    }
    

    /**
     * match the current url with stored routes if not found return not found page
     *
     * @return void
     */
    public function load()
    {
        foreach ($this->routes as  $route) {
            if($this->isMatching($route)){
                return $this->controllerTriger($route[2]);         
            } 

           
        }
       return  view("error");
    }

    /**
     * cheack if current request match specific route 
     *
     * @param array $route
     * @return boolean
     */
    public function isMatching(array $route)
    {
      $pattern =  $this->generatePattern($route[1]);
      return $_SERVER['REQUEST_METHOD'] == strtoupper($route[0]) & preg_match($pattern, $this->request->url());
    }


    /**
     * generate a pattern for route 
     *
     * @param string $url
     * @return string
     */
    public function generatePattern(string $url) :string
    {
      $pattern  = "#^";
      $pattern .= str_replace([':text', ':id'], ['([a-zA-Z0-9z]+)','(\d+)'],$url);
      $pattern .="$#";
      return $pattern;
    }
    

    /**
     * get the arguments from the url  
     *
     * @param [type] $pattern
     * @return array
     */
    public function getArguments($pattern) :array
    {
      preg_match($pattern, $this->request->url(),$matches);
      array_shift($matches);
      return $matches;
    }

    /**
     * Split up action into class and function then call the function
     *
     * @param [type] $action
     * @return void
     */
    public function controllerTriger($action)
    {
      $controller = explode("@",$action);
      $class = $controller[0];
      $classFunction = $controller[1];     
      $classNamespace = "App\Controllers\{$class}";
      $classNamespace = str_replace(["{","}"],"",$classNamespace);
      $app = new AppReflector($classNamespace);
      $params =  $app->getMethodParams($classFunction);
      $arg = [];
      foreach ($params as $param) {
         array_push($arg,new $param());
      }
      call_user_func_array(array($classNamespace,$classFunction,),$arg);
      
    }
}
