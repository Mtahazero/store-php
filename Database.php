<?php

class Database{
    private $host = 'localhost';
    private $username = 'root';
    private $password = '';
    private $database = 'test';
    protected $connect ;
  
        
    function __construct() {
        
        $this->connect();      

    }

    public function connect(){
        $this -> connect =new PDO("mysql:host=$this->host;dbname=$this->database",$this->username,$this->password);
        $this->connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
    public function getConnecting(){
        return $this->connect;
    }

    public function __destruct() {
        $this->connect = null;
    }
}

?>