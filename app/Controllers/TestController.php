<?php

use App\Controllers\Controller;
use Core\View;
class TestController extends Controller {
    
    public  function create($request,$arguments)
    {   
        // print_r($_REQUEST['url']);

        print_r($_REQUEST);
        // print_r($request->path());
       
       
    }
    
}


?>
