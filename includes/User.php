<?php
class User{
     private $con;
  //connect to database  
  function __construct() {
        include_once __DIR__.'/../config/database.php';
        $db= new Db();
        $this->con=$db->connect();
       
    }
 
     //create new admin
    public function CreateAdmin($userName,$userMail,$userPass,$userStatus="Active"){
        $userPass= md5($userPass);
        $pre_statm= $this->con->prepare("INSERT INTO `admin`(`full_name`, `email`, `password`,`status`)
               VALUES(?,?,?,?)");
        $pre_statm->bind_param("ssss",$userName,$userMail,$userPass,$userStatus);
        $result=$pre_statm->execute();
        if($result){
            //echo $this->con->insert_id;
            return "user_created";
        }else{
            //echo "user_cannot_created";
            return "user_cannot_created";
        }
    }
    
    //admin Login
    public function AdminLogin($userMail,$userPass){
            $userPass= md5($userPass);
            $pre_statm= $this->con->prepare("SELECT `admin_id`, `email`, `full_name` , `role` FROM `admin` WHERE email=? AND password=? AND status='Active'");
            $pre_statm->bind_param("ss",$userMail,$userPass);
            $pre_statm->execute() or die($this->con->error);
            $result=$pre_statm->get_result();
            if(($result->num_rows)==1){
                //echo "Login";
                $row = $result->fetch_assoc();
                $_SESSION["userId"]=$row["admin_id"];
                $_SESSION["userName"]=$row["full_name"];
                $_SESSION["userRole"]=$row["role"];
                return "login";
            }else{
                //echo "login problem";
                   return "error_login";
                }
            
        
    }
            
      
    
      public function isMailExist($userMail){
            $pre_statm= $this->con->prepare("SELECT  `email` FROM `admin` WHERE email=?");
            $pre_statm->bind_param("s",$userMail);
            $pre_statm->execute() or die($this->con->error);
            $result=$pre_statm->get_result();
            if(($result->num_rows)>=1){
                return true;
            }else{
                   return false;
                }
            
        
    }
   
    
   
    
}
//$obj =new User();
//$res=$obj->isMailExist("admin@gmail.com");
//echo $res; 