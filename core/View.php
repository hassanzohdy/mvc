<?php
namespace Core;
class View {

    public $path;
    public function __construct(string $path , $data = null) {
        
        require "./static/views/".$path.".php";
    }

   
    
}