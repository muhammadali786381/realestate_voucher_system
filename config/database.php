<?php
define("HOST","localhost");
define("USER","root");
define("PASS","m6405619A@");
define("DB","voucher_system");


class Db{
    private $conn;
    public function connect(){
        $this->conn= new mysqli(HOST,USER,PASS,DB);  
        if($this->conn){
            return $this->conn;
        }else{
            return "database_connect_problem";
        }
    }
}
//$obj = new Db();
//$obj->connect();