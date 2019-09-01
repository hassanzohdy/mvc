<?php
namespace Core;
use Core\Request;
class Validator 
{
    public $request;
    public function __construct() {
        $this->request = new Request();
    }

}