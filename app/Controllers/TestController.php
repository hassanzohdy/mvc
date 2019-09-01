<?php
namespace App\Controllers;
use App\Controllers\Controller;
use Core\View;
class TestController extends Controller {
    
    public  function create()
    {   
        // print_r($_REQUEST['url']);

        print_r($_REQUEST);
        // print_r($request->path());
       
       
    }
    
}


?>
