<?php
namespace Core;
use ReflectionClass;
use ReflectionMethod;
class AppReflector{
    public $reflectionClass;

    public function __construct($class) {
       $this->reflectionClass =  new ReflectionClass($class);
    }
    public  function getParameters(ReflectionMethod $method,$params)
    {
        
        foreach($method->getParameters() as $param)
        {   
            
            // array_push($params,["name" => $param->getName(),"type"=>  (string) $param->getType()]);
            array_push($params,(string) $param->getType());
            
        }
        return $params;
    }
    
    public function getMethodParams(string $methodName)
    {   
        $params = [];
        foreach($this->reflectionClass->getMethods(ReflectionMethod::IS_PUBLIC) as $method)
        {
            // print_r($method);
            if ($method->name == $methodName) {

                
              return  $this->getParameters($method,$params);
            }
        
        }
    }



}