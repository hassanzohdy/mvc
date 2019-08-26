<?php
// namespace App\Controllers;
use App\Controllers\Controller;
use Core\View;
class HomeController extends Controller {
    
    public  function index($request,$arg)
    {   
       
       
        new View("index","alaa");
    }
    public  function create($request,$arg)
    {    
       
        print_r(json_encode($_SERVER));
    }
}


?>
