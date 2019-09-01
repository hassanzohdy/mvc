<?php
namespace App\Controllers;
use App\Controllers\Controller;
class HomeController extends Controller {
    
    public  function index(\Core\Request $request)
    {         
         view("index","alaa");
    }
    public  function test()
    {    
        redirect("/home");
    }
}


?>
