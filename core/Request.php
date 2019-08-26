<?php
namespace Core;
class Request {
    public $get_data;
    public $post_data;
    public $path;
    
    /**
     * collecting data function
     */
    public function __construct() 
    {
       $this->collectData();
    }
    
    public function collectData()
    {
        $this->get_data = $_GET;
        $this->post_data = $_POST;
        $this->path =  $_REQUEST['url'];      
    }
    
    /**
     *  return the data of the get method
     *
     * @return get_data
     */
    public function getData()
    {   
        return $this->get_data;
    }

    /**
     *  return the data of the get method
     *
     * @return post_data
     */
    public function postData()
    {      
        return $this->post_data;
    }

    public function url()
    {
       return str_replace("oop/","",$_SERVER['REDIRECT_URL']) ;
    }

}