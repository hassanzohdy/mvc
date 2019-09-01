<?php

Class Connection {
    private  $server = "mysql:host=localhost;dbname=mvc";
    private  $user = "root";
    private  $pass = "";
    private $options  = array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,);
    protected $connection;

    public function __CONSTRUCt (Type $var = null)
    {
    
    }
     
        public function openConnection() 
        {
            try
                {
                    $this->connection = new PDO($this->server, $this->user,$this->pass,$this->options);
                    return $this->connection;
                }
                catch (PDOException $e)
                    {
                         echo "There is some problem in connection: " . $e->getMessage();
                    }
                 }
    public function closeConnection() {
         $this->connection = null;
      }
    }
    
 class Db {



}
$con = new Connection();
$con->openConnection();