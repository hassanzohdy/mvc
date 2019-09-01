<?php
namespace App\Controllers;
use App\Controllers\Controller;
use Core\Request;
class PostController extends Controller {

    public  function index()
    {         
        view("index","alaa");
    }
    public  function create(Request $request)
    {    
               print_r(json_encode($_SERVER));
    }
}

?>
